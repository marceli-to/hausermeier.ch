<?php
namespace App\Filters\Image\Template;
use Intervention\Image\Interfaces\ImageInterface;

class Tiny
{
  /**
   * Maximum width for small landscape images
   */    
  protected $max_width = 160;    

  /**
   * Maximum height for small portrait images
   */
  protected $max_height = 80;
  
  public function applyFilter(ImageInterface $image)
  {
    // Get width and height
    $width  = $image->width();
    $height = $image->height();

    // Resize landscape image
    if ($width > $height && $width >= $this->max_width)
    {
      return $image->scale(
        width: $this->max_width
      );
    }
    
    // Resize portrait image
    if ($height > $width && $height >= $this->max_height)
    {
      return $image->scale(
        height: $this->max_height
      );
    }
    
    return $image;
  }
}