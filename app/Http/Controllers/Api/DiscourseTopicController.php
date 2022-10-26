<?php
namespace App\Http\Controllers\Api;
use App\Models\DiscourseTopic;
use App\Http\Resources\DataCollection;
use App\Http\Requests\DiscourseTopicStoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscourseTopicController extends Controller
{
  protected $discourseTopic;
  
  /**
   * Constructor
   * 
   * @param DiscourseTopic $discourseTopic
   */

  public function __construct(DiscourseTopic $discourseTopic)
  {
    $this->discourseTopic = $discourseTopic;
  }

  /**
   * Get all records
   *
   * @return \Illuminate\Http\Response
   */

  public function get()
  {
    return response()->json($this->discourseTopic->orderBy('title->de', 'ASC')->get());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  
  public function store(DiscourseTopicStoreRequest $request)
  {   
    $discourseTopic = new DiscourseTopic([
      'title' => [
        'de' => $request->input('title.de'),
        'en' => $request->input('title.en'),
      ],
      'publish'  => $request->input('publish'),
    ]);
    $discourseTopic->save();
    return response()->json(['discourseTopicId' => $discourseTopic->id]);
  }

  /**
   * Edit a specified resource.
   *
   * @param DiscourseTopic $discourseTopic
   * @return \Illuminate\Http\Response
   */

  public function edit(DiscourseTopic $discourseTopic)
  {
    $discourseTopic = $this->discourseTopic->findOrFail($discourseTopic->id);
    return response()->json($discourseTopic);
  }

  /**
   * Update the status of the specified resource.
   *
   * @param DiscourseTopic $discourseTopic
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function update(DiscourseTopic $discourseTopic, DiscourseTopicStoreRequest $request)
  {
    $discourseTopic = $this->discourseTopic->findOrFail($discourseTopic->id);
    $discourseTopic->setTranslation('title', 'de', $request->input('title.de'));
    $discourseTopic->setTranslation('title', 'en', $request->input('title.en'));
    $discourseTopic->publish  = $request->input('publish');
    $discourseTopic->save();
    return response()->json('successfully updated');
  }

  /**
   * Update the status of the specified resource.
   *
   * @param  DiscourseTopic $discourseTopic
   * @return \Illuminate\Http\Response
   */
  
  public function status(DiscourseTopic $discourseTopic)
  {
    $discourseTopic->publish = $discourseTopic->publish == 0 ? 1 : 0;
    $discourseTopic->save();
    return response()->json($discourseTopic->publish);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  DiscourseTopic $discourseTopic
   * @return \Illuminate\Http\Response
   */

  public function destroy(DiscourseTopic $discourseTopic)
  {
    $discourseTopic->delete();
    return response()->json('successfully deleted');
  }
}
