<?php
namespace App\Http\Controllers\Api;
use App\Models\StrategyProjectImage;
use App\Http\Resources\DataCollection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StrategyProjectImageController extends Controller
{
  protected $strategyProjectImage;
  
  /**
   * Constructor
   * 
   * @param StrategyProjectImage $strategyProjectImage
   */

  public function __construct(StrategyProjectImage $strategyProjectImage)
  {
    $this->strategyProjectImage = $strategyProjectImage;
  }

    /**
     * Get all images by strategy
     *
     * @param int $strategyProjectId
     * @return \Illuminate\Http\Response
     */

    public function get($strategyProjectId = NULL)
    {
      $strategyProjectImages = $this->strategyProjectImage
                                      ->where('strategy_project_id', '=', $strategyProjectId)
                                      ->where('publish', '=', 1)
                                      ->get();
      return new DataCollection($strategyProjectImages);
    }

  /**
   * Update the status of the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function status($id)
  {
    $strategyProjectImage = $this->strategyProjectImage->findOrFail($id);
    $strategyProjectImage->publish = $strategyProjectImage->publish == 0 ? 1 : 0;
    $strategyProjectImage->save();
    return response()->json($strategyProjectImage->publish);
  }

  /**
   * Update the cropping coords of the specified resource.
   *
   * @param StrategyProjectImage $strategyProjectImage
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function coords(StrategyProjectImage $strategyProjectImage, Request $request)
  {
    $image = $this->strategyProjectImage->findOrFail($strategyProjectImage->id);
    $image->coords_w = round($request->input('coords_w'), 12);
    $image->coords_h = round($request->input('coords_h'), 12);
    $image->coords_x = round($request->input('coords_x'), 12);
    $image->coords_y = round($request->input('coords_y'), 12);
    $image->save();
    $this->removeCachedImage($image);
    return response()->json('successfully updated');
  }

  /**
   * Update the order of the resources.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function order(Request $request)
  {
    $images = $request->get('images');
    foreach($images as $image)
    {
      $i = $this->strategyProjectImage->find($image['id']);
      $i->order = $image['order'];
      $i->save(); 
    }
    return response()->json('successfully updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  string $image
   * @return \Illuminate\Http\Response
   */
  
  public function destroy($image)
  {
    // Delete image from database
    $record = $this->strategyProjectImage->where('name', '=', $image)->first();
    
    if ($record)
    {
      $record->delete();
    }

    // Delete file from storage
    $directories = Storage::allDirectories('public');
    foreach($directories as $d)
    {
      Storage::delete($d . '/'. $image);
    }
    
    return response()->json('successfully deleted');
  }

  /**
   * Remove cached version of the image
   *
   * @param StrategyProjectImage $strategyProjectImage
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  private function removeCachedImage(StrategyProjectImage $strategyProjectImage)
  {
    // Get an instance of the ImageCache class
    $imageCache = new \Intervention\Image\ImageCache();

    // Get a cached image from it and apply all of your templates / methods
    $image = $imageCache->make(storage_path('app/public/uploads/') . $strategyProjectImage->name)->filter(new \App\Filters\Image\Template\StrategyProject);

    // Remove the image from the cache by using its internal checksum
    Cache::forget($image->checksum());
  }
}
