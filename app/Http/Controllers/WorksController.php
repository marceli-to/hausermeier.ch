<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\Project;
use App\Models\StrategyProject;
use Illuminate\Http\Request;

class WorksController extends BaseController
{
  // Models
  protected $project;

  // View path
  protected $viewPath = 'frontend.pages.works.';

  /**
   * Constructor
   * 
   * @param Discourse $discourse
   */

  public function __construct(Project $project, StrategyProject $strategyProject)
  {
    parent::__construct();
    $this->project = $project;
    $this->strategyProject = $strategyProject;
  }

  /**
   * Show all work entries by year
   *
   * @return \Illuminate\Http\Response
   */

  public function year()
  {
    $projects = $this->project->published()->with('previewImage')->orderBy('year', 'DESC')->get();
    $strategyProjects = $this->strategyProject->published()->with('previewImage')->orderBy('year', 'DESC')->get();
    $works = $projects->merge($strategyProjects);
    $works_grouped = $works->groupBy('year');
    $works_columns = \AppHelper::partition($works_grouped, 'year');

    $years = [];
    foreach($works as $w)
    {
      $years[$w->year] = $w->year;
    }
    $heading = min($years) . ' – ' . max($years);
    return 
      view($this->viewPath . 'year', 
        [
          'heading' => $heading,
          'works' => $works_grouped,
          'works_columns' => $works_columns
        ]
    );
  }

  /**
   * Show all work entries by program
   *
   * @return \Illuminate\Http\Response
   */

  public function topic()
  {
    $projects = $this->project->published()->with('previewImage')->with('program')->get();
    $projects = $projects->sortBy('program.order');
    $works_grouped = $projects->groupBy('program_id');

    $strategyProjects = $this->strategyProject->published()->with('previewImage')->orderBy('year', 'DESC')->get();

    $works_columns = \AppHelper::partition($works_grouped, 'program_id');
    $works = $projects->merge($strategyProjects);

    return 
      view($this->viewPath . 'topic', 
        [
          'works' => $works->groupBy('program_id'),
          'works_columns' => $works_columns,
          'works_strategy' => $strategyProjects,
        ]
    );
  }

}
