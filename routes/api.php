<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

/**
 * Api routes
 */

Route::middleware('auth:api')->group(function() {
    
  /**
   * Job routes
   */
  Route::get('jobs/get', 'Api\JobController@get');
  Route::get('job/get/{job}', 'Api\JobController@getOne');
  Route::post('job/create', 'Api\JobController@store');
  Route::get('job/edit/{job}', 'Api\JobController@edit');
  Route::post('job/update/{job}', 'Api\JobController@update');
  Route::get('job/status/{job}', 'Api\JobController@status');
  Route::post('job/order', 'Api\JobController@order');
  Route::delete('job/destroy/{job}', 'Api\JobController@destroy');

  /**
   * Job image routes
   */
  Route::get('job/image/status/{id}', 'Api\JobImageController@status');
  Route::delete('job/image/destroy/{jobImage}', 'Api\JobImageController@destroy');
  Route::post('job/image/coords/{jobImage}', 'Api\JobImageController@coords');

  /**
   * Team routes
   */
  Route::get('teams/get', 'Api\TeamController@get');
  Route::get('team/get/{team}', 'Api\TeamController@getOne');
  Route::post('team/create', 'Api\TeamController@store');
  Route::get('team/edit/{team}', 'Api\TeamController@edit');
  Route::post('team/update/{team}', 'Api\TeamController@update');
  Route::get('team/status/{team}', 'Api\TeamController@status');
  Route::post('team/order', 'Api\TeamController@order');
  Route::delete('team/destroy/{team}', 'Api\TeamController@destroy');

  /**
   * TeamPortrait routes
   */
  Route::get('team/portrait/status/{id}', 'Api\TeamPortraitController@status');
  Route::delete('team/portrait/destroy/{teamPortrait}', 'Api\TeamPortraitController@destroy');
  Route::post('team/portrait/coords/{teamPortrait}', 'Api\TeamPortraitController@coords');

  /**
   * TeamImage routes
   */
  Route::get('team/images/get', 'Api\TeamImageController@get');
  Route::post('team/image/create', 'Api\TeamImageController@store');
  Route::get('team/image/edit/{image}', 'Api\TeamImageController@edit');
  Route::post('team/image/update/{image}', 'Api\TeamImageController@update');
  Route::get('team/image/status/{image}', 'Api\TeamImageController@status');
  Route::post('team/image/coords/{teamImage}', 'Api\TeamImageController@coords');
  Route::delete('team/image/destroy/{image}', 'Api\TeamImageController@destroy');

  /**
   * Profile routes
   */
  Route::get('profile/get', 'Api\ProfileController@get');
  Route::post('profile/create', 'Api\ProfileController@store');
  Route::get('profile/edit/{profile}', 'Api\ProfileController@edit');
  Route::post('profile/update/{profile}', 'Api\ProfileController@update');
  Route::get('profile/status/{profile}', 'Api\ProfileController@status');
  Route::delete('profile/destroy/{profile}', 'Api\ProfileController@destroy');

  /**
   * ProfileImage routes
   */
  Route::get('profile/images/get', 'Api\ProfileImageController@get');
  Route::post('profile/image/create', 'Api\ProfileImageController@store');
  Route::get('profile/image/edit/{image}', 'Api\ProfileImageController@edit');
  Route::post('profile/image/update/{image}', 'Api\ProfileImageController@update');
  Route::get('profile/image/status/{image}', 'Api\ProfileImageController@status');
  Route::delete('profile/image/destroy/{image}', 'Api\ProfileImageController@destroy');
  Route::post('profile/image/coords/{profileImage}', 'Api\ProfileImageController@coords');
 
  /**
   * Project routes
   */
  Route::get('projects/get', 'Api\ProjectController@get');
  Route::get('project/get/{project}', 'Api\ProjectController@getOne');
  Route::post('project/create', 'Api\ProjectController@store');
  Route::get('project/edit/{project}', 'Api\ProjectController@edit');
  Route::post('project/update/{project}', 'Api\ProjectController@update');
  Route::get('project/status/{project}', 'Api\ProjectController@status');
  Route::post('project/order', 'Api\ProjectController@order');
  Route::delete('project/destroy/{project}', 'Api\ProjectController@destroy');

  /**
   * ProjectImage routes
   */
  Route::get('project/image/get/{projectId}', 'Api\ProjectImageController@get');
  Route::get('project/image/status/{id}', 'Api\ProjectImageController@status');
  Route::post('project/image/coords/{projectImage}', 'Api\ProjectImageController@coords');
  Route::post('project/image/order', 'Api\ProjectImageController@order');
  Route::delete('project/image/destroy/{projectImage}', 'Api\ProjectImageController@destroy');

  /**
   * ProjectText routes
   */
  Route::get('project/text/get/{project}', 'Api\ProjectTextController@get');
  Route::get('project/text/get/published/{project}', 'Api\ProjectTextController@getPublished');
  Route::get('project/text/get/{projectText}', 'Api\ProjectTextController@getOne');
  Route::post('project/text/create', 'Api\ProjectTextController@store');
  Route::get('project/text/edit/{projectText}', 'Api\ProjectTextController@edit');
  Route::post('project/text/update/{projectText}', 'Api\ProjectTextController@update');
  Route::get('project/text/status/{projectText}', 'Api\ProjectTextController@status');
  Route::delete('project/text/destroy/{projectText}', 'Api\ProjectTextController@destroy');

  /**
   * ProjectDocument routes
   */
  Route::get('project/document/status/{id}', 'Api\ProjectDocumentController@status');
  Route::delete('project/document/destroy/{projectFile}', 'Api\ProjectDocumentController@destroy');

  /**
   * ProjectProgram routes
   */
  Route::get('project/program/get', 'Api\ProjectProgramController@get');
  Route::post('project/program/create', 'Api\ProjectProgramController@store');
  Route::get('project/program/edit/{projectProgram}', 'Api\ProjectProgramController@edit');
  Route::post('project/program/update/{projectProgram}', 'Api\ProjectProgramController@update');
  Route::get('project/program/status/{projectProgram}', 'Api\ProjectProgramController@status');
  Route::delete('project/program/destroy/{projectProgram}', 'Api\ProjectProgramController@destroy');
  Route::post('project/program/order', 'Api\ProjectProgramController@order');


  /**
   * Project grid routes
   */
  Route::get('project/grids/{id}', 'Api\ProjectGridController@get');
  Route::post('project/grids/order', 'Api\ProjectGridController@order');
  Route::get('project/grid/store/{projectId}/{layoutId}', 'Api\ProjectGridController@store');
  Route::delete('project/grid/delete/{id}', 'Api\ProjectGridController@destroy');
  Route::get('project/grid/layouts', 'Api\ProjectGridLayoutController@get');
  Route::get('project/grid/elements/{gridId}', 'Api\ProjectGridElementController@get');
  Route::post('project/grid/element/store', 'Api\ProjectGridElementController@store');
  Route::delete('project/grid/element/delete/{id}', 'Api\ProjectGridElementController@destroy');

  /**
   * Discourse routes
   */
  Route::get('discourses/get', 'Api\DiscourseController@get');
  Route::get('discourse/get/{discourse}', 'Api\DiscourseController@getOne');
  Route::post('discourse/create', 'Api\DiscourseController@store');
  Route::get('discourse/edit/{discourse}', 'Api\DiscourseController@edit');
  Route::post('discourse/update/{discourse}', 'Api\DiscourseController@update');
  Route::get('discourse/status/{discourse}', 'Api\DiscourseController@status');
  Route::post('discourse/order', 'Api\DiscourseController@order');
  Route::delete('discourse/destroy/{discourse}', 'Api\DiscourseController@destroy');

  /**
   * DiscourseImage routes
   */
  Route::get('discourse/image/get/{discourseId}', 'Api\DiscourseImageController@get');
  Route::get('discourse/image/status/{id}', 'Api\DiscourseImageController@status');
  Route::post('discourse/image/coords/{discourseImage}', 'Api\DiscourseImageController@coords');
  Route::post('discourse/image/order', 'Api\DiscourseImageController@order');
  Route::delete('discourse/image/destroy/{discourseImage}', 'Api\DiscourseImageController@destroy');

  /**
   * DiscourseDocument routes
   */
  Route::get('discourse/document/status/{id}', 'Api\DiscourseDocumentController@status');
  Route::delete('discourse/document/destroy/{discourseFile}', 'Api\DiscourseDocumentController@destroy');

  /**
   * DiscourseTopic routes
   */
  Route::get('discourse/topic/get', 'Api\DiscourseTopicController@get');
  Route::post('discourse/topic/create', 'Api\DiscourseTopicController@store');
  Route::get('discourse/topic/edit/{discourseTopic}', 'Api\DiscourseTopicController@edit');
  Route::post('discourse/topic/update/{discourseTopic}', 'Api\DiscourseTopicController@update');
  Route::get('discourse/topic/status/{discourseTopic}', 'Api\DiscourseTopicController@status');
  Route::delete('discourse/topic/destroy/{discourseTopic}', 'Api\DiscourseTopicController@destroy');

  /**
   * InteractionProject routes
   */
  Route::get('interaction/projects/get', 'Api\InteractionProjectController@get');
  Route::get('interaction/project/get/{interactionProject}', 'Api\InteractionProjectController@getOne');
  Route::post('interaction/project/create', 'Api\InteractionProjectController@store');
  Route::get('interaction/project/edit/{interactionProject}', 'Api\InteractionProjectController@edit');
  Route::post('interaction/project/update/{interactionProject}', 'Api\InteractionProjectController@update');
  Route::get('interaction/project/status/{interactionProject}', 'Api\InteractionProjectController@status');
  Route::post('interaction/project/order', 'Api\InteractionProjectController@order');
  Route::delete('interaction/project/destroy/{interactionProject}', 'Api\InteractionProjectController@destroy');

  /**
   * InteractionProjectImage routes
   */
  Route::get('interaction/project/image/get/{interactionProjectId}', 'Api\InteractionProjectImageController@get');
  Route::get('interaction/project/image/status/{id}', 'Api\InteractionProjectImageController@status');
  Route::post('interaction/project/image/coords/{interactionProjectImage}', 'Api\InteractionProjectImageController@coords');
  Route::post('interaction/project/image/order', 'Api\InteractionProjectImageController@order');
  Route::delete('interaction/project/image/destroy/{interactionProjectImage}', 'Api\InteractionProjectImageController@destroy');

  /**
   * Contact routes
   */
  Route::get('contact/get', 'Api\ContactController@get');
  Route::post('contact/create', 'Api\ContactController@store');
  Route::get('contact/edit/{contact}', 'Api\ContactController@edit');
  Route::post('contact/update/{contact}', 'Api\ContactController@update');
  Route::get('contact/status/{contact}', 'Api\ContactController@status');

  /**
   * Contact image routes
   */
  Route::get('contact/image/status/{id}', 'Api\ContactImageController@status');
  Route::delete('contact/image/destroy/{contactImage}', 'Api\ContactImageController@destroy');
  Route::post('contact/image/coords/{contactImage}', 'Api\ContactImageController@coords');

  /**
   * Settings routes
   */
  Route::get('settings/projectState', 'Api\SettingsController@projectState');
  Route::get('settings/projectCategories', 'Api\SettingsController@projectCategories');
  Route::get('settings/teamCategories', 'Api\SettingsController@teamCategories');
  Route::get('settings/newsLayout', 'Api\SettingsController@newsLayout');

  /**
   * Upload routes
   */
  Route::post('media/upload','Api\MediaController@upload');
  
  /**
   * HomeNews routes
   */
  Route::get('home/news/get', 'Api\HomeNewsController@get');
  Route::get('home/news/get/published', 'Api\HomeNewsController@getPublished');
  Route::get('home/news/get/{homeNews}', 'Api\HomeNewsController@getOne');
  Route::post('home/news/create', 'Api\HomeNewsController@store');
  Route::get('home/news/edit/{homeNews}', 'Api\HomeNewsController@edit');
  Route::post('home/news/update/{homeNews}', 'Api\HomeNewsController@update');
  Route::get('home/news/status/{homeNews}', 'Api\HomeNewsController@status');
  Route::post('home/news/order', 'Api\HomeNewsController@order');
  Route::delete('home/news/destroy/{homeNews}', 'Api\HomeNewsController@destroy');

  /**
   * HomeNewsImages routes
   */
  Route::get('home/news/image/get/{homeNewsId}', 'Api\HomeNewsImageController@get');
  Route::get('home/news/image/status/{id}', 'Api\HomeNewsImageController@status');
  Route::post('home/news/image/coords/{homeNewsImage}', 'Api\HomeNewsImageController@coords');
  Route::delete('home/news/image/destroy/{homeNewsImage}', 'Api\HomeNewsImageController@destroy');
  
  /**
   * HomeGrid routes
   */
  Route::get('home/grids', 'Api\HomeGridController@get');
  Route::post('home/grids/order', 'Api\HomeGridController@order');
  Route::get('home/grid/store/{layoutId}', 'Api\HomeGridController@store');
  Route::delete('home/grid/delete/{id}', 'Api\HomeGridController@destroy');
  Route::get('home/grid/layouts', 'Api\HomeGridLayoutController@get');
  Route::get('home/grid/elements/{gridId}', 'Api\HomeGridElementController@get');
  Route::post('home/grid/element/store', 'Api\HomeGridElementController@store');
  Route::delete('home/grid/element/delete/{id}', 'Api\HomeGridElementController@destroy');

  /**
   * Intro routes
   */
  Route::get('intro/get/{type}', 'Api\IntroController@get');
  Route::post('intro/create', 'Api\IntroController@store');
  Route::get('intro/edit/{intro}', 'Api\IntroController@edit');
  Route::post('intro/update/{intro}', 'Api\IntroController@update');
  Route::get('intro/status/{intro}', 'Api\IntroController@status');
  Route::delete('intro/destroy/{intro}', 'Api\IntroController@destroy');

  /**
   * IntroImage routes
   */
  Route::get('intro/images/get', 'Api\IntroImageController@get');
  Route::post('intro/image/create', 'Api\IntroImageController@store');
  Route::get('intro/image/edit/{image}', 'Api\IntroImageController@edit');
  Route::post('intro/image/update/{image}', 'Api\IntroImageController@update');
  Route::get('intro/image/status/{image}', 'Api\IntroImageController@status');
  Route::delete('intro/image/destroy/{image}', 'Api\IntroImageController@destroy');
  Route::post('intro/image/coords/{introImage}', 'Api\IntroImageController@coords');

/**
   * StrategyProject routes
   */
  Route::get('strategy/projects/get', 'Api\StrategyProjectController@get');
  Route::get('strategy/project/get/{strategyProject}', 'Api\StrategyProjectController@getOne');
  Route::post('strategy/project/create', 'Api\StrategyProjectController@store');
  Route::get('strategy/project/edit/{strategyProject}', 'Api\StrategyProjectController@edit');
  Route::post('strategy/project/update/{strategyProject}', 'Api\StrategyProjectController@update');
  Route::get('strategy/project/status/{strategyProject}', 'Api\StrategyProjectController@status');
  Route::post('strategy/project/order', 'Api\StrategyProjectController@order');
  Route::delete('strategy/project/destroy/{strategyProject}', 'Api\StrategyProjectController@destroy');

  /**
   * StrategyProjectControllerImage routes
   */
  Route::get('strategy/project/image/get/{strategyProjectId}', 'Api\StrategyProjectImageController@get');
  Route::get('strategy/project/image/status/{id}', 'Api\StrategyProjectImageController@status');
  Route::post('strategy/project/image/coords/{strategyProjectImage}', 'Api\StrategyProjectImageController@coords');
  Route::post('strategy/project/image/order', 'Api\StrategyProjectImageController@order');
  Route::delete('strategy/project/image/destroy/{strategyProjectImage}', 'Api\StrategyProjectImageController@destroy');

});

/**
 * Auth routes
 */

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
  Route::post('login', 'AuthController@login');
  Route::post('logout', 'AuthController@logout');
  Route::post('refresh', 'AuthController@refresh');
  Route::post('me', 'AuthController@me');
});


/**
 * Fallback if no route is defined
 */

Route::fallback(function(){
  return response()->json(
    ['message' => 'Page Not Found. If error persists, contact m@marceli.to'],
    404
  );
});