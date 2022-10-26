<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

// Home
Route::get('/', 'HomeController@index')->name('page.home');

// Contact
Route::get('/kontakt', 'ContactController@index')->name('page.contact');

// Office
Route::get('/buero/ueber-uns', 'OfficeController@about')->name('page.office.about');
Route::get('/buero/jobs', 'OfficeController@jobs')->name('page.office.jobs');

// News (a.k.a Discourse)
Route::get('/aktuell', 'NewsController@index')->name('page.news.index');
Route::get('/aktuell/diskurs', 'NewsController@discourse')->name('page.news.discourse');
Route::get('/aktuell/publikationen', 'NewsController@publications')->name('page.news.publications');

// Works
Route::get('/werkliste/jahr', 'WorksController@year')->name('page.works.year');
Route::get('/werkliste/status', 'WorksController@state')->name('page.works.state');
Route::get('/werkliste/thema', 'WorksController@topic')->name('page.works.topic');

// Interaction
Route::get('/interaktionen', 'InteractionController@index')->name('page.interaction.index');

// Projects
Route::get('/projekt/{project}/{slug?}', 'ProjectController@show')->name('page.project.show');
Route::get('/projekte/strategien-und-entwicklungen', 'ProjectController@strategyAndDevelopment')->name('page.project.se');

// Image routes
Route::get('/img/{template}/{filename}/{size?}', 'ImageController@getResponse');


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
