<?php
namespace App\Filters\Image\Template;
use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;
use App\Models\ProjectImage;

class ProjectTiny implements FilterInterface
{
  protected $max_width  = 160;    
  protected $max_height = 120;

  public function applyFilter(Image $image)
  {
    $this->image = new \App\Models\ProjectImage;
    $img = $this->image->where('name', '=', $image->basename)->get()->first();
    
    // Crop the image if coords are set
    if ($img && $img->coords_w && $img->coords_h)
    {
      $image->crop(floor($img->coords_w), floor($img->coords_h), floor($img->coords_x), floor($img->coords_y));

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