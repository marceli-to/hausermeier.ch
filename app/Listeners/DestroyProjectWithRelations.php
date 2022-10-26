<?php
namespace App\Listeners;
use App\Events\ProjectDestroy;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DestroyProjectWithRelations
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
   * @param  ProjectDestroy $event
   * @return void
   */
  public function handle(ProjectDestroy $event)
  {
    $images    = $event->project->images;
    $documents = $event->project->documents;

    // Delete all images from storage
    if ($images)
    {
      foreach($images as $i)
      {
        Storage::delete('public/uploads/' . $i->name);
      }
    }

    // Delete all documents from storage
    if ($documents)
    {
      foreach($documents as $d)
      {
        Storage::delete('public/uploads/' . $d->name);
      }
    }

    // Delete project
    // \ProjectObserver deletes child elements (images, documents, grids).
    $event->project->delete();
  }
}
