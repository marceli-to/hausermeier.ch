<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProjectGridElement extends Model
{
  protected $fillable = [
    'position',
    'grid_id',
    'project_id',
    'project_image_id',
    'project_text_id',
    'is_text',
    'is_image',
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
  public function text()
  {
    return $this->hasOne('App\Models\ProjectText', 'id', 'project_text_id');
  }

  /**
   * Scope a query to show elements by grid.
   *
   * @param  \Illuminate\Database\Eloquent\Builder $query
   * @return \Illuminate\Database\Eloquent\Builder
   */

  public function scopeByProjectGrid($query, $grid_id)
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
