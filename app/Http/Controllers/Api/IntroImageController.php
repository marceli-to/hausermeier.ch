<?php
namespace App\Http\Controllers\Api;
use App\Models\IntroImage;
use App\Http\Resources\DataCollection;
use App\Http\Requests\IntroImageStoreRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ImageCache;

class IntroImageController extends Controller
{
  protected $image;
  protected $imageCache;
  
  /**
   * Constructor
   * 
   * @param IntroImage $image
   * @param ImageCache $imageCache
   */

  public function __construct(IntroImage $image, ImageCache $imageCache)
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
  
  public function store(IntroImageStoreRequest $request)
  {   
    $image = new IntroImage($request->all());
    $image->save();
    return response()->json(['imageId' => $image->id]);
  }

  /**
   * Edit a specified resource.
   *
   * @param IntroImage $image
   * @return \Illuminate\Http\Response
   */

  public function edit(IntroImage $image)
  {
    return response()->json($image);
  }

  /**
   * Update the status of the specified resource.
   *
   * @param IntroImage $image
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function update(IntroImage $image, IntroImageStoreRequest $request)
  {
    $image->update($request->all());
    return response()->json('successfully updated');
  }

  /**
   * Update the status of the specified resource.
   *
   * @param  IntroImage $image
   * @return \Illuminate\Http\Response
   */

  public function status(IntroImage $image)
  {
    $image->publish = $image->publish == 0 ? 1 : 0;
    $image->save();
    return response()->json($image->publish);
  }

  /**
   * Update the cropping coords of the specified resource.
   *
   * @param IntroImage $introImage
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function coords(IntroImage $introImage, Request $request)
  {
    $image = $this->image->findOrFail($introImage->id);
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
   * @param IntroImage $image
   * @return void
   */
  private function removeCachedImage(IntroImage $image)
  {
    // Clear the cached image using the new ImageCache service
    $this->imageCache->clearCache('intro', $image->name);
  }
}
