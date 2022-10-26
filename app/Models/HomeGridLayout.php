<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class HomeGridLayout extends Model
{
	protected $fillable = ['key'];

  public function grid()
  {
    return $this->belongsTo('App\Models\HomeGrid');
  }
}
