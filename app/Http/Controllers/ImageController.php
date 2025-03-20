<?php
namespace App\Http\Controllers;
use App\Services\ImageCache;
use Illuminate\Http\Request;
use Intervention\Image\Interfaces\EncodedImageInterface;
use Intervention\Image\Interfaces\ImageInterface;

class ImageController extends Controller
{
    protected $imageCache;

    public function __construct(ImageCache $imageCache)
    {
        $this->imageCache = $imageCache;
    }

    /**
     * Process and serve an image with the given template
     *
     * @param string $template
     * @param string $filename
     * @param string|null $size
     * @return \Illuminate\Http\Response
     */
    public function getResponse($template, $filename, $size = NULL)
    {
        $image = $this->imageCache->get($template, $filename);
        
        // Get the file extension
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        
        // Encode the image with the original format
        $encoded = $image->encodeByExtension($extension, quality: 100);
        
        // Return a response with the encoded image
        return $this->createImageResponse($encoded);
    }

    /**
     * Process and serve an image with the given template (alias for getResponse)
     *
     * @param string $template
     * @param string $filename
     * @return \Illuminate\Http\Response
     */
    public function serve($template, $filename)
    {
        return $this->getResponse($template, $filename);
    }
    
    /**
     * Create an HTTP response from an encoded image
     *
     * @param EncodedImageInterface $encoded
     * @return \Illuminate\Http\Response
     */
    protected function createImageResponse(EncodedImageInterface $encoded)
    {
        return response($encoded->toString())
            ->header('Content-Type', $encoded->mediaType())
            ->header('Content-Length', strlen($encoded->toString()));
    }
}
