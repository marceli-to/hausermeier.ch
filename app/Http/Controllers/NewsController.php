<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\Discourse;
use Illuminate\Http\Request;

class NewsController extends BaseController
{
  // Models
  protected $discourse;

  // View path
  protected $viewPath = 'frontend.pages.news.';

  /**
   * Constructor
   * 
   * @param Discourse $discourse
   */

  public function __construct(Discourse $discourse)
  {
    parent::__construct();
    $this->discourse = $discourse;
  }

  /**
   * Show all discourse entries
   *
   * @return \Illuminate\Http\Response
   */

  public function index()
  {
    $entries = $this->discourse->published()
                              ->with('publishedImages')
                              ->with('previewImage')
                              ->with('publishedDocuments')
                              ->with('project')
                              ->with('interactionProject')
                              ->with('strategyProject')
                              ->where('is_all', '=', 1)
                              ->orderBy('date', 'DESC')
                              ->get();
    return 
      view($this->viewPath . 'index', 
        [
          'entries' => $entries,
        ]
    );
  }

  /**
   * Show discourse entries
   *
   * @return \Illuminate\Http\Response
   */

  public function discourse()
  {
    $entries = $this->discourse->published()
                                ->with('publishedImages')
                                ->with('previewImage')
                                ->with('publishedDocuments')
                                ->with('project')
                                ->with('interactionProject')
                                ->with('strategyProject')
                                ->where('is_discourse', '=', 1)
                                ->orderBy('date', 'DESC')
                                ->get();
    return 
      view($this->viewPath . 'index', 
        [
          'entries' => $entries,
        ]
    );
  }

  /**
   * Show publication entries
   *
   * @return \Illuminate\Http\Response
   */

  public function publications()
  {
    $entries = $this->discourse->published()
                                ->with('publishedImages')
                                ->with('previewImage')
                                ->with('publishedDocuments')
                                ->with('project')
                                ->with('interactionProject')
                                ->with('strategyProject')
                                ->where('is_publication', '=', 1)
                                ->orderBy('date', 'DESC')
                                ->get();

    return 
      view($this->viewPath . 'index', 
        [
          'entries' => $entries,
        ]
    );
  }
}
