<?php
namespace App\Filters\Image\Template;
use Intervention\Image\Interfaces\ImageInterface;
use App\Models\StrategyProjectImage;
use App\Filters\Image\ImageFilenameExtractor;

class WorkPreviewStrategyProject
{
  use ImageFilenameExtractor;
  
  protected $max_width  = 1000;    
  protected $max_height = 666;

  public function applyFilter(ImageInterface $image)
  {
    $this->image = new \App\Models\StrategyProjectImage;
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
      
      // In v3, use cover() to replace fit() with constraints
      return $image->cover(
        width: $this->max_width, 
        height: $this->max_height
      );
    }
    
    // Otherwise just resize the image
    return $image->cover(
      width: $this->max_width, 
      height: $this->max_height
    );
  }
}