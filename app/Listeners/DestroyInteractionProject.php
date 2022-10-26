<?php
namespace App\Listeners;
use App\Events\InteractionProjectDestroy;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DestroyInteractionProject
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
   * @param  InteractionProjectDestroy $event
   * @return void
   */
  public function handle(InteractionProjectDestroy $event)
  {
    $images = $event->interactionProject->images;

    // Delete all images from storage
    if ($images)
    {
      foreach($images as $i)
      {
        Storage::delete('public/uploads/' . $i->name);
      }
    }

    // Delete project
    // \Observers\InteractionProjectObserver observes and deletes child elements (images)
    $event->interactionProject->delete();
  }
}
