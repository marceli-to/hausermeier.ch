<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class StrategyProject extends Base
{
	use HasTranslations;

	public $translatable = [
    'category',
    'title',
		'description',
		'info',
		'info_works_1',
		'info_works_2',
	];

	protected $fillable = [
    'category',
    'title',
		'description',
		'info',
		'info_works_1',
		'info_works_2',
		'year',
		'is_strategy_project',
		'project_id',
		'order',
		'publish',
  ];
  
  public function images()
	{
		return $this->hasMany('App\Models\StrategyProjectImage', 'strategy_project_id', 'id')->orderBy('order');
	}

	public function publishedImages()
	{
		return $this->hasMany('App\Models\StrategyProjectImage', 'strategy_project_id', 'id')->orderBy('order')->where('is_preview_works', '=', 0)->where('publish', '=', 1);
	}

	public function previewImage()
	{
		return $this->hasOne('App\Models\StrategyProjectImage', 'strategy_project_id', 'id')->where('publish', '=', 1)->where('is_preview_works', '=', 1);
	}

	public function project()
	{
		return $this->hasOne('App\Models\Project', 'id', 'project_id');
	}
}
