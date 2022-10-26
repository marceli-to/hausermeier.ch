<?php
namespace App\Http\Controllers\Api;
use App\Models\Intro;
use App\Models\IntroImage;
use App\Http\Resources\DataCollection;
use App\Http\Requests\IntroStoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IntroController extends Controller
{
  protected $intro;
  protected $introImage;
  
  /**
   * Constructor
   * 
   * @param Intro $intro
   */

  public function __construct(Intro $intro, IntroImage $introImage)
  {
    $this->intro = $intro;
    $this->introImage = $introImage;
  }

  /**
   * Get all records
   *
   * @return \Illuminate\Http\Response
   */

  public function get($type = NULL)
  {
    return response()->json($this->intro->where('type', '=', $type)->get());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  
  public function store(IntroStoreRequest $request)
  {   
    $intro = new Intro([
      'text_intro' => [
        'de' => $request->input('text_intro.de'),
        'en' => $request->input('text_intro.en'),
      ],
      'text_column_1' => [
        'de' => $request->input('text_column_1.de'),
        'en' => $request->input('text_column_1.en'),
      ],
      'text_column_2' => [
        'de' => $request->input('text_column_2.de'),
        'en' => $request->input('text_column_2.en'),
      ],
      'text_column_3' => [
        'de' => $request->input('text_column_3.de'),
        'en' => $request->input('text_column_3.en'),
      ],
      'type'  => $request->input('type') ? $request->input('type') : 'interaction',
      'publish'  => $request->input('publish'),
    ]);
    $intro->save();

    // Images
    if (!empty($request->images))
    {
      foreach($request->images as $i)
      {
        $document = new IntroImage([
          'intro_id' => $intro->id,
          'name' => $i['name'],
          'caption' => [
            'de' => $i['caption']['de'],
            'en' => $i['caption']['en'],    
          ],
          'coords_w' => $i['coords_w'] ? round($i['coords_w'], 12) : NULL,
          'coords_h' => $i['coords_h'] ? round($i['coords_h'], 12) : NULL,
          'coords_x' => $i['coords_x'] ? round($i['coords_x'], 12) : NULL,
          'coords_y' => $i['coords_y'] ? round($i['coords_y'], 12) : NULL,
          'publish' => $i['publish'],
        ]);
        $document->save();
      }
    }

    return response()->json(['introId' => $intro->id]);
  }

  /**
   * Edit a specified resource.
   *
   * @param Intro $intro
   * @return \Illuminate\Http\Response
   */

  public function edit(Intro $intro)
  {
    $intro = $this->intro->with('images')->findOrFail($intro->id);
    return response()->json($intro);
  }

  /**
   * Update the status of the specified resource.
   *
   * @param Intro $intro
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function update(Intro $intro, IntroStoreRequest $request)
  {
    $intro = $this->intro->findOrFail($intro->id);

    // Translations
    $intro->setTranslation('text_intro', 'de', $request->input('text_intro.de'));
    $intro->setTranslation('text_intro', 'en', $request->input('text_intro.en'));
    $intro->setTranslation('text_column_1', 'de', $request->input('text_column_1.de'));
    $intro->setTranslation('text_column_1', 'en', $request->input('text_column_1.en'));
    $intro->setTranslation('text_column_2', 'de', $request->input('text_column_2.de'));
    $intro->setTranslation('text_column_2', 'en', $request->input('text_column_2.en'));
    $intro->setTranslation('text_column_3', 'de', $request->input('text_column_3.de'));
    $intro->setTranslation('text_column_3', 'en', $request->input('text_column_3.en'));
    $intro->type  = $request->input('type');
    $intro->save();
    
    // Images
    if (!empty($request->images))
    {
      foreach($request->images as $i)
      {
        $image = IntroImage::updateOrCreate(
          ['id' => $i['id']], 
          [
            'intro_id' => $intro->id,
            'name' => $i['name'],
            'caption' => [
              'de' => $i['caption']['de'],
              'en' => $i['caption']['en']
            ],
            'coords_w' => $i['coords_w'] ? round($i['coords_w'], 12) : NULL,
            'coords_h' => $i['coords_h'] ? round($i['coords_h'], 12) : NULL,
            'coords_x' => $i['coords_x'] ? round($i['coords_x'], 12) : NULL,
            'coords_y' => $i['coords_y'] ? round($i['coords_y'], 12) : NULL,
            'publish' => $i['publish'] ? $i['publish'] : 0,
          ]
        );
        $image->save();
      }
    }

    return response()->json('successfully updated');
  }

  /**
   * Update the status of the specified resource.
   *
   * @param  Intro $intro
   * @return \Illuminate\Http\Response
   */
  
  public function status(Intro $intro)
  {
    $intro->publish = $intro->publish == 0 ? 1 : 0;
    $intro->save();
    return response()->json($intro->publish);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Intro $intro
   * @return \Illuminate\Http\Response
   */

  public function destroy(Intro $intro)
  {
    $intro->delete();
    return response()->json('successfully deleted');
  }
}
