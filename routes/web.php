<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\WorksController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('page.home');

// Contact
Route::get('/kontakt', [ContactController::class, 'index'])->name('page.contact');

// Office
Route::get('/buero/ueber-uns', [OfficeController::class, 'about'])->name('page.office.about');
Route::get('/buero/jobs', [OfficeController::class, 'jobs'])->name('page.office.jobs');

// News (a.k.a Discourse)
Route::get('/aktuell', [NewsController::class, 'index'])->name('page.news.index');
Route::get('/aktuell/diskurs', [NewsController::class, 'discourse'])->name('page.news.discourse');
Route::get('/aktuell/publikationen', [NewsController::class, 'publications'])->name('page.news.publications');

// Works
Route::get('/werkliste/jahr', [WorksController::class, 'year'])->name('page.works.year');
Route::get('/werkliste/status', [WorksController::class, 'state'])->name('page.works.state');
Route::get('/werkliste/thema', [WorksController::class, 'topic'])->name('page.works.topic');

// Interaction
Route::get('/interaktionen', [InteractionController::class, 'index'])->name('page.interaction.index');

// Projects
Route::get('/projekt/{project}/{slug?}', [ProjectController::class, 'show'])->name('page.project.show');
Route::get('/projekte/strategien-und-entwicklungen', [ProjectController::class, 'strategyAndDevelopment'])->name('page.project.se');

// Image routes
Route::get('/img/{template}/{filename}/{size?}', [ImageController::class, 'getResponse']);


/*
|--------------------------------------------------------------------------
| Admin Web routes
|--------------------------------------------------------------------------
|
*/

Route::view('admin', 'backend.app');
Route::get('admin/{any}', function () {
	return view('backend.app');
})->where('any', '.*');