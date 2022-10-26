<?php
namespace App\Events;
use App\Models\StrategyProject;
use Illuminate\Queue\SerializesModels;

class StrategyProjectDestroy
{
  use SerializesModels;

  public $strategyProject;

  /**
   * Create a new event instance.
   *
   * @param  \App\Models\StrategyProject $strategyProject
   * @return void
   */

  public function __construct(StrategyProject $strategyProject)
  {
    $this->strategyProject = $strategyProject;
  }
}
