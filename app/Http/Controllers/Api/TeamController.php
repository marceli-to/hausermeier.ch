<?php
namespace App\Http\Controllers\Api;
use App\Models\Team;
use App\Models\TeamPortrait;
use App\Http\Resources\DataCollection;
use App\Http\Requests\TeamStoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamController extends Controller
{
  protected $team;
  
  /**
   * Constructor
   * 
   * @param Team $team
   */

  public function __construct(Team $team)
  {
    $this->team = $team;
  }

  /**
   * Get all records
   *
   * @return \Illuminate\Http\Response
   */

  public function get()
  {
    $team = $this->team->orderBy('order', 'ASC')->get();
    return response()->json($team->groupBy('category'));
  }

  /**
   * Fetch one record
   *
   * @param Team $team
   * @return \Illuminate\Http\Response
   */

  public function getOne(Team $team)
  {
    return response()->json($team);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  
  public function store(TeamStoreRequest $request)
  {   
    $team = new Team([
      'firstname' => $request->input('firstname'),
      'name' => $request->input('name'),
      'email' => $request->input('email'),
      'phone' => $request->input('phone'),
      'role' => [
        'de' => $request->input('role.de'),
        'en' => $request->input('role.en'),
      ],
      'biography' => [
        'de' => $request->input('biography.de'),
        'en' => $request->input('biography.en'),
      ],
      'category' => $request->input('category'),
      'publish'  => $request->input('publish'),
    ]);
    $team->save();

    // Images
    if (!empty($request->portrait))
    {
      foreach($request->portrait as $i)
      {
        $document = new TeamPortrait([
          'team_id' => $team->id,
          'name' => $i['name'],
          'caption' => [
            'de' => $i['caption']['de'] ?? NULL,
            'en' => $i['caption']['en'] ?? NULL,
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

    return response()->json(['teamId' => $team->id]);
  }

  /**
   * Edit a specified resource.
   *
   * @param Team $team
   * @return \Illuminate\Http\Response
   */
  public function edit(Team $team)
  {
    $team = $this->team->with('portrait')->findOrFail($team->id);
    return response()->json($team);
  }

  /**
   * Update the status of the specified resource.
   *
   * @param Team $team
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function update(Team $team, TeamStoreRequest $request)
  {
    $team = $this->team->findOrFail($team->id);
    $team->firstname = $request->input('firstname');
    $team->name = $request->input('name');
    $team->email = $request->input('email');
    $team->phone = $request->input('phone');

    // Translations
    $team->setTranslation('role', 'de', $request->input('role.de'));
    $team->setTranslation('role', 'en', $request->input('role.en'));
    $team->setTranslation('biography', 'de', $request->input('biography.de'));
    $team->setTranslation('biography', 'en', $request->input('biography.en'));

    $team->category = $request->input('category');
    $team->publish  = $request->input('publish');
    $team->save();

    // Images
    if (!empty($request->portrait))
    {
      foreach($request->portrait as $i)
      {
        $image = TeamPortrait::updateOrCreate(
          ['id' => $i['id']], 
          [
            'team_id' => $team->id,
            'name' => $i['name'],
            'caption' => [
              'de' => $i['caption']['de'] ?? NULL,
              'en' => $i['caption']['en'] ?? NULL
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
   * @param  Team $team
   * @return \Illuminate\Http\Response
   */
  public function status(Team $team)
  {
    $team->publish = $team->publish == 0 ? 1 : 0;
    $team->save();
    return response()->json($team->publish);
  }

  /**
   * Update the order of the resources.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function order(Request $request)
  {
    $teams = $request->get('teams');
    foreach($teams as $team)
    {
      $t = $this->team->find($team['id']);
      $t->order = $team['order'];
      $t->save(); 
    }
    return response()->json('successfully updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * \Observers\TeamObserver observes and deletes child elements (images, documents).
   *
   * @param  Team $team
   * @return \Illuminate\Http\Response
   */
  public function destroy(Team $team)
  {
    $team->delete();
    return response()->json('successfully deleted');
  }
}
