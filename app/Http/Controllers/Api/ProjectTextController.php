<?php
namespace App\Http\Controllers\Api;
use App\Models\Project;
use App\Models\ProjectText;
use App\Http\Resources\DataCollection;
use App\Http\Requests\ProjectTextStoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectTextController extends Controller
{
  protected $project;
  protected $projectText;
  
  /**
   * Constructor
   * 
   * @param ProjectText $projectText
   */

  public function __construct(Project $project, ProjectText $projectText)
  {
    $this->project = $project;
    $this->projectText = $projectText;
  }

  /**
   * Get all records
   * @param Project $project
   * @return \Illuminate\Http\Response
   */

  public function get(Project $project)
  {
    return new DataCollection($this->projectText->with('project')->where('project_id', '=', $project->id)->get());
  }

  /**
   * Get all published records
   * @param Project $project
   * @return \Illuminate\Http\Response
   */

  public function getPublished(Project $project)
  {
    return new DataCollection($this->projectText->with('project')->where('project_id', '=', $project->id)->published()->get());
  }

  /**
   * Fetch one record
   *
   * @param ProjectText $projectText
   * @return \Illuminate\Http\Response
   */

  public function getOne(ProjectText $projectText)
  {
    return response()->json($projectText);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  ProjectTextStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  
  public function store(ProjectTextStoreRequest $request)
  {   
    $projectText = new ProjectText([
      'text' => [
        'de'  => $request->input('text.de'),
        'en'  => $request->input('text.en'),
      ],
      'project_id' => $request->input('project_id'),
      'publish' => $request->input('publish'),
    ]);
    $projectText->save();
    return response()->json(['projectTextId' => $projectText->id]);
  }

  /**
   * Edit a specified resource.
   *
   * @param ProjectText $projectText
   * @return \Illuminate\Http\Response
   */
  public function edit(ProjectText $projectText)
  {
    $projectText = $this->projectText->findOrFail($projectText->id);
    return response()->json($projectText);
  }

  /**
   * Update the status of the specified resource.
   *
   * @param ProjectText $projectText
   * @param ProjectTextStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(ProjectText $projectText, ProjectTextStoreRequest $request)
  {
    $projectText = $this->projectText->findOrFail($projectText->id);
    $projectText->setTranslation('text', 'de', $request->input('text.de'));
    $projectText->setTranslation('text', 'en', $request->input('text.en'));
    $projectText->publish = $request->input('publish');
    $projectText->save();
    return response()->json('successfully updated');
  }

  /**
   * Update the status of the specified resource.
   *
   * @param  ProjectText $projectText
   * @return \Illuminate\Http\Response
   */
  public function status(ProjectText $projectText)
  {
    $projectText->publish = $projectText->publish == 0 ? 1 : 0;
    $projectText->save();
    return response()->json($projectText->publish);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  ProjectText $projectText
   * @return \Illuminate\Http\Response
   */
  public function destroy(ProjectText $projectText)
  {
    $projectText->delete();
    return response()->json('successfully deleted');
  }
}
