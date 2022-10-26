<?php
namespace App\Http\Controllers\Api;
use App\Models\ProjectImage;
use App\Models\ProjectGrid;
use App\Models\ProjectGridElement;
use App\Http\Resources\DataCollection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectGridController extends Controller
{
  protected $projectGrid;
  protected $projectGridElement;
  protected $projectImage;

  public function __construct(
    ProjectGrid $projectGrid, 
    ProjectGridElement $projectGridElement,
    ProjectImage $projectImage
  )
  {
    $this->projectGrid = $projectGrid;
    $this->projectGridElement = $projectGridElement;
    $this->projectImage = $projectImage;
  }
    
  /**
   * Get all grids by project
   *
   * @param int $projectId
   * @return \Illuminate\Http\Response
   */
  public function get($projectId)
  {
    return $this->_fetch($projectId);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param int $projectId
   * @param int $layoutId
   * @return \Illuminate\Http\Response
   */
  public function store($projectId, $layoutId)
  {
    $projectGrid = new ProjectGrid([
      'project_id' => $projectId,
      'layout_id'  => $layoutId,
      'order'      => 99,
      'publish'    => 1,
    ]);

    $projectGrid->save();
    return $this->_fetch($projectId);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $images = $this->projectGridElement->where('grid_id', '=', $id)->get();
    foreach($images as $i)
    {
      $img = $this->projectImage->find($i->project_image_id);
      if ($img)
      {
        $img->is_grid = 0;
        $img->save();
      }
    }
    
    $this->projectGrid->find($id)->delete();
    $this->projectGridElement->where('grid_id', '=', $id)->delete();
    return response()->json('successfully deleted');
  }

  /**
   * Update the order of the resources.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function order(Request $request)
  {
    $projectGrids = $request->get('grids');
    foreach($projectGrids as $projectGrid)
    {
      $g = $this->projectGrid->find($projectGrid['id']);
      $g->order = $projectGrid['order'];
      $g->save(); 
    }
    return response()->json('successfully updated');
  }

  /**
   * Fetch database records by project
   *
   * @param int $project_id
   */

  protected function _fetch($projectId)
  {
    $projectGrids = $this->projectGrid
      ->byProject($projectId)
      ->with('layout')
      ->orderBy('order', 'ASC')
      ->get();
    return new DataCollection($projectGrids);
  }
}
