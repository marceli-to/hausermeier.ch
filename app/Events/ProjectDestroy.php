<?php
namespace App\Events;
use App\Models\Project;
use Illuminate\Queue\SerializesModels;

class ProjectDestroy
{
  use SerializesModels;

  public $project;

  /**
   * Create a new event instance.
   *
   * @param  \App\Models\Project $project
   * @return void
   */

  public function __construct(Project $project)
  {
    $this->project = $project;
  }
}
