<?php
namespace App\Http\Controllers\Api;
use App\Models\TeamPortrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ImageCache;

class TeamPortraitController extends Controller
{
  protected $teamPortrait;
  protected $imageCache;
  
  /**
   * Constructor
   * 
   * @param TeamPortrait $teamPortrait
   * @param ImageCache $imageCache
   */

  public function __construct(TeamPortrait $teamPortrait, ImageCache $imageCache)
  {
    $this->teamPortrait = $teamPortrait;
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
   * @return void
   */
  private function removeCachedImage(TeamPortrait $teamPortrait)
  {
    // Clear the cached image using the new ImageCache service
    $this->imageCache->clearCache('portrait', $teamPortrait->name);
  }
}
