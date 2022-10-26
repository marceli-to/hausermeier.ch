<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class InteractionProject extends Base
{
	use HasTranslations;

	public $translatable = [
    'category',
    'title',
		'description',
		'info'
	];

	protected $fillable = [
    'category',
    'title',
		'description',
    'info',
    'year',
    'link',
    'linkText',
    'video',
    'project_id',
		'order',
		'publish',
  ];
  
  public function images()
	{
		return $this->hasMany('App\Models\InteractionProjectImage', 'interaction_project_id', 'id')->orderBy('order');
	}

	public function publishedImages()
	{
		return $this->hasMany('App\Models\InteractionProjectImage', 'interaction_project_id', 'id')->orderBy('order')->where('publish', '=', 1);
	}
  
	public function project()
	{
		return $this->hasOne('App\Models\Project', 'id', 'project_id');
	}
}
