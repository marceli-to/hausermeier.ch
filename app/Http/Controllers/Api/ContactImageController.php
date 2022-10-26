<?php
namespace App\Http\Controllers\Api;
use App\Models\ContactImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactImageController extends Controller
{
  protected $contactImage;
  
  /**
   * Constructor
   * 
   * @param ContactImage $contactImage
   */

  public function __construct(ContactImage $contactImage)
  {
    $this->contactImage = $contactImage;
  }

  /**
   * Update the status of the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function status($id)
  {
    $contactImage = $this->contactImage->findOrFail($id);
    $contactImage->publish = $contactImage->publish == 0 ? 1 : 0;
    $contactImage->save();
    return response()->json($contactImage->publish);
  }

  /**
   * Update the cropping coords of the specified resource.
   *
   * @param ContactImage $contactImage
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function coords(ContactImage $contactImage, Request $request)
  {
    $image = $this->contactImage->findOrFail($contactImage->id);
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
    $contactImage = $this->contactImage->where('name', '=', $image)->first();
    
    if ($contactImage)
    {
      $contactImage->delete();
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
   * @param ContactImage $contactImage
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  private function removeCachedImage(ContactImage $contactImage)
  {
    // Get an instance of the ImageCache class
    $imageCache = new \Intervention\Image\ImageCache();

    // Get a cached image from it and apply all of your templates / methods
    $image = $imageCache->make(storage_path('app/public/uploads/') . $contactImage->name)->filter(new \App\Filters\Image\Template\Contact);

    // Remove the image from the cache by using its internal checksum
    Cache::forget($image->checksum());
  }
}
