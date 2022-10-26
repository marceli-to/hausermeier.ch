<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class StrategyProjectImage extends Base
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
    'orientation',
    'is_preview_works',
    'order',
    'publish',
    'strategy_project_id',
	];

  public function strategyProject()
  {
    return $this->belongsTo('App\Models\StrategyProject');
  }
}
