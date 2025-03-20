<?php
namespace App\Filters\Image\Template;
use Intervention\Image\Interfaces\ImageInterface;
use App\Models\DiscourseImage;
use App\Filters\Image\ImageFilenameExtractor;

class Discourse
{
  use ImageFilenameExtractor;
  
  protected $max_width  = 2000;    
  protected $max_height = 1250;

  public function applyFilter(ImageInterface $image)
  {
    $this->image = new \App\Models\DiscourseImage;
    $filename = $this->getFilenameFromImage($image);
    $img = $this->image->where('name', '=', $filename)->get()->first();
    
    // Crop the image if coords are set
    if ($img && $img->coords_w && $img->coords_h)
    {
      // In v3, crop with named parameters
      $image = $image->crop(
        width: floor(floatval($img->coords_w)), 
        height: floor(floatval($img->coords_h)),
        offset_x: floor(floatval($img->coords_x ?? 0)), 
        offset_y: floor(floatval($img->coords_y ?? 0))
      );
      
      // Use scaleDown to match resize with aspectRatio and upsize constraints
      return $image->scaleDown(
        width: $this->max_width
      );
    }

    // Otherwise just resize the image using the same logic as the original
    $width = $image->width();
    $height = $image->height();

    // Resize landscape image
    if ($width > $height && $width >= $this->max_width)
    {
      return $image->scaleDown(
        width: $this->max_width
      );
    }
    // Resize portrait image
    else if ($height >= $this->max_height)
    {
      return $image->scaleDown(
        height: $this->max_height
      );
    }
    
    return $image;
  }
}