<?php
namespace App\Observers;
use App\Models\HomeNews;

class HomeNewsObserver
{
    /**
     * Handle the project "created" event.
     *
     * @param  \App\HomeNews $homeNews
     * @return void
     */
    public function created(HomeNews $homeNews)
    {
        //
    }

    /**
     * Handle the project "updated" event.
     *
     * @param  \App\HomeNews $homeNews
     * @return void
     */
    public function updated(HomeNews $homeNews)
    {
        //
    }

    /**
     * Handle the project "deleted" event.
     *
     * @param  \App\HomeNews $homeNews
     * @return void
     */
    public function deleted(HomeNews $homeNews)
    {
        //
    }

    /**
     * Handle the project "deleting" event.
     *
     * @param  \App\HomeNews $homeNews
     * @return void
     */
    public function deleting(HomeNews $homeNews)
    {
        $homeNews->images()->delete();
    }

    /**
     * Handle the project "restored" event.
     *
     * @param  \App\HomeNews $homeNews
     * @return void
     */
    public function restored(HomeNews $homeNews)
    {
        //
    }

    /**
     * Handle the project "force deleted" event.
     *
     * @param  \App\HomeNews $homeNews
     * @return void
     */
    public function forceDeleted(HomeNews $homeNews)
    {
        //
    }
}
