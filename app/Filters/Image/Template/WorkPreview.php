<?php
namespace App\Filters\Image\Template;
use Intervention\Image\Interfaces\ImageInterface;
use App\Models\ProjectImage;
use App\Filters\Image\ImageFilenameExtractor;

class WorkPreview
{
  use ImageFilenameExtractor;

  protected $max_width  = 1000;    
  protected $max_height = 666;

  public function applyFilter(ImageInterface $image)
  {
    $this->image = new \App\Models\ProjectImage;
    $filename = $this->getFilenameFromImage($image);
    $img = $this->image->where('name', '=', $filename)->get()->first();
    
    // Crop the image if coords are set
    if ($img && $img->coords_w && $img->coords_h)
    {
      // First crop the image with correct parameters
      $image = $image->crop(
        width: floor(floatval($img->coords_w)), 
        height: floor(floatval($img->coords_h)),
        offset_x: floor(floatval($img->coords_x ?? 0)), 
        offset_y: floor(floatval($img->coords_y ?? 0))
      );
      
      // Then resize it to fit within the dimensions
      return $image->coverDown(
        width: $this->max_width, 
        height: $this->max_height
      );
    }
    
    // Otherwise just resize the image
    $width = $image->width();
    $height = $image->height();
    
    // In v3, use coverDown to replace fit with constraints
    // This will resize the image to cover the dimensions while preventing upscaling
    return $image->coverDown(
      width: $this->max_width, 
      height: $this->max_height
    );
  }
}