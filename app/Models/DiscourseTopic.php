<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DiscourseTopic extends Base
{
	use HasTranslations;

	public $translatable = [
		'title'
	];

	protected $fillable = [
		'title',
    'publish',
	];
}