<?php
namespace App\Filters\Image\Template;
use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;
use App\Models\ProjectImage;

class WorkPreview implements FilterInterface
{
  protected $max_width  = 1000;    
  protected $max_height = 666;

  public function applyFilter(Image $image)
  {
    $this->image = new \App\Models\ProjectImage;
    $img = $this->image->where('name', '=', $image->basename)->get()->first();
    
    // Crop the image if coords are set
    if ($img && $img->coords_w && $img->coords_h)
    {
      return 
        $image->crop(floor(floatval($img->coords_w)), floor(floatval($img->coords_h)), floor(floatval($img->coords_x)), floor(floatval($img->coords_y)))
              ->fit($this->max_width, $this->max_height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
        });
    }

    // Otherwise just resize the image
    $width  = $image->getWidth();
    $height = $image->getHeight();

    // Resize landscape image
    if ($width > $height && $width >= $this->max_width)
    {
      $image->fit($this->max_width, $this->max_height, function ($constraint) {
        return $constraint->aspectRatio();
      });
    }
    else if ($height >= $this->max_height)
    {
      $image->fit($this->max_width, $this->max_height, function ($constraint) {
        return $constraint->aspectRatio();
      });
    }
    return $image;
  }
}