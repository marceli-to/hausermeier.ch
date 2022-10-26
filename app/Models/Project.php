<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Project extends Base
{
	use HasTranslations;

	public $translatable = [
		'name',
		'short_title',
		'location',
		'description',
        'info',
		'type',
		'info_works_1',
		'info_works_2',
	];

	protected $fillable = [
		'name',
		'short_title',
        'location',
        'year',
        'type',
        'description',
		'info',
		'info_works_1',
		'info_works_2',
        'category',
		'program_id',
		'interaction_id',
		'strategy_project_id',
		'has_detail',
		'is_strategy_project',
		'order',
		'publish',
    ];

	public function images()
	{
		return $this->hasMany('App\Models\ProjectImage', 'project_id', 'id')->orderBy('order');
	}

    public function publishedImages()
	{
		return $this->hasMany('App\Models\ProjectImage', 'project_id', 'id')->orderBy('order')->where('publish', '=', 1);
    } 
	
	public function previewImage()
	{
		return $this->hasOne('App\Models\ProjectImage', 'project_id', 'id')->where('publish', '=', 1)->where('is_preview_works', '=', 1);
	}

	public function text()
	{
		return $this->hasMany('App\Models\ProjectText', 'project_id', 'id');
	}

	public function documents()
	{
		return $this->hasMany('App\Models\ProjectDocument', 'project_id', 'id');
	}

	public function publishedDocuments()
	{
		return $this->hasOne('App\Models\ProjectDocument', 'project_id', 'id')->where('publish', '=', 1);
	}

	public function grids()
	{
		return $this->hasMany('App\Models\ProjectGrid', 'project_id', 'id');
    }
    
	public function program()
	{
		return $this->hasOne('App\Models\ProjectProgram', 'id', 'program_id');
    }
    
	public function interactionProject()
	{
		return $this->hasOne('App\Models\InteractionProject', 'id', 'interaction_id');
	}

	public function strategyProject()
	{
		return $this->hasOne('App\Models\StrategyProject', 'id', 'strategy_project_id');
	}
}
