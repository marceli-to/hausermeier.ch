<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HomeNews extends Base
{
	use HasTranslations;

	public $translatable = [
    'date',
		'title',
		'short_title',
    'description',
    'link',
		'linkText',
	];

	protected $fillable = [
		'date',
		'title',
		'short_title',
		'description',
    'link',
    'linkText',
    'layout',
		'publish',
  ];

	public function images()
	{
		return $this->hasMany('App\Models\HomeNewsImage', 'home_news_id', 'id');
	}

  public function publishedImages()
	{
		return $this->hasOne('App\Models\HomeNewsImage', 'home_news_id', 'id')->where('publish', '=', 1);
	}
  
}