<?php
namespace App\Http\Controllers\Api;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\ProjectDocument;
use App\Http\Resources\DataCollection;
use App\Http\Requests\ProjectStoreRequest;
use App\Events\ProjectDestroy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
  protected $project;
  protected $projectImage;
  protected $projectDocument;
  
  /**
   * Constructor
   * 
   * @param Project $project
   */

  public function __construct(Project $project, ProjectImage $projectImage, ProjectDocument $projectDocument)
  {
    $this->project = $project;
    $this->projectImage = $projectImage;
    $this->projectDocument = $projectDocument;
  }

  /**
   * Get all records
   *
   * @return \Illuminate\Http\Response
   */

  public function get()
  {
    return new DataCollection($this->project->with('images')->with('documents')->orderBy('order', 'ASC')->get());
  }

  /**
   * Fetch one record
   *
   * @param Project $project
   * @return \Illuminate\Http\Response
   */

  public function getOne(Project $project)
  {
    return response()->json($project);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  
  public function store(Request $request)
  {   
    $project = new Project([
      'name' => [
        'de' => $request->input('name.de'),
        'en' => $request->input('name.en'),
      ],
      'short_title' => [
        'de' => $request->input('short_title.de'),
        'en' => $request->input('short_title.en'),
      ],
      'location' => [
        'de' => $request->input('location.de'),
        'en' => $request->input('location.en'),
      ],
      'type' => [
        'de' => $request->input('type.de'),
        'en' => $request->input('type.en'),
      ],      
      'description' => [
        'de' => $request->input('description.de'),
        'en' => $request->input('description.en'),
      ],
      'info' => [
        'de' => $request->input('info.de'),
        'en' => $request->input('info.en'),
      ],
      'info_works_1' => [
        'de' => $request->input('info_works_1.de'),
        'en' => $request->input('info_works_1.en'),
      ],
      'info_works_2' => [
        'de' => $request->input('info_works_2.de'),
        'en' => $request->input('info_works_2.en'),
      ],
      'year'                => $request->input('year'),
      'category'            => $request->input('category'),
      'program_id'          => $request->input('program_id'),
      'interaction_id'      => $request->input('interaction_id') != 0 ? $request->input('interaction_id') : NULL,
      'strategy_project_id' => $request->input('strategy_project_id') != 0 ? $request->input('strategy_project_id') : NULL,
      'has_detail'          => $request->input('has_detail'),
      'publish'             => $request->input('publish'),
    ]);
    $project->save();
    
    // Images
    if (!empty($request->images))
    {
      foreach($request->images as $i)
      {
        $image = new ProjectImage([
          'project_id'  => $project->id,
          'name'        => $i['name'],
          'caption' => [
            'de' => $i['caption']['de'] ?? NULL,
            'en' => $i['caption']['en'] ?? NULL,    
          ],
          'is_preview_works'      => $i['is_preview_works'],
          'is_lightbox'           => $i['is_lightbox'],
          'is_plan'               => $i['is_plan'] ? $i['is_plan'] : 0,
          'coords_w'              => $i['coords_w'],
          'coords_h'              => $i['coords_h'],
          'coords_x'              => $i['coords_x'],
          'coords_y'              => $i['coords_y'],
          'orientation'           => $i['orientation'],
          'publish'               => $i['publish'],
        ]);
        $image->save();
      }
    }

    // Documents
    if (!empty($request->documents))
    {
      foreach($request->documents as $i)
      {
        $document = new ProjectDocument([
          'project_id'  => $project->id,
          'name'        => $i['name'],
          'caption' => [
            'de' => $i['caption']['de'] ?? NULL,
            'en' => $i['caption']['en'] ?? NULL,    
          ],
          'publish' => $i['publish'],
        ]);
        $document->save();
      }
    }

    return response()->json(['projectId' => $project->id]);
  }

  /**
   * Edit a specified resource.
   *
   * @param Project $project
   * @return \Illuminate\Http\Response
   */
  public function edit(Project $project)
  {
    $project = $this->project->with('images')->with('documents')->findOrFail($project->id);
    return response()->json($project);
  }

  /**
   * Update the status of the specified resource.
   *
   * @param Project $project
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function update(Project $project, ProjectStoreRequest $request)
  {
    $project = $this->project->findOrFail($project->id);
    
    // German
    $project->setTranslation('name', 'de', $request->input('name.de'));
    $project->setTranslation('short_title', 'de', $request->input('short_title.de'));
    $project->setTranslation('location', 'de', $request->input('location.de'));
    $project->setTranslation('type', 'de', $request->input('type.de'));
    $project->setTranslation('description', 'de', $request->input('description.de'));
    $project->setTranslation('info', 'de', $request->input('info.de'));
    $project->setTranslation('info_works_1', 'de', $request->input('info_works_1.de'));
    $project->setTranslation('info_works_2', 'de', $request->input('info_works_2.de'));

    // English
    $project->setTranslation('name', 'en', $request->input('name.en'));
    $project->setTranslation('short_title', 'en', $request->input('short_title.en'));
    $project->setTranslation('location', 'en', $request->input('location.en'));
    $project->setTranslation('type', 'en', $request->input('type.en'));
    $project->setTranslation('description', 'en', $request->input('description.en'));
    $project->setTranslation('info', 'en', $request->input('info.en'));
    $project->setTranslation('info_works_1', 'en', $request->input('info_works_1.en'));
    $project->setTranslation('info_works_2', 'en', $request->input('info_works_2.en'));

    $project->year                = $request->input('year');
    $project->category            = $request->input('category');
    $project->program_id          = $request->input('program_id');
    $project->interaction_id      = $request->input('interaction_id') != 0 ? $request->input('interaction_id') : NULL;
    $project->strategy_project_id = $request->input('strategy_project_id') != 0 ? $request->input('strategy_project_id') : NULL;
    $project->has_detail          = $request->input('has_detail');
    $project->publish             = $request->input('publish');
    $project->save();

    // Images
    if (!empty($request->images))
    {
      foreach($request->images as $i)
      { 
        $image = ProjectImage::updateOrCreate(
          ['id' => $i['id']], 
          [
            'project_id' => $project->id,
            'name' => $i['name'],
            'caption' => [
              'de' => $i['caption']['de'] ?? NULL,
              'en' => $i['caption']['en'] ?? NULL
            ],
            'publish'                 => $i['publish'] ? $i['publish'] : 0,
            'is_preview_works'        => $i['is_preview_works'] ? $i['is_preview_works'] : 0,
            'is_lightbox'             => $i['is_lightbox'] ? $i['is_lightbox'] : 0,
            'is_plan'                 => $i['is_plan'] ? $i['is_plan'] : 0,
            'coords_w'                => $i['coords_w'] ? $i['coords_w'] : NULL,
            'coords_h'                => $i['coords_h'] ? $i['coords_h'] : NULL,
            'coords_x'                => $i['coords_x'] ? $i['coords_x'] : NULL,
            'coords_y'                => $i['coords_y'] ? $i['coords_y'] : NULL,
            'orientation'             => $i['orientation'] ? $i['orientation'] : NULL,
          ]
        );
      }
    }
    
    // Documents
    if (!empty($request->documents))
    {
      foreach($request->documents as $i)
      {
        $document = ProjectDocument::updateOrCreate(
          ['id' => $i['id']], 
          [
            'project_id' => $project->id,
            'name' => $i['name'],
            'caption' => [
              'de' => $i['caption']['de'] ?? NULL,
              'en' => $i['caption']['en'] ?? NULL
            ],
            'publish' => $i['publish'] ? $i['publish'] : 0,
          ]
        );
      }
    }

    return response()->json('successfully updated');
  }

  /**
   * Update the status of the specified resource.
   *
   * @param  Project $project
   * @return \Illuminate\Http\Response
   */
  public function status(Project $project)
  {
    $project->publish = $project->publish == 0 ? 1 : 0;
    $project->save();
    return response()->json($project->publish);
  }

  /**
   * Update the order of the resources.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function order(Request $request)
  {
    $projects = $request->get('projects');
    foreach($projects as $project)
    {
      $d = $this->project->find($project['id']);
      $d->order = $project['order'];
      $d->save(); 
    }
    return response()->json('successfully updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Project $project
   * @return \Illuminate\Http\Response
   */
  public function destroy(Project $project)
  {
    // Fire event and destroy the project entirely (imgs, docs, grids, texts)
    event(new ProjectDestroy($project));
    return response()->json('successfully deleted');
  }
}
