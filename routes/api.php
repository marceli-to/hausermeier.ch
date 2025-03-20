<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\JobImageController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\TeamPortraitController;
use App\Http\Controllers\Api\TeamImageController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ProfileImageController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ProjectImageController;
use App\Http\Controllers\Api\ProjectTextController;
use App\Http\Controllers\Api\ProjectDocumentController;
use App\Http\Controllers\Api\ProjectProgramController;
use App\Http\Controllers\Api\ProjectGridController;
use App\Http\Controllers\Api\ProjectGridLayoutController;
use App\Http\Controllers\Api\ProjectGridElementController;
use App\Http\Controllers\Api\DiscourseController;
use App\Http\Controllers\Api\DiscourseImageController;
use App\Http\Controllers\Api\DiscourseDocumentController;
use App\Http\Controllers\Api\DiscourseTopicController;
use App\Http\Controllers\Api\InteractionProjectController;
use App\Http\Controllers\Api\InteractionProjectImageController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ContactImageController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\HomeNewsController;
use App\Http\Controllers\Api\HomeNewsImageController;
use App\Http\Controllers\Api\HomeGridController;
use App\Http\Controllers\Api\HomeGridLayoutController;
use App\Http\Controllers\Api\HomeGridElementController;
use App\Http\Controllers\Api\IntroController;
use App\Http\Controllers\Api\IntroImageController;
use App\Http\Controllers\Api\StrategyProjectController;
use App\Http\Controllers\Api\StrategyProjectImageController;

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
  Route::get('jobs/get', [JobController::class, 'get']);
  Route::get('job/get/{job}', [JobController::class, 'getOne']);
  Route::post('job/create', [JobController::class, 'store']);
  Route::get('job/edit/{job}', [JobController::class, 'edit']);
  Route::post('job/update/{job}', [JobController::class, 'update']);
  Route::get('job/status/{job}', [JobController::class, 'status']);
  Route::post('job/order', [JobController::class, 'order']);
  Route::delete('job/destroy/{job}', [JobController::class, 'destroy']);

  /**
   * Job image routes
   */
  Route::get('job/image/status/{id}', [JobImageController::class, 'status']);
  Route::delete('job/image/destroy/{jobImage}', [JobImageController::class, 'destroy']);
  Route::post('job/image/coords/{jobImage}', [JobImageController::class, 'coords']);

  /**
   * Team routes
   */
  Route::get('teams/get', [TeamController::class, 'get']);
  Route::get('team/get/{team}', [TeamController::class, 'getOne']);
  Route::post('team/create', [TeamController::class, 'store']);
  Route::get('team/edit/{team}', [TeamController::class, 'edit']);
  Route::post('team/update/{team}', [TeamController::class, 'update']);
  Route::get('team/status/{team}', [TeamController::class, 'status']);
  Route::post('team/order', [TeamController::class, 'order']);
  Route::delete('team/destroy/{team}', [TeamController::class, 'destroy']);

  /**
   * TeamPortrait routes
   */
  Route::get('team/portrait/status/{id}', [TeamPortraitController::class, 'status']);
  Route::delete('team/portrait/destroy/{teamPortrait}', [TeamPortraitController::class, 'destroy']);
  Route::post('team/portrait/coords/{teamPortrait}', [TeamPortraitController::class, 'coords']);

  /**
   * TeamImage routes
   */
  Route::get('team/images/get', [TeamImageController::class, 'get']);
  Route::post('team/image/create', [TeamImageController::class, 'store']);
  Route::get('team/image/edit/{image}', [TeamImageController::class, 'edit']);
  Route::post('team/image/update/{image}', [TeamImageController::class, 'update']);
  Route::get('team/image/status/{image}', [TeamImageController::class, 'status']);
  Route::post('team/image/coords/{teamImage}', [TeamImageController::class, 'coords']);
  Route::delete('team/image/destroy/{image}', [TeamImageController::class, 'destroy']);

  /**
   * Profile routes
   */
  Route::get('profile/get', [ProfileController::class, 'get']);
  Route::post('profile/create', [ProfileController::class, 'store']);
  Route::get('profile/edit/{profile}', [ProfileController::class, 'edit']);
  Route::post('profile/update/{profile}', [ProfileController::class, 'update']);
  Route::get('profile/status/{profile}', [ProfileController::class, 'status']);
  Route::delete('profile/destroy/{profile}', [ProfileController::class, 'destroy']);

  /**
   * ProfileImage routes
   */
  Route::get('profile/images/get', [ProfileImageController::class, 'get']);
  Route::post('profile/image/create', [ProfileImageController::class, 'store']);
  Route::get('profile/image/edit/{image}', [ProfileImageController::class, 'edit']);
  Route::post('profile/image/update/{image}', [ProfileImageController::class, 'update']);
  Route::get('profile/image/status/{image}', [ProfileImageController::class, 'status']);
  Route::delete('profile/image/destroy/{image}', [ProfileImageController::class, 'destroy']);
  Route::post('profile/image/coords/{profileImage}', [ProfileImageController::class, 'coords']);
 
  /**
   * Project routes
   */
  Route::get('projects/get', [ProjectController::class, 'get']);
  Route::get('project/get/{project}', [ProjectController::class, 'getOne']);
  Route::post('project/create', [ProjectController::class, 'store']);
  Route::get('project/edit/{project}', [ProjectController::class, 'edit']);
  Route::post('project/update/{project}', [ProjectController::class, 'update']);
  Route::get('project/status/{project}', [ProjectController::class, 'status']);
  Route::post('project/order', [ProjectController::class, 'order']);
  Route::delete('project/destroy/{project}', [ProjectController::class, 'destroy']);

  /**
   * ProjectImage routes
   */
  Route::get('project/image/get/{projectId}', [ProjectImageController::class, 'get']);
  Route::get('project/image/status/{id}', [ProjectImageController::class, 'status']);
  Route::post('project/image/coords/{projectImage}', [ProjectImageController::class, 'coords']);
  Route::post('project/image/order', [ProjectImageController::class, 'order']);
  Route::delete('project/image/destroy/{projectImage}', [ProjectImageController::class, 'destroy']);

  /**
   * ProjectText routes
   */
  Route::get('project/text/get/{project}', [ProjectTextController::class, 'get']);
  Route::get('project/text/get/published/{project}', [ProjectTextController::class, 'getPublished']);
  Route::get('project/text/get/{projectText}', [ProjectTextController::class, 'getOne']);
  Route::post('project/text/create', [ProjectTextController::class, 'store']);
  Route::get('project/text/edit/{projectText}', [ProjectTextController::class, 'edit']);
  Route::post('project/text/update/{projectText}', [ProjectTextController::class, 'update']);
  Route::get('project/text/status/{projectText}', [ProjectTextController::class, 'status']);
  Route::delete('project/text/destroy/{projectText}', [ProjectTextController::class, 'destroy']);

  /**
   * ProjectDocument routes
   */
  Route::get('project/document/status/{id}', [ProjectDocumentController::class, 'status']);
  Route::delete('project/document/destroy/{projectFile}', [ProjectDocumentController::class, 'destroy']);

  /**
   * ProjectProgram routes
   */
  Route::get('project/program/get', [ProjectProgramController::class, 'get']);
  Route::post('project/program/create', [ProjectProgramController::class, 'store']);
  Route::get('project/program/edit/{projectProgram}', [ProjectProgramController::class, 'edit']);
  Route::post('project/program/update/{projectProgram}', [ProjectProgramController::class, 'update']);
  Route::get('project/program/status/{projectProgram}', [ProjectProgramController::class, 'status']);
  Route::delete('project/program/destroy/{projectProgram}', [ProjectProgramController::class, 'destroy']);
  Route::post('project/program/order', [ProjectProgramController::class, 'order']);


  /**
   * Project grid routes
   */
  Route::get('project/grids/{id}', [ProjectGridController::class, 'get']);
  Route::post('project/grids/order', [ProjectGridController::class, 'order']);
  Route::get('project/grid/store/{projectId}/{layoutId}', [ProjectGridController::class, 'store']);
  Route::delete('project/grid/delete/{id}', [ProjectGridController::class, 'destroy']);
  Route::get('project/grid/layouts', [ProjectGridLayoutController::class, 'get']);
  Route::get('project/grid/elements/{gridId}', [ProjectGridElementController::class, 'get']);
  Route::post('project/grid/element/store', [ProjectGridElementController::class, 'store']);
  Route::delete('project/grid/element/delete/{id}', [ProjectGridElementController::class, 'destroy']);

  /**
   * Discourse routes
   */
  Route::get('discourses/get', [DiscourseController::class, 'get']);
  Route::get('discourse/get/{discourse}', [DiscourseController::class, 'getOne']);
  Route::post('discourse/create', [DiscourseController::class, 'store']);
  Route::get('discourse/edit/{discourse}', [DiscourseController::class, 'edit']);
  Route::post('discourse/update/{discourse}', [DiscourseController::class, 'update']);
  Route::get('discourse/status/{discourse}', [DiscourseController::class, 'status']);
  Route::post('discourse/order', [DiscourseController::class, 'order']);
  Route::delete('discourse/destroy/{discourse}', [DiscourseController::class, 'destroy']);

  /**
   * DiscourseImage routes
   */
  Route::get('discourse/image/get/{discourseId}', [DiscourseImageController::class, 'get']);
  Route::get('discourse/image/status/{id}', [DiscourseImageController::class, 'status']);
  Route::post('discourse/image/coords/{discourseImage}', [DiscourseImageController::class, 'coords']);
  Route::post('discourse/image/order', [DiscourseImageController::class, 'order']);
  Route::delete('discourse/image/destroy/{discourseImage}', [DiscourseImageController::class, 'destroy']);

  /**
   * DiscourseDocument routes
   */
  Route::get('discourse/document/status/{id}', [DiscourseDocumentController::class, 'status']);
  Route::delete('discourse/document/destroy/{discourseFile}', [DiscourseDocumentController::class, 'destroy']);

  /**
   * DiscourseTopic routes
   */
  Route::get('discourse/topic/get', [DiscourseTopicController::class, 'get']);
  Route::post('discourse/topic/create', [DiscourseTopicController::class, 'store']);
  Route::get('discourse/topic/edit/{discourseTopic}', [DiscourseTopicController::class, 'edit']);
  Route::post('discourse/topic/update/{discourseTopic}', [DiscourseTopicController::class, 'update']);
  Route::get('discourse/topic/status/{discourseTopic}', [DiscourseTopicController::class, 'status']);
  Route::delete('discourse/topic/destroy/{discourseTopic}', [DiscourseTopicController::class, 'destroy']);

  /**
   * InteractionProject routes
   */
  Route::get('interaction/projects/get', [InteractionProjectController::class, 'get']);
  Route::get('interaction/project/get/{interactionProject}', [InteractionProjectController::class, 'getOne']);
  Route::post('interaction/project/create', [InteractionProjectController::class, 'store']);
  Route::get('interaction/project/edit/{interactionProject}', [InteractionProjectController::class, 'edit']);
  Route::post('interaction/project/update/{interactionProject}', [InteractionProjectController::class, 'update']);
  Route::get('interaction/project/status/{interactionProject}', [InteractionProjectController::class, 'status']);
  Route::post('interaction/project/order', [InteractionProjectController::class, 'order']);
  Route::delete('interaction/project/destroy/{interactionProject}', [InteractionProjectController::class, 'destroy']);

  /**
   * InteractionProjectImage routes
   */
  Route::get('interaction/project/image/get/{interactionProjectId}', [InteractionProjectImageController::class, 'get']);
  Route::get('interaction/project/image/status/{id}', [InteractionProjectImageController::class, 'status']);
  Route::post('interaction/project/image/coords/{interactionProjectImage}', [InteractionProjectImageController::class, 'coords']);
  Route::post('interaction/project/image/order', [InteractionProjectImageController::class, 'order']);
  Route::delete('interaction/project/image/destroy/{interactionProjectImage}', [InteractionProjectImageController::class, 'destroy']);

  /**
   * Contact routes
   */
  Route::get('contact/get', [ContactController::class, 'get']);
  Route::post('contact/create', [ContactController::class, 'store']);
  Route::get('contact/edit/{contact}', [ContactController::class, 'edit']);
  Route::post('contact/update/{contact}', [ContactController::class, 'update']);
  Route::get('contact/status/{contact}', [ContactController::class, 'status']);

  /**
   * Contact image routes
   */
  Route::get('contact/image/status/{id}', [ContactImageController::class, 'status']);
  Route::delete('contact/image/destroy/{contactImage}', [ContactImageController::class, 'destroy']);
  Route::post('contact/image/coords/{contactImage}', [ContactImageController::class, 'coords']);

  /**
   * Settings routes
   */
  Route::get('settings/projectState', [SettingsController::class, 'projectState']);
  Route::get('settings/projectCategories', [SettingsController::class, 'projectCategories']);
  Route::get('settings/teamCategories', [SettingsController::class, 'teamCategories']);
  Route::get('settings/newsLayout', [SettingsController::class, 'newsLayout']);

  /**
   * Upload routes
   */
  Route::post('media/upload', [MediaController::class, 'upload']);
  
  /**
   * HomeNews routes
   */
  Route::get('home/news/get', [HomeNewsController::class, 'get']);
  Route::get('home/news/get/published', [HomeNewsController::class, 'getPublished']);
  Route::get('home/news/get/{homeNews}', [HomeNewsController::class, 'getOne']);
  Route::post('home/news/create', [HomeNewsController::class, 'store']);
  Route::get('home/news/edit/{homeNews}', [HomeNewsController::class, 'edit']);
  Route::post('home/news/update/{homeNews}', [HomeNewsController::class, 'update']);
  Route::get('home/news/status/{homeNews}', [HomeNewsController::class, 'status']);
  Route::post('home/news/order', [HomeNewsController::class, 'order']);
  Route::delete('home/news/destroy/{homeNews}', [HomeNewsController::class, 'destroy']);

  /**
   * HomeNewsImages routes
   */
  Route::get('home/news/image/get/{homeNewsId}', [HomeNewsImageController::class, 'get']);
  Route::get('home/news/image/status/{id}', [HomeNewsImageController::class, 'status']);
  Route::post('home/news/image/coords/{homeNewsImage}', [HomeNewsImageController::class, 'coords']);
  Route::delete('home/news/image/destroy/{homeNewsImage}', [HomeNewsImageController::class, 'destroy']);
  
  /**
   * HomeGrid routes
   */
  Route::get('home/grids', [HomeGridController::class, 'get']);
  Route::post('home/grids/order', [HomeGridController::class, 'order']);
  Route::get('home/grid/store/{layoutId}', [HomeGridController::class, 'store']);
  Route::delete('home/grid/delete/{id}', [HomeGridController::class, 'destroy']);
  Route::get('home/grid/layouts', [HomeGridLayoutController::class, 'get']);
  Route::get('home/grid/elements/{gridId}', [HomeGridElementController::class, 'get']);
  Route::post('home/grid/element/store', [HomeGridElementController::class, 'store']);
  Route::delete('home/grid/element/delete/{id}', [HomeGridElementController::class, 'destroy']);

  /**
   * Intro routes
   */
  Route::get('intro/get/{type}', [IntroController::class, 'get']);
  Route::post('intro/create', [IntroController::class, 'store']);
  Route::get('intro/edit/{intro}', [IntroController::class, 'edit']);
  Route::post('intro/update/{intro}', [IntroController::class, 'update']);
  Route::get('intro/status/{intro}', [IntroController::class, 'status']);
  Route::delete('intro/destroy/{intro}', [IntroController::class, 'destroy']);

  /**
   * IntroImage routes
   */
  Route::get('intro/images/get', [IntroImageController::class, 'get']);
  Route::post('intro/image/create', [IntroImageController::class, 'store']);
  Route::get('intro/image/edit/{image}', [IntroImageController::class, 'edit']);
  Route::post('intro/image/update/{image}', [IntroImageController::class, 'update']);
  Route::get('intro/image/status/{image}', [IntroImageController::class, 'status']);
  Route::delete('intro/image/destroy/{image}', [IntroImageController::class, 'destroy']);
  Route::post('intro/image/coords/{introImage}', [IntroImageController::class, 'coords']);

