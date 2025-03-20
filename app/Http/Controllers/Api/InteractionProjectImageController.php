<?php
namespace App\Http\Controllers\Api;
use App\Models\InteractionProjectImage;
use App\Http\Resources\DataCollection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ImageCache;

class InteractionProjectImageController extends Controller
{
  protected $interactionProjectImage;
  protected $imageCache;
  
  /**
   * Constructor
   * 
   * @param InteractionProjectImage $interactionProjectImage
   * @param ImageCache $imageCache
   */

  public function __construct(InteractionProjectImage $interactionProjectImage, ImageCache $imageCache)
  {
    $this->interactionProjectImage = $interactionProjectImage;
    $this->imageCache = $imageCache;
  }

    /**
     * Get all images by interaction
     *
     * @param int $interactionProjectId
     * @return \Illuminate\Http\Response
     */

    public function get($interactionProjectId = NULL)
    {
      $interactionProjectImages = $this->interactionProjectImage
                                      ->where('interaction_project_id', '=', $interactionProjectId)
                                      ->where('publish', '=', 1)
                                      ->get();
      return new DataCollection($interactionProjectImages);
    }

  /**
   * Update the status of the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function status($id)
  {
    $interactionProjectImage = $this->interactionProjectImage->findOrFail($id);
    $interactionProjectImage->publish = $interactionProjectImage->publish == 0 ? 1 : 0;
    $interactionProjectImage->save();
    return response()->json($interactionProjectImage->publish);
  }

  /**
   * Update the cropping coords of the specified resource.
   *
   * @param InteractionProjectImage $interactionProjectImage
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function coords(InteractionProjectImage $interactionProjectImage, Request $request)
  {
    $image = $this->interactionProjectImage->findOrFail($interactionProjectImage->id);
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
      $i = $this->interactionProjectImage->find($image['id']);
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
    $record = $this->interactionProjectImage->where('name', '=', $image)->first();
    
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
   * @param InteractionProjectImage $interactionProjectImage
   * @return void
   */
  private function removeCachedImage(InteractionProjectImage $interactionProjectImage)
  {
    // Clear the cached image using the new ImageCache service
    $this->imageCache->clearCache('interaction-project', $interactionProjectImage->name);
  }
}
