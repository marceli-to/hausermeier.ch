<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HomeNewsImage extends Base
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
    'publish',
    'home_news_id',
	];

  public function home_news()
  {
    return $this->belongsTo('App\Models\HomeNews');
  }

}
