<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\Project;
use App\Models\StrategyProject;
use App\Models\ProjectGrid;
use App\Models\Intro;
use Illuminate\Http\Request;

class ProjectController extends BaseController
{
  // Models
  protected $project;
  protected $projectGrid;
  protected $intro;

  // View path
  protected $viewPath = 'frontend.pages.project.';

  /**
   * Constructor
   * 
   * @param Project $project
   */

  public function __construct(Project $project, ProjectGrid $projectGrid, Intro $intro, StrategyProject $strategyProject)
  {
    parent::__construct();
    $this->project         = $project;
    $this->strategyProject = $strategyProject;
    $this->projectGrid     = $projectGrid;
    $this->intro           = $intro;
  }

  /**
   * Show a project
   * @param Project $project
   * @param String $slug
   * @return \Illuminate\Http\Response
   */

  public function show(Project $project, $slug = NULL)
  {
    // project data
    $project = $this->project->with('publishedDocuments')->with('previewImage')->with('interactionProject')->findOrFail($project->id);
    
    // grid data
    $project_grids = $this->projectGrid
                          ->byProject($project->id)
                          ->with('layout')
                          ->orderBy('order', 'ASC')
                          ->get();
    return 
      view($this->viewPath . 'show', 
        [
          'project' => $project,
          'grids'   => $this->getProjectGrid($project),
          'browse'  => $this->getBrowse($project->id),
          'og'      => $this->getOpenGraphImage($project),
        ]
    );
  }

  /**
   * Show all projects with category 3 (Strategy & Development)
   * @return \Illuminate\Http\Response
   */

  public function strategyAndDevelopment()
  {
    // intro
    $intro = $this->intro->published()->with('images')->where('type', '=', 'strategy')->get()->first();
    
    // project data
    $projects = $this->strategyProject->published()->with('publishedImages')->get();

    return 
      view($this->viewPath . 'strategy-development', 
        [
          'projects' => $projects,
          'intro' => $intro,
        ]
    );
  }


  /**
   * Get grid items for a project
   * @param Project $project
   * @return \Illuminate\Http\Response
   */

  protected function getProjectGrid(Project $project)
  {
    $grids = $this->projectGrid->byProject($project->id)
                                ->with('layout')
                                ->with('elements.image')
                                ->with('elements.text')
                                ->orderBy('order')
                                ->get();

    $project_grids = [];
    foreach($grids as $g)
    {
        $project_grids[$g->id]['key'] = $g->layout->key;

        // Sort elements by position
        $sorted = $g->elements->sortBy('position');
        $project_grids[$g->id]['elements'] = $sorted->values()->all();
    }
    return $project_grids;
  }

  /**
   * Get browse nav
   * @param $id
   * @return \Illuminate\Http\Response
   */

  protected function getBrowse($id = NULL)
  {
    $categories = \Config::get('settings.projectCategories');

    // Build project nav
    $projects = [];
    foreach($categories as $key => $category)
    {
      if ($key != 3)
      {
        $projects[] = $this->project->published()->with('previewImage')->where('category', '=', $key)->where('has_detail', '=', 1)->orderBy('order')->get();
      }
    }
    
    $keys     = [];
    $items    = [];
    foreach(collect($projects)->sortBy('order')->flatten() as $p)
    {
      $keys[] = (int) $p->id;
    }

    // Get current key
    $key = array_search($id, $keys);

    if ($key == 0)
    {
      $prevId = end($keys);
      $nextId = isset($keys[$key+1]) ? $keys[$key+1] : NULL;
    }
    else if ($key == count($keys) - 1)
    {
      $prevId = $keys[$key-1];
      $nextId = $keys[0];
    }
    else
    {
      $prevId = $keys[$key-1];
      $nextId = $keys[$key+1];
    }

    $items = [
      'prev' => $this->project->find($prevId),
      'next' => $this->project->find($nextId),
    ];

    return $items;
  }

  /**
   * Get open graph image
   * @param Project $project
   * @return \Illuminate\Http\Response
   */
  protected function getOpenGraphImage(Project $project)
  {
    return $project->previewImage ? $project->previewImage->name : null; 
  }
}
