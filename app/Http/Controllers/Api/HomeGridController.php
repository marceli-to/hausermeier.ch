<?php
namespace App\Http\Controllers\Api;
use App\Models\ProjectImage;
use App\Models\HomeGrid;
use App\Models\HomeGridElement;
use App\Http\Resources\DataCollection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeGridController extends Controller
{
  protected $homeGrid;
  protected $homeGridElement;
  protected $projectImage;

  public function __construct(
    HomeGrid $homeGrid, 
    HomeGridElement $homeGridElement,
    ProjectImage $projectImage
  )
  {
    $this->homeGrid = $homeGrid;
    $this->homeGridElement = $homeGridElement;
    $this->projectImage = $projectImage;
  }
    
  /**
   * Get all grids
   *
   * @return \Illuminate\Http\Response
   */
  public function get()
  {
    return $this->_fetch();
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param int $layoutId
   * @return \Illuminate\Http\Response
   */
  public function store($layoutId)
  {
    $homeGrid = new HomeGrid([
      'layout_id'  => $layoutId,
      'order'      => 99,
      'publish'    => 1,
    ]);
    $homeGrid->save();
    return $this->_fetch();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $elements = $this->homeGridElement->where('grid_id', '=', $id)->get();
    foreach($elements as $e)
    {
      if ($e->project_image_id)
      {
        $img = $this->projectImage->find($e->project_image_id);
        if ($img)
        {
          $img->is_grid = 0;
          $img->save();
        }
      }
    }
    $this->homeGrid->find($id)->delete();
    $this->homeGridElement->where('grid_id', '=', $id)->delete();
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
    $homeGrids = $request->get('grids');
    foreach($homeGrids as $homeGrid)
    {
      $g = $this->homeGrid->find($homeGrid['id']);
      $g->order = $homeGrid['order'];
      $g->save(); 
    }
    return response()->json('successfully updated');
  }

  /**
   * Fetch grids
   *
   */

  protected function _fetch()
  {
    $homeGrids = $this->homeGrid
      ->with('layout')
      ->orderBy('order', 'ASC')
      ->get();
    return new DataCollection($homeGrids);
  }
}
