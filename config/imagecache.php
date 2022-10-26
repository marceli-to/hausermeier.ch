<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Name of route
    |--------------------------------------------------------------------------
    |
    | Enter the routes name to enable dynamic imagecache manipulation.
    | This handle will define the first part of the URI:
    |
    | {route}/{template}/{filename}
    |
    | Examples: "images", "img/cache"
    |
    */

    'route' => 'image',

    /*
    |--------------------------------------------------------------------------
    | Storage paths
    |--------------------------------------------------------------------------
    |
    | The following paths will be searched for the image filename, submitted
    | by URI.
    |
    | Define as many directories as you like.
    |
    */

    'paths' => array(
        public_path('upload'),
        public_path('images'),
        storage_path('app/public/uploads')
    ),

    /*
    |--------------------------------------------------------------------------
    | Manipulation templates
    |--------------------------------------------------------------------------
    |
    | Here you may specify your own manipulation filter templates.
    | The keys of this array will define which templates
    | are available in the URI:
    |
    | {route}/{template}/{filename}
    |
    | The values of this array will define which filter class
    | will be applied, by its fully qualified name.
    |
    */

    'templates' => array(
        'thumbnail'             => 'App\Filters\Image\Template\Thumbnail',
        'tiny'                  => 'App\Filters\Image\Template\Tiny',
        'small'                 => 'App\Filters\Image\Template\Small',
        'large'                 => 'App\Filters\Image\Template\Large',
        'lightbox'              => 'App\Filters\Image\Template\Lightbox',
        'opengraph'             => 'App\Filters\Image\Template\OpenGraph',
        'profile'               => 'App\Filters\Image\Template\Profile',
        'project'               => 'App\Filters\Image\Template\Project',
        'project-preview'       => 'App\Filters\Image\Template\ProjectPreview',
        'project-tiny'          => 'App\Filters\Image\Template\ProjectTiny',
        'discourse'             => 'App\Filters\Image\Template\Discourse',
        'job'                   => 'App\Filters\Image\Template\Job',
        'team'                  => 'App\Filters\Image\Template\Team',
        'interaction-project'   => 'App\Filters\Image\Template\InteractionProject',
        'strategy-project'      => 'App\Filters\Image\Template\StrategyProject',
        'intro'                 => 'App\Filters\Image\Template\Intro',
        'contact'               => 'App\Filters\Image\Template\Contact',
        'work-preview'          => 'App\Filters\Image\Template\WorkPreview',
        'work-preview-se'       => 'App\Filters\Image\Template\WorkPreviewStrategyProject',
        'works'                 => 'App\Filters\Image\Template\Works',
        'portrait'              => 'App\Filters\Image\Template\Portrait',
        'news'                  => 'App\Filters\Image\Template\News',
        'cache'                 => 'App\Filters\Image\Template\Cache',
    ),

    /*
    |--------------------------------------------------------------------------
    | Image Cache Lifetime
    |--------------------------------------------------------------------------
    |
    | Lifetime in minutes of the images handled by the imagecache route.
    |
    */

    'lifetime' => 43200,

);
