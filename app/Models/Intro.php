<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Intro extends Base
{
	use HasTranslations;

	public $translatable = [
    'text_intro',
    'text_column_1',
    'text_column_2',
    'text_column_3',
  ];
  
	protected $fillable = [
    'text_intro',
    'text_column_1',
    'text_column_2',
    'text_column_3',
    'type',
    'publish'
  ];

	public function images()
	{
		return $this->hasMany('App\Models\IntroImage', 'intro_id', 'id');
	}
}
