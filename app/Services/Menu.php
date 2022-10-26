<?php
namespace App\Services;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Models\Project;
use Config;
use Lang;

class Menu
{
  // Menu item active class
  protected $active = 'is-active';

  // Models
  protected $project;

  public function __construct()
  {
    $project = new \App\Models\Project;
    $this->project = $project;
    $this->settings = Config::get('settings');
  }

  public function boot()
  {
    $data = [];
    foreach($this->settings['projectCategories'] as $key => $category)
    {
      $projects = $this->project->published()->where('category', '=', $key)->where('has_detail', '=', 1)->orderBy('order')->get();
      $data[] = [
        'category' => $key,
        'label' => Lang::get('settings.' . $category),
        'items' => $projects
      ];
    }
    View::share('menuItems', $data);
  }
}