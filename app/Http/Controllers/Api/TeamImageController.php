<?php
namespace App\Http\Controllers\Api;
use App\Models\TeamImage;
use App\Http\Resources\DataCollection;
use App\Http\Requests\TeamImageStoreRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ImageCache;

class TeamImageController extends Controller
{
  protected $image;
  protected $imageCache;
  
  /**
   * Constructor
   * 
   * @param TeamImage $image
   * @param ImageCache $imageCache
   */

  public function __construct(TeamImage $image, ImageCache $imageCache)
  {
    $this->image = $image;
    $this->imageCache = $imageCache;
  }

  /**
   * Get all records
   *
   * @return \Illuminate\Http\Response
   */

  public function get()
  {
    return new DataCollection($this->image->get());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  
  public function store(TeamImageStoreRequest $request)
  {   
    $image = new TeamImage($request->all());
    $image->save();
    return response()->json(['imageId' => $image->id]);
  }

  /**
   * Edit a specified resource.
   *
   * @param TeamImage $image
   * @return \Illuminate\Http\Response
   */
  public function edit(TeamImage $image)
  {
    return response()->json($image);
  }

  /**
   * Update the status of the specified resource.
   *
   * @param TeamImage $image
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function update(TeamImage $image, TeamImageStoreRequest $request)
  {
    $image->update($request->all());
    return response()->json('successfully updated');
  }

  /**
   * Update the status of the specified resource.
   *
   * @param  TeamImage $image
   * @return \Illuminate\Http\Response
   */
  public function status(TeamImage $image)
  {
    $image->publish = $image->publish == 0 ? 1 : 0;
    $image->save();
    return response()->json($image->publish);
  }

  /**
   * Update the cropping coords of the specified resource.
   *
   * @param TeamImage $teamImage
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function coords(TeamImage $teamImage, Request $request)
  {
    $image = $this->image->findOrFail($teamImage->id);
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
   * @param  String $image
   * @return \Illuminate\Http\Response
   */
  public function destroy($image)
  {
    // Delete image from database
    $image = $this->image->where('name', '=', $image)->first();
    
    if ($image)
    {
      $image->delete();
    }

    // Delete file from storage
    $directories = Storage::allDirectories('public');
    foreach($directories as $d)
    {
      Storage::delete($d . '/'. $image->name);
    }
    
    return response()->json('successfully deleted');
  }

  /**
   * Remove cached version of the image
   *
   * @param TeamImage $image
   * @return void
   */
  private function removeCachedImage(TeamImage $image)
  {
    // Clear the cached image using the new ImageCache service
    $this->imageCache->clearCache('team', $image->name);
  }
}
