<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ProjectGridLayout;
use App\Http\Resources\DataCollection;

use Illuminate\Http\Request;

class ProjectGridLayoutController extends Controller
{
  protected $projectGridLayout;

  public function __construct(ProjectGridLayout $projectGridLayout)
  {
    $this->projectGridLayout = $projectGridLayout;
  }

  /**
   * Get all layouts
   *
   * @return \Illuminate\Http\Response
   */
  public function get()
  {
    return new DataCollection($this->projectGridLayout->orderBy('order')->get());
  }
}
