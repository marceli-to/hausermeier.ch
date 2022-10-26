<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TeamPortrait extends Base
{
	use HasTranslations;

	public $translatable = [
		'caption'
	];

	protected $fillable = [
		'name',
		'caption',
		'coords_w',
    'coords_h',
    'coords_x',
    'coords_y',
    'category',
    'publish',
    'team_id',
  ];
  
  public function project()
  {
    return $this->belongsTo('App\Models\Team');
  }
}

