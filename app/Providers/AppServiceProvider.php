<?php
namespace App\Providers;
use App\Models\HomeNews;
use App\Models\InteractionProject;
use App\Models\Project;
use App\Models\Discourse;
use App\Models\Team;
use App\Models\Job;
use App\Models\Profile;
use App\Observers\HomeNewsObserver;
use App\Observers\TeamObserver;
use App\Observers\JobObserver;
use App\Observers\ProfileObserver;
use App\Observers\ProjectObserver;
use App\Observers\DiscourseObserver;
use App\Observers\InteractionProjectObserver;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('cachebust', function ($expression) {
            return "?v=" . Str::random(10);
        });
        
        setLocale(LC_ALL, 'de_CH.UTF-8');

        HomeNews::observe(HomeNewsObserver::class);
        Project::observe(ProjectObserver::class);
        InteractionProject::observe(InteractionProjectObserver::class);
        Discourse::observe(DiscourseObserver::class);
        Profile::observe(ProfileObserver::class);
        Team::observe(TeamObserver::class);
        Job::observe(JobObserver::class);

    }
}
