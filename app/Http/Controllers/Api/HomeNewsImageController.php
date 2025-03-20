<?php
namespace App\Http\Controllers\Api;
use App\Models\HomeNewsImage;
use App\Http\Resources\DataCollection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ImageCache;

class HomeNewsImageController extends Controller
{
  protected $homeNewsImage;
  protected $imageCache;
  
  /**
   * Constructor
   * 
   * @param HomeNewsImage $homeNewsImage
   * @param ImageCache $imageCache
   */

  public function __construct(HomeNewsImage $homeNewsImage, ImageCache $imageCache)
  {
    $this->homeNewsImage = $homeNewsImage;
    $this->imageCache = $imageCache;
  }

  /**
   * Get all images by discourse
   *
   * @param int $homeNewsId
   * @return \Illuminate\Http\Response
   */

  public function get($homeNewsId = NULL)
  {
    $homeNewsImages = $this->homeNewsImage
                          ->where('home_news_id', '=', $homeNewsId)
                          ->where('publish', '=', 1)
                          ->get();
    return new DataCollection($homeNewsImages);
  }

  /**
   * Update the status of the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function status($id)
  {
    $homeNewsImage = $this->homeNewsImage->findOrFail($id);
    $homeNewsImage->publish = $homeNewsImage->publish == 0 ? 1 : 0;
    $homeNewsImage->save();
    return response()->json($homeNewsImage->publish);
  }

  /**
   * Update the cropping coords of the specified resource.
   *
   * @param HomeNewsImage $homeNewsImage
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function coords(HomeNewsImage $homeNewsImage, Request $request)
  {
    $image = $this->homeNewsImage->findOrFail($homeNewsImage->id);
    $image->coords_w = round($request->input('coords_w'), 12);
    $image->coords_h = round($request->input('coords_h'), 12);
    $image->coords_x = round($request->input('coords_x'), 12);
    $image->coords_y = round($request->input('coords_y'), 12);
    $image->save();
    $this->removeCachedImage($image);
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
    $record = $this->homeNewsImage->where('name', '=', $image)->first();
    
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
   * @param HomeNewsImage $homeNewsImage
   * @return void
   */
  private function removeCachedImage(HomeNewsImage $image)
  {
    // Clear the cached image using the new ImageCache service
    $this->imageCache->clearCache('news', $image->name);
  }
}
