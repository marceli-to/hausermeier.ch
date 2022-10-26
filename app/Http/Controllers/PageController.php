<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class PageController extends BaseController
{
  public function index()
  {
    return view('frontend.static.home');
  }

  public function about()
  {
    return view('frontend.static.about');
  }

  public function jobs()
  {
    return view('frontend.static.jobs');
  }

  // public function contact()
  // {
  //   return view('frontend.static.contact');
  // }
}
