<?php
namespace App\Http\Controllers\Api;
use App\Models\StrategyProject;
use App\Models\StrategyProjectImage;
use App\Http\Resources\DataCollection;
use App\Http\Requests\StrategyProjectStoreRequest;
use App\Events\StrategyProjectDestroy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StrategyProjectController extends Controller
{
  protected $strategyProject;
  protected $strategyProjectImage;
  
  /**
   * Constructor
   * 
   * @param StrategyProject $strategyProject
   */

  public function __construct(StrategyProject $strategyProject, StrategyProjectImage $strategyProjectImage)
  {
    $this->strategyProject = $strategyProject;
    $this->strategyProjectImage = $strategyProjectImage;
  }

  /**
   * Get all records
   *
   * @return \Illuminate\Http\Response
   */

  public function get()
  {
    $strategyProjects = $this->strategyProject->with('images')->orderBy('order', 'ASC')->get();
    return response()->json($strategyProjects);
  }

  /**
   * Fetch one record
   *
   * @param StrategyProject $strategyProject
   * @return \Illuminate\Http\Response
   */

  public function getOne(StrategyProject $strategyProject)
  {
    return response()->json($strategyProject);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  
  public function store(Request $request)
  { 
     $strategyProject = new StrategyProject([
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
      'info_works_1' => [
        'de' => $request->input('info_works_1.de'),
        'en' => $request->input('info_works_1.en'),
      ],
      'info_works_2' => [
        'de' => $request->input('info_works_2.de'),
        'en' => $request->input('info_works_2.en'),
      ],
      'project_id' => $request->input('project_id'),
      'year'       => $request->input('year'),
      'publish'    => $request->input('publish'),
    ]);
    $strategyProject->save();
    
    // Images
    if (!empty($request->images))
    {
      foreach($request->images as $i)
      {
        $image = new StrategyProjectImage([
          'strategy_project_id' => $strategyProject->id,
          'name' => $i['name'],
          'caption' => [
            'de' => $i['caption']['de'],
            'en' => $i['caption']['en'],    
          ],
          'coords_w' => $i['coords_w'] ? round($i['coords_w'], 12) : NULL,
          'coords_h' => $i['coords_h'] ? round($i['coords_h'], 12) : NULL,
          'coords_x' => $i['coords_x'] ? round($i['coords_x'], 12) : NULL,
          'coords_y' => $i['coords_y'] ? round($i['coords_y'], 12) : NULL,
          'is_preview_works' => $i['is_preview_works'],
          'orientation' => $i['orientation'],
          'publish' => $i['publish'],
        ]);
        $image->save();
      }
    }

    return response()->json(['strategyId' => $strategyProject->id]);
  }

  /**
   * Edit a specified resource.
   *
   * @param StrategyProject $strategyProject
   * @return \Illuminate\Http\Response
   */
  public function edit(StrategyProject $strategyProject)
  {
    $strategyProject = $this->strategyProject->with('images')->findOrFail($strategyProject->id);
    return response()->json($strategyProject);
  }

  /**
   * Update the status of the specified resource.
   *
   * @param StrategyProject $strategyProject
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function update(StrategyProject $strategyProject, StrategyProjectStoreRequest $request)
  {
    $strategyProject = $this->strategyProject->findOrFail($strategyProject->id);
    $strategyProject->setTranslation('category', 'de', $request->input('category.de'));
    $strategyProject->setTranslation('title', 'de', $request->input('title.de'));
    $strategyProject->setTranslation('description', 'de', $request->input('description.de'));
    $strategyProject->setTranslation('info', 'de', $request->input('info.de'));
    $strategyProject->setTranslation('info_works_1', 'de', $request->input('info_works_1.de'));
    $strategyProject->setTranslation('info_works_2', 'de', $request->input('info_works_2.de'));
    
    $strategyProject->setTranslation('category', 'en', $request->input('category.en'));
    $strategyProject->setTranslation('title', 'en', $request->input('title.en'));
    $strategyProject->setTranslation('description', 'en', $request->input('description.en'));
    $strategyProject->setTranslation('info', 'en', $request->input('info.en'));
    $strategyProject->setTranslation('info_works_1', 'en', $request->input('info_works_1.en'));
    $strategyProject->setTranslation('info_works_2', 'en', $request->input('info_works_2.en'));

    $strategyProject->project_id  = $request->input('project_id');
    $strategyProject->year        = $request->input('year');
    $strategyProject->publish     = $request->input('publish');
    $strategyProject->save();

    // Images
    if (!empty($request->images))
    {
      foreach($request->images as $i)
      {
        $image = StrategyProjectImage::updateOrCreate(
          ['id' => $i['id']], 
          [
            'strategy_project_id' => $strategyProject->id,
            'name' => $i['name'],
            'caption' => [
              'de' => $i['caption']['de'],
              'en' => $i['caption']['en']
            ],
            'coords_w' => $i['coords_w'] ? round($i['coords_w'], 12) : NULL,
            'coords_h' => $i['coords_h'] ? round($i['coords_h'], 12) : NULL,
            'coords_x' => $i['coords_x'] ? round($i['coords_x'], 12) : NULL,
            'coords_y' => $i['coords_y'] ? round($i['coords_y'], 12): NULL,
            'is_preview_works' => $i['is_preview_works'] ? $i['is_preview_works'] : 0,
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
   * @param  StrategyProject $strategyProject
   * @return \Illuminate\Http\Response
   */
  public function status(StrategyProject $strategyProject)
  {
    $strategyProject->publish = $strategyProject->publish == 0 ? 1 : 0;
    $strategyProject->save();
    return response()->json($strategyProject->publish);
  }

  /**
   * Update the order of the resources.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function order(Request $request)
  {
    $strategyProjects = $request->get('strategies');
    foreach($strategyProjects as $strategyProject)
    {
      $d = $this->strategyProject->find($strategyProject['id']);
      $d->order = $strategyProject['order'];
      $d->save(); 
    }
    return response()->json('successfully updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  StrategyProject $strategyProject
   * @return \Illuminate\Http\Response
   */
  public function destroy(StrategyProject $strategyProject)
  {
    event(new StrategyProjectDestroy($strategyProject));
    return response()->json('successfully deleted');
  }
}