/**
   * StrategyProject routes
   */
  Route::get('strategy/projects/get', [StrategyProjectController::class, 'get']);
  Route::get('strategy/project/get/{strategyProject}', [StrategyProjectController::class, 'getOne']);
  Route::post('strategy/project/create', [StrategyProjectController::class, 'store']);
  Route::get('strategy/project/edit/{strategyProject}', [StrategyProjectController::class, 'edit']);
  Route::post('strategy/project/update/{strategyProject}', [StrategyProjectController::class, 'update']);
  Route::get('strategy/project/status/{strategyProject}', [StrategyProjectController::class, 'status']);
  Route::post('strategy/project/order', [StrategyProjectController::class, 'order']);
  Route::delete('strategy/project/destroy/{strategyProject}', [StrategyProjectController::class, 'destroy']);

  /**
   * StrategyProjectControllerImage routes
   */
  Route::get('strategy/project/image/get/{strategyProjectId}', [StrategyProjectImageController::class, 'get']);
  Route::get('strategy/project/image/status/{id}', [StrategyProjectImageController::class, 'status']);
  Route::post('strategy/project/image/coords/{strategyProjectImage}', [StrategyProjectImageController::class, 'coords']);
  Route::post('strategy/project/image/order', [StrategyProjectImageController::class, 'order']);
  Route::delete('strategy/project/image/destroy/{strategyProjectImage}', [StrategyProjectImageController::class, 'destroy']);

});

/**
 * Auth routes
 */

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
  Route::post('login', [AuthController::class, 'login']);
  Route::post('logout', [AuthController::class, 'logout']);
  Route::post('refresh', [AuthController::class, 'refresh']);
  Route::post('me', [AuthController::class, 'me']);
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