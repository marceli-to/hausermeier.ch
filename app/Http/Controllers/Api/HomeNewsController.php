<?php
namespace App\Http\Controllers\Api;
use App\Models\HomeNews;
use App\Models\HomeNewsImage;
use App\Http\Resources\DataCollection;
use App\Http\Requests\HomeNewsStoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeNewsController extends Controller
{
  protected $homeNews;
  protected $homeNewsImage;
  protected $homeNewsDocument;
  
  /**
   * Constructor
   * 
   * @param HomeNews $homeNews
   */

  public function __construct(HomeNews $homeNews, HomeNewsImage $homeNewsImage)
  {
    $this->homeNews = $homeNews;
    $this->homeNewsImage = $homeNewsImage;
  }

  /**
   * Get all records
   *
   * @return \Illuminate\Http\Response
   */

  public function get()
  {
    return new DataCollection($this->homeNews->get());
  }

  /**
   * Get all published records
   *
   * @return \Illuminate\Http\Response
   */

  public function getPublished()
  {
    return new DataCollection($this->homeNews->published()->get());
  }


  /**
   * Fetch one record
   *
   * @param HomeNews $homeNews
   * @return \Illuminate\Http\Response
   */

  public function getOne(HomeNews $homeNews)
  {
    return response()->json($homeNews);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  Request $request
   * @return \Illuminate\Http\Response
   */
  
  public function store(Request $request)
  {   
    $homeNews = new HomeNews([
      'date' => [
        'de'  => $request->input('date.de'),
        'en'  => $request->input('date.en'),
      ],
      'title' => [
        'de'  => $request->input('title.de'),
        'en'  => $request->input('title.en'),
      ],
      'short_title' => [
        'de'  => $request->input('short_title.de'),
        'en'  => $request->input('short_title.en'),
      ],
      'description' => [
        'de' => $request->input('description.de'),
        'en' => $request->input('description.en'),
      ],
      'link' => [
        'de' => $request->input('link.de'),
        'en' => $request->input('link.en'),
      ],
      'linkText' => [
        'de' => $request->input('linkText.de'),
        'en' => $request->input('linkText.en'),
      ],
      'layout'  => $request->input('layout') ? $request->input('layout') : 0,
      'publish' => $request->input('publish'),
    ]);
    $homeNews->save();
    
    // Images
    if (!empty($request->images))
    {
      foreach($request->images as $i)
      {
        $image = new HomeNewsImage([
          'home_news_id' => $homeNews->id,
          'name' => $i['name'],
          'caption' => [
            'de' => $i['caption']['de'],
            'en' => $i['caption']['en'],    
          ],
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

    return response()->json(['homeNewsId' => $homeNews->id]);
  }

  /**
   * Edit a specified resource.
   *
   * @param HomeNews $homeNews
   * @return \Illuminate\Http\Response
   */
  public function edit(HomeNews $homeNews)
  {
    $homeNews = $this->homeNews->with('images')->findOrFail($homeNews->id);
    return response()->json($homeNews);
  }

  /**
   * Update the status of the specified resource.
   *
   * @param HomeNews $homeNews
   * @param  HomeNewsStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(HomeNews $homeNews, HomeNewsStoreRequest $request)
  {
    $homeNews = $this->homeNews->findOrFail($homeNews->id);
    
    // German
    $homeNews->setTranslation('date', 'de', $request->input('date.de'));
    $homeNews->setTranslation('title', 'de', $request->input('title.de'));
    $homeNews->setTranslation('short_title', 'de', $request->input('short_title.de'));
    $homeNews->setTranslation('description', 'de', $request->input('description.de'));
    $homeNews->setTranslation('link', 'de', $request->input('link.de'));
    $homeNews->setTranslation('linkText', 'de', $request->input('linkText.de'));

    // English
    $homeNews->setTranslation('date', 'en', $request->input('date.en'));
    $homeNews->setTranslation('title', 'en', $request->input('title.en'));
    $homeNews->setTranslation('short_title', 'en', $request->input('short_title.en'));
    $homeNews->setTranslation('description', 'en', $request->input('description.en'));
    $homeNews->setTranslation('link', 'en', $request->input('link.en'));
    $homeNews->setTranslation('linkText', 'en', $request->input('linkText.en'));

    $homeNews->layout  = $request->input('layout') ? $request->input('layout') : 0;
    $homeNews->publish = $request->input('publish');
    $homeNews->save();

    // Images
    if (!empty($request->images))
    {
      foreach($request->images as $i)
      {
        $image = HomeNewsImage::updateOrCreate(
          ['id' => $i['id']], 
          [
            'home_news_id' => $homeNews->id,
            'name' => $i['name'],
            'caption' => [
              'de' => $i['caption']['de'] ?? NULL,
              'en' => $i['caption']['en'] ?? NULL
            ],
            'coords_w' => $i['coords_w'] ? round($i['coords_w'], 12) : NULL,
            'coords_h' => $i['coords_h'] ? round($i['coords_h'], 12) : NULL,
            'coords_x' => $i['coords_x'] ? round($i['coords_x'], 12) : NULL,
            'coords_y' => $i['coords_y'] ? round($i['coords_y'], 12) : NULL,
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
        $document = HomeNewsDocument::updateOrCreate(
          ['id' => $i['id']], 
          [
            'discourse_id' => $homeNews->id,
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
   * @param  HomeNews $homeNews
   * @return \Illuminate\Http\Response
   */
  public function status(HomeNews $homeNews)
  {
    $homeNews->publish = $homeNews->publish == 0 ? 1 : 0;
    $homeNews->save();
    return response()->json($homeNews->publish);
  }

  /**
   * Remove the specified resource from storage.
   *
   * \Observers\HomeNewsObserver observes and deletes child elements (images, documents).
   *
   * @param  HomeNews $homeNews
   * @return \Illuminate\Http\Response
   */
  public function destroy(HomeNews $homeNews)
  {
    $homeNews->delete();
    return response()->json('successfully deleted');
  }
}
