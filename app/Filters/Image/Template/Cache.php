<?php
namespace App\Filters\Image\Template;
use Intervention\Image\Interfaces\ImageInterface;
use App\Models\ProjectImage;

class Cache
{
  protected $max_width  = 2000;    
  protected $max_height = 1250;
  protected $size = null;

  public function __construct($size = null)
  {
    $this->size = $size;
  }

  public function applyFilter(ImageInterface $image)
  {
    // Get image dimensions
    $width  = $image->width();
    $height = $image->height();

    // Resize landscape image
    if ($width > $height && $width >= $this->max_width)
    {
      return $image->scaleDown(
        width: $this->size
      );
    }
    // Resize portrait image
    else if ($height >= $this->max_height)
    {
      return $image->scaleDown(
        height: $this->size
      );
    }
    
    return $image;
  }
}