<?php
namespace App\Http\Controllers\Api;
use App\Models\ProjectGridElement;
use App\Models\ProjectImage;
use App\Http\Resources\DataCollection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectGridElementController extends Controller
{
  protected $projectGridElement;
  protected $projectImage;

  public function __construct(ProjectGridElement $projectGridElement, ProjectImage $projectImage)
  {
    $this->projectGridElement = $projectGridElement;
    $this->projectImage = $projectImage;
  }

  /**
   * Get all records
   *
   * @param int $gridId
   * @return \Illuminate\Http\Response
   */

  public function get($gridId)
  {
    $projectGridElements = $this->projectGridElement
                          ->with('image.project')
                          ->with('text.project')
                          ->byProjectGrid($gridId)
                          ->get();
   
    return new DataCollection($projectGridElements);
  }

  /**
   * Store a newly created grid element.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $item = new ProjectGridElement([
      'position'          => $request->get('position'),
      'grid_id'           => $request->get('grid_id'),
      'project_id'        => $request->get('project_id'),
      'project_image_id'  => $request->get('project_image_id'),
      'project_text_id'   => $request->get('text_id'),
      'is_text'           => $request->get('is_text'),
      'is_image'          => $request->get('is_image'),
    ]);
    $item->save();

    // Mark an image as used
    if ($request->get('project_image_id'))
    {
      $image = $this->projectImage->find($request->get('project_image_id'));
      $image->is_grid = 1;
      $image->save();
    }
    return response()->json('success');
  }

  /**
   * Delete a grid element
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $element = $this->projectGridElement->find($id);
    $imageId = $element->project_image_id;
    if ($element->delete())
    {
      if ($imageId)
      {
        $image = $this->projectImage->find($imageId);
        $image->is_grid = 0;
        $image->save();
      }
    }
    return response()->json('successfully deleted');
  }
}