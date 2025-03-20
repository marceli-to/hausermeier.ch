<?php
namespace App\Filters\Image\Template;
use Intervention\Image\Interfaces\ImageInterface;
use App\Models\ProjectImage;
use App\Filters\Image\ImageFilenameExtractor;

class ProjectTiny
{
  use ImageFilenameExtractor;
  
  protected $max_width  = 160;    
  protected $max_height = 120;

  public function applyFilter(ImageInterface $image)
  {
    $this->image = new \App\Models\ProjectImage;
    $filename = $this->getFilenameFromImage($image);
    $img = $this->image->where('name', '=', $filename)->get()->first();
    
    // Crop the image if coords are set
    if ($img && $img->coords_w && $img->coords_h)
    {
      $image = $image->crop(
        floor(floatval($img->coords_w)), 
        floor(floatval($img->coords_h)),
        floor(floatval($img->coords_x ?? 0)), 
        floor(floatval($img->coords_y ?? 0))
      );

      $width  = $image->width();
      $height = $image->height();
  
      // Resize landscape image
      if ($width > $height && $width > $this->max_width)
      {
        return $image->scale(
          width: $this->max_width
        );
      }
      
      // Resize portrait image
      if ($height > $width && $height > $this->max_height)
      {
        return $image->scale(
          height: $this->max_height
        );
      }
    }
    
    // If no coords are set or no resizing needed, just resize to max dimensions
    $width  = $image->width();
    $height = $image->height();
    
    if ($width > $height && $width > $this->max_width)
    {
      return $image->scale(
        width: $this->max_width
      );
    }
    
    if ($height > $width && $height > $this->max_height)
    {
      return $image->scale(
        height: $this->max_height
      );
    }
    
    return $image;
  }
}