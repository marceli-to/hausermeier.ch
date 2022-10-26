<?php
namespace App\Filters\Image\Template;
use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;
use App\Models\ProjectImage;

class ProjectFull implements FilterInterface
{
  protected $max_width  = 2000;    
  protected $max_height = 1500;

  public function applyFilter(Image $image)
  {
    // Otherwise just resize the image
    $width  = $image->getWidth();
    $height = $image->getHeight();

    // Resize landscape image
    if ($width > $height && $width >= $this->max_width)
    {
      $image->resize($this->max_width, null, function ($constraint) {
        return $constraint->aspectRatio();
      });
    }
    else if ($height >= $this->max_height)
    {
      $image->resize(null, $this->max_height, function ($constraint) {
        return $constraint->aspectRatio();
      });
    }
    return $image;
  }
}