<?php
namespace App\Http\Controllers\Api;
use App\Models\ProjectProgram;
use App\Http\Resources\DataCollection;
use App\Http\Requests\ProjectProgramStoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectProgramController extends Controller
{
  protected $projectProgram;
  
  /**
   * Constructor
   * 
   * @param ProjectProgram $projectProgram
   */

  public function __construct(ProjectProgram $projectProgram)
  {
    $this->projectProgram = $projectProgram;
  }

  /**
   * Get all records
   *
   * @return \Illuminate\Http\Response
   */

  public function get()
  {
    return response()->json($this->projectProgram->orderBy('order', 'ASC')->get());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  
  public function store(ProjectProgramStoreRequest $request)
  {   
    $projectProgram = new ProjectProgram([
      'title' => [
        'de' => $request->input('title.de'),
        'en' => $request->input('title.en'),
      ],
      'publish'  => $request->input('publish'),
    ]);
    $projectProgram->save();
    return response()->json(['projectProgramId' => $projectProgram->id]);
  }

  /**
   * Edit a specified resource.
   *
   * @param ProjectProgram $projectProgram
   * @return \Illuminate\Http\Response
   */

  public function edit(ProjectProgram $projectProgram)
  {
    $projectProgram = $this->projectProgram->findOrFail($projectProgram->id);
    return response()->json($projectProgram);
  }

  /**
   * Update the status of the specified resource.
   *
   * @param ProjectProgram $projectProgram
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function update(ProjectProgram $projectProgram, ProjectProgramStoreRequest $request)
  {
    $projectProgram = $this->projectProgram->findOrFail($projectProgram->id);
    $projectProgram->setTranslation('title', 'de', $request->input('title.de'));
    $projectProgram->setTranslation('title', 'en', $request->input('title.en'));
    $projectProgram->publish  = $request->input('publish');
    $projectProgram->save();
    return response()->json('successfully updated');
  }

  /**
   * Update the status of the specified resource.
   *
   * @param  ProjectProgram $projectProgram
   * @return \Illuminate\Http\Response
   */
  
  public function status(ProjectProgram $projectProgram)
  {
    $projectProgram->publish = $projectProgram->publish == 0 ? 1 : 0;
    $projectProgram->save();
    return response()->json($projectProgram->publish);
  }

  /**
   * Update the order of the resources.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function order(Request $request)
  {
    $projectPrograms = $request->get('programs');
    foreach($projectPrograms as $project)
    {
      $d = $this->projectProgram->find($project['id']);
      $d->order = $project['order'];
      $d->save(); 
    }
    return response()->json('successfully updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  ProjectProgram $projectProgram
   * @return \Illuminate\Http\Response
   */

  public function destroy(ProjectProgram $projectProgram)
  {
    $projectProgram->delete();
    return response()->json('successfully deleted');
  }
}
