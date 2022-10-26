<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DiscourseImage extends Base
{
	use HasTranslations;

	public $translatable = [
		'caption'
	];

	protected $fillable = [
		'name',
    'caption',
    'is_preview',
		'coords_w',
    'coords_h',
    'coords_x',
    'coords_y',
    'orientation',
    'order',
    'publish',
    'discourse_id',
	];

  public function discourse()
  {
    return $this->belongsTo('App\Models\Discourse');
  }

}
