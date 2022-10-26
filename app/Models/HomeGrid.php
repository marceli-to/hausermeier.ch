<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;

class HomeGrid extends Base
{
	protected $fillable = [
		'order',
    'publish',
    'layout_id',
  ];
  
	public function layout()
	{
		return $this->hasOne('App\Models\HomeGridLayout', 'id', 'layout_id');
	}

	public function elements()
	{
		return $this->hasMany('App\Models\HomeGridElement', 'grid_id', 'id');
	}

}
