<?php
namespace App\Filters\Image\Template;
use Intervention\Image\Interfaces\ImageInterface;
use App\Models\ProjectImage;

class Lightbox
{
  protected $max_width  = 2000;    
  protected $max_height = 1500;

  public function applyFilter(ImageInterface $image)
  {
    // Get image dimensions
    $width  = $image->width();
    $height = $image->height();

    // Resize landscape image
    if ($width > $height && $width >= $this->max_width)
    {
      return $image->scaleDown(width: $this->max_width);
    }
    // Resize portrait image
    else if ($height >= $this->max_height)
    {
      return $image->scaleDown(height: $this->max_height);
    }
    
    // Return original image if no resizing needed
    return $image;
  }
}