<?php
namespace App\Http\Controllers\Api;
use App\Models\JobImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ImageCache;

class JobImageController extends Controller
{
  protected $jobImage;
  protected $imageCache;
  
  /**
   * Constructor
   * 
   * @param JobImage $jobImage
   * @param ImageCache $imageCache
   */

  public function __construct(JobImage $jobImage, ImageCache $imageCache)
  {
    $this->jobImage = $jobImage;
    $this->imageCache = $imageCache;
  }

  /**
   * Update the status of the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function status($id)
  {
    $jobImage = $this->jobImage->findOrFail($id);
    $jobImage->publish = $jobImage->publish == 0 ? 1 : 0;
    $jobImage->save();
    return response()->json($jobImage->publish);
  }

  /**
   * Update the cropping coords of the specified resource.
   *
   * @param JobImage $jobImage
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function coords(JobImage $jobImage, Request $request)
  {
    $image = $this->jobImage->findOrFail($jobImage->id);
    $image->coords_w = round($request->input('coords_w'), 12);
    $image->coords_h = round($request->input('coords_h'), 12);
    $image->coords_x = round($request->input('coords_x'), 12);
    $image->coords_y = round($request->input('coords_y'), 12);
    $image->save();
    $this->removeCachedImage($image);
    return response()->json('successfully updated');
  }

  /**
   * Remove a specified resource.
   *
   * @param  string $image
   * @return \Illuminate\Http\Response
   */
  public function destroy($image)
  {
    // Delete image from database
    $jobImage = $this->jobImage->where('name', '=', $image)->first();
    
    if ($jobImage)
    {
      $jobImage->delete();
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
   * @param JobImage $jobImage
   * @return void
   */
  private function removeCachedImage(JobImage $jobImage)
  {
    // Clear the cached image using the new ImageCache service
    $this->imageCache->clearCache('job', $jobImage->name);
  }
}
