<?php
namespace App\Observers;
use App\Models\InteractionProject;

class InteractionProjectObserver
{
    /**
     * Handle the project "created" event.
     *
     * @param  \App\InteractionProject  $interactionProject
     * @return void
     */
    public function created(InteractionProject $interactionProject)
    {
        //
    }

    /**
     * Handle the project "updated" event.
     *
     * @param  \App\InteractionProject  $interactionProject
     * @return void
     */
    public function updated(InteractionProject $interactionProject)
    {
        //
    }

    /**
     * Handle the project "deleted" event.
     *
     * @param  \App\InteractionProject  $interactionProject
     * @return void
     */
    public function deleted(InteractionProject $interactionProject)
    {
        //
    }

    /**
     * Handle the project "deleting" event.
     *
     * @param  \App\InteractionProject  $interactionProject
     * @return void
     */
    public function deleting(InteractionProject $interactionProject)
    {
        $interactionProject->images()->delete();
    }

    /**
     * Handle the project "restored" event.
     *
     * @param  \App\InteractionProject  $interactionProject
     * @return void
     */
    public function restored(InteractionProject $interactionProject)
    {
        //
    }

    /**
     * Handle the project "force deleted" event.
     *
     * @param  \App\InteractionProject  $interactionProject
     * @return void
     */
    public function forceDeleted(InteractionProject $interactionProject)
    {
        //
    }
}
