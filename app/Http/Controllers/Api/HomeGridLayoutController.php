<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\HomeGridLayout;
use App\Http\Resources\DataCollection;

use Illuminate\Http\Request;

class HomeGridLayoutController extends Controller
{
  protected $homeGridLayout;

  public function __construct(HomeGridLayout $homeGridLayout)
  {
    $this->homeGridLayout = $homeGridLayout;
  }

  /**
   * Get all layouts
   *
   * @return \Illuminate\Http\Response
   */
  public function get()
  {
    return new DataCollection($this->homeGridLayout->orderBy('order')->get());
  }
}
