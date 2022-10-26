<?php
namespace App\Listeners;
use App\Events\StrategyProjectDestroy;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DestroyStrategyProject
{
  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Handle the event.
   *
   * @param  StrategyProjectDestroy $event
   * @return void
   */
  public function handle(StrategyProjectDestroy $event)
  {
    $images = $event->strategyProject->images;

    // Delete all images from storage
    if ($images)
    {
      foreach($images as $i)
      {
        Storage::delete('public/uploads/' . $i->name);
      }
    }

    // Delete project
    // \Observers\StrategyProjectObserver observes and deletes child elements (images)
    $event->strategyProject->delete();
  }
}
