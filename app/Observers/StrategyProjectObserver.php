<?php
namespace App\Observers;
use App\Models\StrategyProject;

class StrategyProjectObserver
{
    /**
     * Handle the project "created" event.
     *
     * @param  \App\StrategyProject  $strategyProject
     * @return void
     */
    public function created(StrategyProject $strategyProject)
    {
        //
    }

    /**
     * Handle the project "updated" event.
     *
     * @param  \App\StrategyProject  $strategyProject
     * @return void
     */
    public function updated(StrategyProject $strategyProject)
    {
        //
    }

    /**
     * Handle the project "deleted" event.
     *
     * @param  \App\StrategyProject  $strategyProject
     * @return void
     */
    public function deleted(StrategyProject $strategyProject)
    {
        //
    }

    /**
     * Handle the project "deleting" event.
     *
     * @param  \App\StrategyProject  $strategyProject
     * @return void
     */
    public function deleting(StrategyProject $strategyProject)
    {
        $strategyProject->images()->delete();
    }

    /**
     * Handle the project "restored" event.
     *
     * @param  \App\StrategyProject  $strategyProject
     * @return void
     */
    public function restored(StrategyProject $strategyProject)
    {
        //
    }

    /**
     * Handle the project "force deleted" event.
     *
     * @param  \App\StrategyProject  $strategyProject
     * @return void
     */
    public function forceDeleted(StrategyProject $strategyProject)
    {
        //
    }
}
