<?php
namespace App\Http\Controllers\Api;
use App\Models\StrategyProjectImage;
use App\Http\Resources\DataCollection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ImageCache;

class StrategyProjectImageController extends Controller
{
  protected $strategyProjectImage;
  protected $imageCache;
  
  /**
   * Constructor
   * 
   * @param StrategyProjectImage $strategyProjectImage
   * @param ImageCache $imageCache
   */

  public function __construct(StrategyProjectImage $strategyProjectImage, ImageCache $imageCache)
  {
    $this->strategyProjectImage = $strategyProjectImage;
    $this->imageCache = $imageCache;
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
   * @return void
   */
  private function removeCachedImage(StrategyProjectImage $strategyProjectImage)
  {
    // Clear the cached image using the new ImageCache service
    $this->imageCache->clearCache('strategy-project', $strategyProjectImage->name);
  }
}
