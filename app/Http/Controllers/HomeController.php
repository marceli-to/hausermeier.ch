<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\HomeGrid;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
  // Models
  protected $homeGrid;

  // Viewpath
  protected $viewPath = 'frontend.pages.home.index';
  
  /**
   * Constructor
   * 
   */

  public function __construct(HomeGrid $homeGrid)
  {
    parent::__construct();
    $this->homeGrid = $homeGrid;
  }

  /**
   * Show the homepage
   *
   * @return \Illuminate\Http\Response
   */

  public function index()
  { 
    return 
      view($this->viewPath, 
        [
          'grids'   => $this->getGrids(),
          'is_home' => true
        ]
    );
  }

  /**
   * Get all grids
   */

  private function getGrids()
  {
    $grids = $this->homeGrid->with('layout')
                            ->with('elements.image.project')
                            ->with('elements.strategyImage.strategyProject')
                            ->with('elements.interactionImage.interactionProject')
                            ->with('elements.discourseImage.discourse')
                            ->with('elements.news.publishedImages')
                            ->orderBy('order')
                            ->get();
    $home_grids = [];
    foreach($grids as $g)
    {
      $home_grids[$g->id]['key'] = $g->layout->key;
      // Filter by environment & sort by position
      // $sorted = $g->elements->where('environment', 'production')->sortBy('position');
      $sorted = $g->elements->sortBy('position');
      $home_grids[$g->id]['elements'] = $sorted->values()->all();
    }
    return $home_grids;
  }
}
