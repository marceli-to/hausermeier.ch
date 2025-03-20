<?php
namespace App\Http\Controllers;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Process and serve an image with the given template
     *
     * @param string $template
     * @param string $filename
     * @return \Illuminate\Http\Response
     */
    public function serve($template, $filename)
    {
        // Get the image path
        $path = storage_path('app/public/uploads/') . $filename;

        // Check if file exists
        if (!file_exists($path)) {
            abort(404);
        }

        // Create image instance
        $image = Image::make($path);

        // Apply filter based on template
        $filterClass = $this->getFilterClass($template);
        if ($filterClass) {
            $filter = new $filterClass;
            $image = $filter->applyFilter($image);
        }

        // Return the processed image
        return $image->response();
    }

    /**
     * Get the filter class for a given template
     *
     * @param string $template
     * @return string|null
     */
    protected function getFilterClass($template)
    {
        $filters = [
            'project' => \App\Filters\Image\Template\Project::class,
            'strategy-project' => \App\Filters\Image\Template\StrategyProject::class,
            'team' => \App\Filters\Image\Template\Team::class,
            'news' => \App\Filters\Image\Template\News::class,
            'portrait' => \App\Filters\Image\Template\Portrait::class,
            'contact' => \App\Filters\Image\Template\Contact::class,
            'intro' => \App\Filters\Image\Template\Intro::class,
            'profile' => \App\Filters\Image\Template\Profile::class,
            'discourse' => \App\Filters\Image\Template\Discourse::class,
            'job' => \App\Filters\Image\Template\Job::class,
            'interaction-project' => \App\Filters\Image\Template\InteractionProject::class,
        ];

        return $filters[$template] ?? null;
    }
}
