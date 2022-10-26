<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Contact extends Model
{
	use HasTranslations;

	protected $table = 'contact';

	public $translatable = [
		'address',
		'imprint',
  ];
  
	protected $fillable = [
		'address',
		'imprint',
		'publish'
	];

	public function images()
	{
		return $this->hasMany('App\Models\ContactImage', 'contact_id', 'id');
  }
  
	public function publishedImages()
	{
		return $this->hasMany('App\Models\ContactImage', 'contact_id', 'id')->where('publish', '=', 1);
	}
}
