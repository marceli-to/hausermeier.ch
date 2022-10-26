<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Discourse extends Base
{
	use HasTranslations;

	public $translatable = [
		'title',
		'description',
		'info',
	];

	protected $fillable = [
		'date',
		'title',
		'description',
		'info',
		'is_all',
		'is_discourse',
		'is_publication',
		'project_id',
		'interaction_project_id',
		'strategy_project_id',
		'order',
		'publish',
  ];
  
  public function setDateAttribute($value)
  {
    $this->attributes['date'] = \Carbon\Carbon::parse($value)->format('Y.m.d');
	}
	
	public function getDateAttribute($value)
	{
		return \Carbon\Carbon::parse($value)->format('d.m.Y');
	}

	public function images()
	{
		return $this->hasMany('App\Models\DiscourseImage', 'discourse_id', 'id')->orderBy('order');
	}

	public function previewImage()
	{
		return $this->hasOne('App\Models\DiscourseImage', 'discourse_id', 'id')->where('publish', '=', 1)->where('is_preview', '=', 1);
	}

	public function publishedImages()
	{
		return $this->hasMany('App\Models\DiscourseImage', 'discourse_id', 'id')->where('publish', '=', 1)->orderBy('order');
	}

	public function documents()
	{
		return $this->hasMany('App\Models\DiscourseDocument', 'discourse_id', 'id');
  }
	
	public function publishedDocuments()
	{
		return $this->hasMany('App\Models\DiscourseDocument', 'discourse_id', 'id')->where('publish', '=', 1);
	}

	public function project()
	{
		return $this->hasOne('App\Models\Project', 'id', 'project_id');
	}

	public function interactionProject()
	{
		return $this->hasOne('App\Models\InteractionProject', 'id', 'interaction_project_id');
	}

	public function strategyProject()
	{
		return $this->hasOne('App\Models\StrategyProject', 'id', 'strategy_project_id');
	}
}
