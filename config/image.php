<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Image Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default image driver that will be used by
    | Intervention Image. This is separate from Laravel's "disk" configuration
    | and specifies how the image manipulation will be performed.
    |
    | Supported: "\Intervention\Image\Drivers\Gd\Driver"
    |           "\Intervention\Image\Drivers\Imagick\Driver"
    |
    */

    'driver' => \Intervention\Image\Drivers\Gd\Driver::class,

    /*
    |--------------------------------------------------------------------------
    | Image Cache Path
    |--------------------------------------------------------------------------
    |
    | Specify the path where the cached images will be stored. This path
    | will be used by the ImageCache service to store processed images.
    |
    */

    'cache_path' => 'cache/images',
];
