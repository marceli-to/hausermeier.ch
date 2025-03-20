<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageCache
{
    protected $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Get an image with the given template applied, using caching
     *
     * @param string $template
     * @param string $filename
     * @return \Intervention\Image\Image
     */
    public function get($template, $filename)
    {
        $cacheKey = "image.{$template}.{$filename}";
        $cachePath = "cache/images/{$template}/{$filename}";

        // Check if we have a cached version
        if (Storage::exists($cachePath)) {
            return $this->manager->read(Storage::path($cachePath));
        }

        // Get original image
        $path = storage_path('app/public/uploads/') . $filename;
        if (!file_exists($path)) {
            abort(404);
        }

        // Create image instance
        $image = $this->manager->read($path);

        // Apply filter based on template
        $filterClass = $this->getFilterClass($template);
        if ($filterClass) {
            $filter = new $filterClass;
            $image = $filter->applyFilter($image);
        }

        // Cache the processed image
        Storage::makeDirectory(dirname($cachePath));
        $image->save(Storage::path($cachePath));

        return $image;
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
            // Main templates
            'project' => \App\Filters\Image\Template\Project::class,
            'project-full' => \App\Filters\Image\Template\ProjectFull::class,
            'project-tiny' => \App\Filters\Image\Template\ProjectTiny::class,
            'project-preview' => \App\Filters\Image\Template\ProjectPreview::class,
            'strategy-project' => \App\Filters\Image\Template\StrategyProject::class,
            'strategy-project-full' => \App\Filters\Image\Template\StrategyProjectFull::class,
            'team' => \App\Filters\Image\Template\Team::class,
            'news' => \App\Filters\Image\Template\News::class,
            'portrait' => \App\Filters\Image\Template\Portrait::class,
            'contact' => \App\Filters\Image\Template\Contact::class,
            'intro' => \App\Filters\Image\Template\Intro::class,
            'profile' => \App\Filters\Image\Template\Profile::class,
            'discourse' => \App\Filters\Image\Template\Discourse::class,
            'job' => \App\Filters\Image\Template\Job::class,
            'interaction-project' => \App\Filters\Image\Template\InteractionProject::class,
            'interaction-project-full' => \App\Filters\Image\Template\InteractionProjectFull::class,
            
            // Work preview templates
            'work-preview' => \App\Filters\Image\Template\WorkPreview::class,
            'work-preview-se' => \App\Filters\Image\Template\WorkPreviewStrategyProject::class,
            'works' => \App\Filters\Image\Template\Works::class,
            
            // Size-based templates
            'cache' => \App\Filters\Image\Template\Cache::class,
            'small' => \App\Filters\Image\Template\Small::class,
            'large' => \App\Filters\Image\Template\Large::class,
            'tiny' => \App\Filters\Image\Template\Tiny::class,
            'thumbnail' => \App\Filters\Image\Template\Thumbnail::class,
            
            // Special templates
            'lightbox' => \App\Filters\Image\Template\Lightbox::class,
            'opengraph' => \App\Filters\Image\Template\OpenGraph::class,
        ];

        return $filters[$template] ?? null;
    }

    /**
     * Clear the cache for a specific image
     *
     * @param string $template
     * @param string $filename
     * @return bool
     */
    public function clearCache($template, $filename)
    {
        $cachePath = "cache/images/{$template}/{$filename}";
        return Storage::delete($cachePath);
    }

    /**
     * Clear all image caches
     *
     * @return bool
     */
    public function clearAllCaches()
    {
        return Storage::deleteDirectory('cache/images');
    }
}
