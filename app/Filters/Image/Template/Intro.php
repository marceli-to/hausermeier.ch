<?php
namespace App\Filters\Image\Template;
use Intervention\Image\Interfaces\ImageInterface;
use App\Models\IntroImage;
use App\Filters\Image\ImageFilenameExtractor;

class Intro
{
  use ImageFilenameExtractor;
  
  protected $max_width  = 2000;    
  protected $max_height = 750;

  public function applyFilter(ImageInterface $image)
  {
    $this->image = new IntroImage;
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
    
    // Otherwise just resize the image
    $width = $image->width();
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
    
    return $image;
  }
}