<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Team extends Base
{
  use HasTranslations;

	protected $table = 'team';

	public $translatable = [
		'role',
		'biography'
	];

	protected $fillable = [
		'firstname',
		'name',
		'role',
    'email',
    'phone',
    'biography',
    'category',
		'order',
		'publish',
  ];

	public function portrait()
	{
		return $this->hasMany('App\Models\TeamPortrait', 'team_id', 'id');
	}

  public function publishedPortrait()
	{
		return $this->hasMany('App\Models\TeamPortrait', 'team_id', 'id')->where('publish', '=', 1);
	} 
		
	public function scopePartner($query)
	{
		return $query->where('category', '=', '1')->orderBy('order', 'ASC');
	}

	public function scopeEmployee($query)
	{
		return $query->where('category', '=', '2')->orderBy('order', 'ASC');
	}
}
