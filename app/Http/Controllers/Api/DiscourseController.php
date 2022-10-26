<?php
namespace App\Http\Controllers\Api;
use App\Models\Discourse;
use App\Models\DiscourseImage;
use App\Models\DiscourseDocument;
use App\Http\Resources\DataCollection;
use App\Http\Requests\DiscourseStoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscourseController extends Controller
{
  protected $discourse;
  protected $discourseImage;
  protected $discourseDocument;
  
  /**
   * Constructor
   * 
   * @param Discourse $discourse
   */

  public function __construct(Discourse $discourse, DiscourseImage $discourseImage, DiscourseDocument $discourseDocument)
  {
    $this->discourse = $discourse;
    $this->discourseImage = $discourseImage;
    $this->discourseDocument = $discourseDocument;
  }

  /**
   * Get all records
   *
   * @return \Illuminate\Http\Response
   */

  public function get()
  {
    $discourses = $this->discourse->with('images')->orderBy('date', 'DESC')->get();
    return response()->json($discourses);
  }

  /**
   * Fetch one record
   *
   * @param Discourse $discourse
   * @return \Illuminate\Http\Response
   */

  public function getOne(Discourse $discourse)
  {
    return response()->json($discourse);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  
  public function store(Request $request)
  {   
    $discourse = new Discourse([
      'date'  => $request->input('date'),
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
      'is_all' => $request->input('is_all') ? $request->input('is_all') : 0,
      'is_discourse' => $request->input('is_discourse') ? $request->input('is_discourse') : 0,
      'is_publication' => $request->input('is_publication') ? $request->input('is_publication') : 0,
      'project_id' => $request->input('project_id') ? $request->input('project_id') : 0,
      'interaction_project_id' => $request->input('interaction_project_id') ? $request->input('interaction_project_id') : 0,
      'strategy_project_id' => $request->input('strategy_project_id') ? $request->input('strategy_project_id') : 0,
      'publish'    => $request->input('publish'),
    ]);
    $discourse->save();
    
    // Images
    if (!empty($request->images))
    {
      foreach($request->images as $i)
      {
        $image = new DiscourseImage([
          'discourse_id' => $discourse->id,
          'name' => $i['name'],
          'caption' => [
            'de' => $i['caption']['de'],
            'en' => $i['caption']['en'],    
          ],
          'is_preview' => $i['is_preview'],
          'coords_w' => $i['coords_w'] ? round($i['coords_w'], 12) : NULL,
          'coords_h' => $i['coords_h'] ? round($i['coords_h'], 12) : NULL,
          'coords_x' => $i['coords_x'] ? round($i['coords_x'], 12) : NULL,
          'coords_y' => $i['coords_y'] ? round($i['coords_y'], 12) : NULL,
          'orientation' => $i['orientation'] ? $i['orientation'] : NULL,
          'publish' => $i['publish'],
        ]);
        $image->save();
      }
    }

    // Documents
    if (!empty($request->documents))
    {
      foreach($request->documents as $i)
      {
        $document = new DiscourseDocument([
          'discourse_id' => $discourse->id,
          'name' => $i['name'],
          'caption' => [
            'de' => $i['caption']['de'],
            'en' => $i['caption']['en'],    
          ],
          'publish' => $i['publish'],
        ]);
        $document->save();
      }
    }

    return response()->json(['discourseId' => $discourse->id]);
  }

  /**
   * Edit a specified resource.
   *
   * @param Discourse $discourse
   * @return \Illuminate\Http\Response
   */
  public function edit(Discourse $discourse)
  {
    $discourse = $this->discourse->with('images')->with('documents')->findOrFail($discourse->id);
    return response()->json($discourse);
  }

  /**
   * Update the status of the specified resource.
   *
   * @param Discourse $discourse
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function update(Discourse $discourse, DiscourseStoreRequest $request)
  {
    $discourse = $this->discourse->findOrFail($discourse->id);
    
    // German
    $discourse->setTranslation('title', 'de', $request->input('title.de'));
    $discourse->setTranslation('description', 'de', $request->input('description.de'));
    $discourse->setTranslation('info', 'de', $request->input('info.de'));

    // English
    $discourse->setTranslation('title', 'en', $request->input('title.en'));
    $discourse->setTranslation('description', 'en', $request->input('description.en'));
    $discourse->setTranslation('info', 'en', $request->input('info.en'));

    $discourse->is_all = $request->input('is_all');
    $discourse->is_discourse = $request->input('is_discourse');
    $discourse->is_publication = $request->input('is_publication');
    $discourse->date = $request->input('date');
    $discourse->project_id = $request->input('project_id') ? $request->input('project_id') : 0;
    $discourse->interaction_project_id = $request->input('interaction_project_id') ? $request->input('interaction_project_id') : 0;
    $discourse->strategy_project_id = $request->input('strategy_project_id') ? $request->input('strategy_project_id') : 0;
    $discourse->publish = $request->input('publish');
    $discourse->save();

    // Images
    if (!empty($request->images))
    {
      foreach($request->images as $i)
      {
        $image = DiscourseImage::updateOrCreate(
          ['id' => $i['id']], 
          [
            'discourse_id' => $discourse->id,
            'name' => $i['name'],
            'caption' => [
              'de' => $i['caption']['de'],
              'en' => $i['caption']['en']
            ],
            'coords_w' => $i['coords_w'] ? round($i['coords_w'], 12) : NULL,
            'coords_h' => $i['coords_h'] ? round($i['coords_h'], 12) : NULL,
            'coords_x' => $i['coords_x'] ? round($i['coords_x'], 12) : NULL,
            'coords_y' => $i['coords_y'] ? round($i['coords_y'], 12) : NULL,
            'is_preview' => $i['is_preview'] ? $i['is_preview'] : 0,
            'orientation' => $i['orientation'] ? $i['orientation'] : NULL,
            'publish' => $i['publish'] ? $i['publish'] : 0,
          ]
        );
      }
    }
    
    // Documents
    if (!empty($request->documents))
    {
      foreach($request->documents as $i)
      {
        $document = DiscourseDocument::updateOrCreate(
          ['id' => $i['id']], 
          [
            'discourse_id' => $discourse->id,
            'name' => $i['name'],
            'caption' => [
              'de' => $i['caption']['de'],
              'en' => $i['caption']['en']
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
   * @param  Discourse $discourse
   * @return \Illuminate\Http\Response
   */
  public function status(Discourse $discourse)
  {
    $discourse->publish = $discourse->publish == 0 ? 1 : 0;
    $discourse->save();
    return response()->json($discourse->publish);
  }

  /**
   * Update the order of the resources.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function order(Request $request)
  {
    $discourses = $request->get('discourses');
    foreach($discourses as $discourse)
    {
      $d = $this->discourse->find($discourse['id']);
      $d->order = $discourse['order'];
      $d->save(); 
    }
    return response()->json('successfully updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * \Observers\DiscourseObserver observes and deletes child elements (images, documents).
   *
   * @param  Discourse $discourse
   * @return \Illuminate\Http\Response
   */
  public function destroy(Discourse $discourse)
  {
    $discourse->delete();
    return response()->json('successfully deleted');
  }
}
