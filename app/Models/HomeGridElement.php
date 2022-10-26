<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class HomeGridElement extends Model
{
  protected $fillable = [
    'position',
    'grid_id',
    'project_id',
    'project_image_id',
    'strategy_project_image_id',
    'interaction_project_image_id',
    'discourse_image_id',
    'news_id',
    'is_news',
    'is_project',
  ];

  /**
   * Get the elements for the row.
   */
  public function image()
  {
    return $this->hasOne('App\Models\ProjectImage', 'id', 'project_image_id');
  }

  /**
   * Get the elements for the row.
   */
  public function strategyImage()
  {
    return $this->hasOne('App\Models\StrategyProjectImage', 'id', 'strategy_project_image_id');
  }

  /**
   * Get the elements for the row.
   */
  public function interactionImage()
  {
    return $this->hasOne('App\Models\InteractionProjectImage', 'id', 'interaction_project_image_id');
  }

  /**
   * Get the elements for the row.
   */
  public function discourseImage()
  {
    return $this->hasOne('App\Models\DiscourseImage', 'id', 'discourse_image_id');
  }

  /**
   * Get the elements for the row.
   */
  public function news()
  {
    return $this->hasOne('App\Models\HomeNews', 'id', 'news_id');
  }

  /**
   * Scope a query to show elements by grid.
   *
   * @param  \Illuminate\Database\Eloquent\Builder $query
   * @return \Illuminate\Database\Eloquent\Builder
   */

  public function scopeByHomeGrid($query, $grid_id)
  {
    return $query->where('grid_id', '=', $grid_id);
  } 

  /**
   * Scope a query to show elements by project.
   *
   * @param  \Illuminate\Database\Eloquent\Builder $query
   * @return \Illuminate\Database\Eloquent\Builder
   */

  public function scopeByProject($query, $project_id)
  {
    return $query->where('project_id', '=', $project_id);
  }

}
