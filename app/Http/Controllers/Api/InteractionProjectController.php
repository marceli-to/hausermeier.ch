<?php
namespace App\Http\Controllers\Api;
use App\Models\InteractionProject;
use App\Models\InteractionProjectImage;
use App\Http\Resources\DataCollection;
use App\Http\Requests\InteractionProjectStoreRequest;
use App\Events\InteractionProjectDestroy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InteractionProjectController extends Controller
{
  protected $interactionProject;
  protected $interactionProjectImage;
  
  /**
   * Constructor
   * 
   * @param InteractionProject $interactionProject
   */

  public function __construct(InteractionProject $interactionProject, InteractionProjectImage $interactionProjectImage)
  {
    $this->interactionProject = $interactionProject;
    $this->interactionProjectImage = $interactionProjectImage;
  }

  /**
   * Get all records
   *
   * @return \Illuminate\Http\Response
   */

  public function get()
  {
    $interactionProjects = $this->interactionProject->with('images')->orderBy('order', 'ASC')->get();
    return response()->json($interactionProjects);
  }

  /**
   * Fetch one record
   *
   * @param InteractionProject $interactionProject
   * @return \Illuminate\Http\Response
   */

  public function getOne(InteractionProject $interactionProject)
  {
    return response()->json($interactionProject);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  
  public function store(Request $request)
  { 
     $interactionProject = new InteractionProject([
      'category' => [
        'de'  => $request->input('category.de'),
        'en'  => $request->input('category.en'),
      ],
      'title' => [
        'de'  => $request->input('title.de'),
        'en'  => $request->input('title.en'),
      ],
      'description' => [
        'de' => $request->input('description.de'),
        'en' => $request->input('description.en'),
      ],
      'info' => [
        'de' => $request->input('info.de'),
        'en' => $request->input('info.en'),
      ],
      'year'     => $request->input('year'),
      'link'     => $request->input('link'),
      'linkText' => $request->input('linkText'),
      'video'    => $request->input('video'),
      'project_id' => $request->input('project_id') ? $request->input('project_id') : 0,
      'publish'    => $request->input('publish'),
    ]);
    $interactionProject->save();
    
    // Images
    if (!empty($request->images))
    {
      foreach($request->images as $i)
      {
        $image = new InteractionProjectImage([
          'interaction_project_id' => $interactionProject->id,
          'name' => $i['name'],
          'caption' => [
            'de' => $i['caption']['de'],
            'en' => $i['caption']['en'],    
          ],
          'coords_w' => $i['coords_w'] ? round($i['coords_w'], 12) : NULL,
          'coords_h' => $i['coords_h'] ? round($i['coords_h'], 12) : NULL,
          'coords_x' => $i['coords_x'] ? round($i['coords_x'], 12) : NULL,
          'coords_y' => $i['coords_y'] ? round($i['coords_y'], 12) : NULL,
          'orientation' => $i['orientation'],
          'publish' => $i['publish'],
        ]);
        $image->save();
      }
    }

    return response()->json(['interactionId' => $interactionProject->id]);
  }

  /**
   * Edit a specified resource.
   *
   * @param InteractionProject $interactionProject
   * @return \Illuminate\Http\Response
   */
  public function edit(InteractionProject $interactionProject)
  {
    $interactionProject = $this->interactionProject->with('images')->findOrFail($interactionProject->id);
    return response()->json($interactionProject);
  }

  /**
   * Update the status of the specified resource.
   *
   * @param InteractionProject $interactionProject
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function update(InteractionProject $interactionProject, InteractionProjectStoreRequest $request)
  {
    $interactionProject = $this->interactionProject->findOrFail($interactionProject->id);
    $interactionProject->setTranslation('category', 'de', $request->input('category.de'));
    $interactionProject->setTranslation('title', 'de', $request->input('title.de'));
    $interactionProject->setTranslation('description', 'de', $request->input('description.de'));
    $interactionProject->setTranslation('info', 'de', $request->input('info.de'));
    $interactionProject->setTranslation('category', 'en', $request->input('category.en'));
    $interactionProject->setTranslation('title', 'en', $request->input('title.en'));
    $interactionProject->setTranslation('description', 'en', $request->input('description.en'));
    $interactionProject->setTranslation('info', 'en', $request->input('info.en'));
    $interactionProject->year        = $request->input('year');
    $interactionProject->link        = $request->input('link');
    $interactionProject->linkText    = $request->input('linkText');
    $interactionProject->video       = $request->input('video');
    $interactionProject->project_id  = $request->input('project_id') ? $request->input('project_id') : 0;
    $interactionProject->publish     = $request->input('publish');
    $interactionProject->save();

    // Images
    if (!empty($request->images))
    {
      foreach($request->images as $i)
      {
        $image = InteractionProjectImage::updateOrCreate(
          ['id' => $i['id']], 
          [
            'interaction_project_id' => $interactionProject->id,
            'name' => $i['name'],
            'caption' => [
              'de' => $i['caption']['de'],
              'en' => $i['caption']['en']
            ],
            'coords_w' => $i['coords_w'] ? round($i['coords_w'], 12) : NULL,
            'coords_h' => $i['coords_h'] ? round($i['coords_h'], 12) : NULL,
            'coords_x' => $i['coords_x'] ? round($i['coords_x'], 12) : NULL,
            'coords_y' => $i['coords_y'] ? round($i['coords_y'], 12): NULL,
            'publish' => $i['publish'] ? $i['publish'] : 0,
            'orientation' => $i['orientation'] ? $i['orientation'] : NULL,
          ]
        );
      }
    }

    return response()->json('successfully updated');
  }

  /**
   * Update the status of the specified resource.
   *
   * @param  InteractionProject $interactionProject
   * @return \Illuminate\Http\Response
   */
  public function status(InteractionProject $interactionProject)
  {
    $interactionProject->publish = $interactionProject->publish == 0 ? 1 : 0;
    $interactionProject->save();
    return response()->json($interactionProject->publish);
  }

  /**
   * Update the order of the resources.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function order(Request $request)
  {
    $interactionProjects = $request->get('interactions');
    foreach($interactionProjects as $interactionProject)
    {
      $d = $this->interactionProject->find($interactionProject['id']);
      $d->order = $interactionProject['order'];
      $d->save(); 
    }
    return response()->json('successfully updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  InteractionProject $interactionProject
   * @return \Illuminate\Http\Response
   */
  public function destroy(InteractionProject $interactionProject)
  {
    // Fire event and destroy the interactionProject entirely
    event(new InteractionProjectDestroy($interactionProject));
    return response()->json('successfully deleted');
  }
}
