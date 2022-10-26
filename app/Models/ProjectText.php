<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProjectText extends Base
{
	use HasTranslations;

	public $translatable = [
		'text',
	];

	protected $fillable = [
		'text',
		'project_id',
		'publish',
	];
	
  public function project()
  {
    return $this->belongsTo('App\Models\Project');
  }
}
