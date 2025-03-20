<?php
namespace App\Filters\Image\Template;
use Intervention\Image\Interfaces\ImageInterface;
use App\Models\ProjectImage;

class OpenGraph
{
  protected $max_width  = 1500;    
  protected $max_height = 1500;

  public function applyFilter(ImageInterface $image)
  {
    // Get image dimensions
    $width  = $image->width();
    $height = $image->height();

    // Resize landscape image
    if ($width > $height && $width >= $this->max_width)
    {
      return $image->scale(width: $this->max_width);
    }
    // Resize portrait image
    else if ($height >= $this->max_height)
    {
      return $image->scale(height: $this->max_height);
    }
    
    // Return original image if no resizing needed
    return $image;
  }
}