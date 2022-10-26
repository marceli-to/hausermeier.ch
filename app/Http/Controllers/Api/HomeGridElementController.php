<?php
namespace App\Http\Controllers\Api;
use App\Models\HomeGridElement;
use App\Models\ProjectImage;
use App\Http\Resources\DataCollection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeGridElementController extends Controller
{
  protected $homeGridElement;
  protected $projectImage;

  public function __construct(HomeGridElement $homeGridElement, ProjectImage $projectImage)
  {
    $this->homeGridElement = $homeGridElement;
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
    $homeGridElements = $this->homeGridElement
                          ->with('image.project')
                          ->with('strategyImage.strategyProject')
                          ->with('interactionImage.interactionProject')
                          ->with('discourseImage.discourse')
                          ->with('news')
                          ->byHomeGrid($gridId)
                          ->get();
    return new DataCollection($homeGridElements);
  }

  /**
   * Store a newly created image/news.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $item = new HomeGridElement([
        'grid_id' => $request->get('grid_id'),
        'project_image_id' => $request->get('project_image_id'),
        'strategy_project_image_id' => $request->get('strategy_project_image_id'),
        'discourse_image_id' => $request->get('discourse_image_id'),
        'interaction_project_image_id' => $request->get('interaction_project_image_id'),
        'news_id' => $request->get('news_id'),
        'position' => $request->get('position')
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
   * Delete a grid image
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $element = $this->homeGridElement->find($id);
    $element->delete();
    if ($element->project_image_id != NULL)
    {
      $image = $this->projectImage->find($element->project_image_id);
      $image->is_grid = 0;
      $image->save();
    }
    return response()->json('successfully deleted');
  }
}
