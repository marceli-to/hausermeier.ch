<?php
namespace App\Filters\Image\Template;
use Intervention\Image\Interfaces\ImageInterface;
use App\Models\ProjectImage;
use App\Filters\Image\ImageFilenameExtractor;

class ProjectPreview
{
  use ImageFilenameExtractor;
  
  protected $max_width  = 1600;    
  protected $max_height = 1000;

  public function applyFilter(ImageInterface $image)
  {
    $this->image = new \App\Models\ProjectImage;
    $filename = $this->getFilenameFromImage($image);
    $img = $this->image->where('name', '=', $filename)->get()->first();
    
    // Crop the image if coords are set
    if ($img && $img->coords_w && $img->coords_h)
    {
      // First crop the image
      $image = $image->crop(
        width: floor(floatval($img->coords_w)),
        height: floor(floatval($img->coords_h)),
        offset_x: floor(floatval($img->coords_x ?? 0)),
        offset_y: floor(floatval($img->coords_y ?? 0))
      );
      
      // Then resize it (with aspect ratio) but don't upsize
      return $image->scaleDown(width: $this->max_width);
    }
    
    // Otherwise use cover to match the original fit() method
    $width = $image->width();
    $height = $image->height();
    
    // In both landscape and portrait cases, the original uses fit()
    // which is equivalent to cover() in v3
    if (($width > $height && $width >= $this->max_width) || 
        ($height >= $this->max_height))
    {
      return $image->coverDown(
        width: $this->max_width, 
        height: $this->max_height
      );
    }
    
    return $image;
  }
}