<?php
namespace App\Events;
use App\Models\InteractionProject;
use Illuminate\Queue\SerializesModels;

class InteractionProjectDestroy
{
  use SerializesModels;

  public $interactionProject;

  /**
   * Create a new event instance.
   *
   * @param  \App\Models\InteractionProject $interactionProject
   * @return void
   */

  public function __construct(InteractionProject $interactionProject)
  {
    $this->interactionProject = $interactionProject;
  }
}
