<?php
namespace App\Filters\Image\Template;
use Intervention\Image\Interfaces\ImageInterface;
use App\Models\TeamImage;
use App\Filters\Image\ImageFilenameExtractor;

class Team
{
  use ImageFilenameExtractor;
  
  protected $max_width  = 1200;    
  protected $max_height = 1200;

  public function applyFilter(ImageInterface $image)
  {
    $this->image = new \App\Models\TeamImage;
    $filename = $this->getFilenameFromImage($image);
    $img = $this->image->where('name', '=', $filename)->get()->first();
    
    // Crop the image if coords are set
    if ($img && $img->coords_w && $img->coords_h)
    {
      // In v3, crop with named parameters
      $image = $image->crop(
        floor(floatval($img->coords_w)), 
        floor(floatval($img->coords_h)),
        floor(floatval($img->coords_x ?? 0)), 
        floor(floatval($img->coords_y ?? 0))
      );
      
      // In v3, use scaleDown to prevent upscaling
      return $image->scaleDown(
        width: $this->max_width
      );
    }
    
    // Otherwise just resize the image without upscaling
    return $image->scaleDown(
      width: $this->max_width
    );
  }
}