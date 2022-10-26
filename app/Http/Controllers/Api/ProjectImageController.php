<?php
namespace App\Http\Controllers\Api;
use App\Models\ProjectImage;
use App\Http\Resources\DataCollection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectImageController extends Controller
{
  protected $projectImage;
  
  /**
   * Constructor
   * 
   * @param ProjectImage $projectImage
   */

  public function __construct(ProjectImage $projectImage)
  {
    $this->projectImage = $projectImage;
  }

    /**
     * Get all images by project
     *
     * @param int $projectId
     * @return \Illuminate\Http\Response
     */

    public function get($projectId = NULL)
    {
      $projectImages = $this->projectImage
                            ->where('project_id', '=', $projectId)
                            ->where('publish', '=', 1)
                            ->orderBy('order')
                            ->get();
      return new DataCollection($projectImages);
    }

  /**
   * Update the status of the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function status($id)
  {
    $projectImage = $this->projectImage->findOrFail($id);
    $projectImage->publish = $projectImage->publish == 0 ? 1 : 0;
    $projectImage->save();
    return response()->json($projectImage->publish);
  }

  /**
   * Update the cropping coords of the specified resource.
   *
   * @param ProjectImage $projectImage
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function coords(ProjectImage $projectImage, Request $request)
  {
    $image = $this->projectImage->findOrFail($projectImage->id);
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
      $i = $this->projectImage->find($image['id']);
      $i->order = $image['order'];
      $i->save(); 
    }
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
    $projectImage = $this->projectImage->where('name', '=', $image)->first();
    
    if ($projectImage)
    {
      $projectImage->delete();
    }

    // Delete image from storage
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
   * @param ProjectImage $image
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  private function removeCachedImage(ProjectImage $image)
  {
    $cache1 = new \Intervention\Image\ImageCache();
    $img1 = $cache1->make(storage_path('app/public/uploads/') . $image->name)->filter(new \App\Filters\Image\Template\Project);
    Cache::forget($img1->checksum());

    $cache2 = new \Intervention\Image\ImageCache();
    $img2 = $cache2->make(storage_path('app/public/uploads/') . $image->name)->filter(new \App\Filters\Image\Template\ProjectTiny);
    Cache::forget($img2->checksum());

    $cache3 = new \Intervention\Image\ImageCache();
    $img3 = $cache3->make(storage_path('app/public/uploads/') . $image->name)->filter(new \App\Filters\Image\Template\WorkPreview);
    Cache::forget($img3->checksum());

    $cache4 = new \Intervention\Image\ImageCache();
    $img4 = $cache4->make(storage_path('app/public/uploads/') . $image->name)->filter(new \App\Filters\Image\Template\Works);
    Cache::forget($img4->checksum());

    $cache5 = new \Intervention\Image\ImageCache();
    $img5 = $cache5->make(storage_path('app/public/uploads/') . $image->name)->filter(new \App\Filters\Image\Template\ProjectPreview);
    Cache::forget($img5->checksum());
  }
}
