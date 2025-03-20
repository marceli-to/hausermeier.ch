<?php
namespace App\Filters\Image\Template;
use Intervention\Image\Interfaces\ImageInterface;

class Thumbnail
{
  protected $size = 300;
  
  public function applyFilter(ImageInterface $image)
  {
    return $image->cover($this->size, $this->size);
  }
}