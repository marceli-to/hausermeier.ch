<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\InteractionProject;
use App\Models\InteractionProjectImage;
use App\Models\Intro;
use Illuminate\Http\Request;

class InteractionController extends BaseController
{
  protected $viewPath = 'frontend.pages.interaction.';
  
  /**
   * Constructor
   */

  public function __construct(
    InteractionProject $interactionProject,
    InteractionProjectImage $interactionProjectImage,
    Intro $intro
  )
  {
    parent::__construct();
    $this->interactionProject = $interactionProject;
    $this->intro = $intro;
  }

  /**
   * Show the interaction projects page
   *
   * @return \Illuminate\Http\Response
   */

  public function index()
  {
    // Intro
    $intro = $this->intro->published()->with('images')->where('type', '=', 'interaction')->get()->first();

    // Interaction items
    $interactions = $this->interactionProject->published()
                                             ->with('publishedImages')
                                             ->with('project')
                                             ->orderBy('order')
                                             ->get();
    
    return 
      view($this->viewPath . 'index', 
        [
          'interactions' => $interactions,
          'intro' => $intro
        ]
    );
  }
}
