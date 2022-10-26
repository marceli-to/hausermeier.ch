<?php
namespace App\Http\Controllers\Api;
use App\Models\TeamPortrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamPortraitController extends Controller
{
  protected $teamPortrait;
  
  /**
   * Constructor
   * 
   * @param TeamPortrait $teamPortrait
   */

  public function __construct(TeamPortrait $teamPortrait)
  {
    $this->teamPortrait = $teamPortrait;
  }

  /**
   * Update the status of the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function status($id)
  {
    $teamPortrait = $this->teamPortrait->findOrFail($id);
    $teamPortrait->publish = $teamPortrait->publish == 0 ? 1 : 0;
    $teamPortrait->save();
    return response()->json($teamPortrait->publish);
  }

  /**
   * Update the cropping coords of the specified resource.
   *
   * @param TeamPortrait $teamPortrait
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function coords(TeamPortrait $teamPortrait, Request $request)
  {
    $image = $this->teamPortrait->findOrFail($teamPortrait->id);
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
    $teamPortrait = $this->teamPortrait->where('name', '=', $image)->first();
    
    if ($teamPortrait)
    {
      $teamPortrait->delete();
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
   * @param TeamPortrait $teamPortrait
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  private function removeCachedImage(TeamPortrait $teamPortrait)
  {
    // Get an instance of the ImageCache class
    $imageCache = new \Intervention\Image\ImageCache();

    // Get a cached image from it and apply all of your templates / methods
    $image = $imageCache->make(storage_path('app/public/uploads/') . $teamPortrait->name)->filter(new \App\Filters\Image\Template\Portrait);

    // Remove the image from the cache by using its internal checksum
    Cache::forget($image->checksum());
  }
}
