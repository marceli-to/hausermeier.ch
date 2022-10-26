<?php
namespace App\Http\Controllers\Api;
use App\Http\Resources\DataCollection;
use App\Http\Controllers\Controller;
use Config;
use Lang;
use App;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
  protected $settings;
  
  public function __construct()
  {
    $this->settings = Config::get('settings');
  }


  /**
   * Get settings->newsLayout
   * @return \Illuminate\Http\Response
   */

  public function newsLayout()
  {
    return response()->json($this->settings['newsLayout']);
  }

  /**
   * Get settings->projectState
   * @return \Illuminate\Http\Response
   */

  public function projectState()
  {
    return response()->json($this->translate('projectState'));
  }

  /**
   * Get settings->projectCategories
   * @return \Illuminate\Http\Response
   */

  public function projectCategories()
  {
    return response()->json($this->translate('projectCategories'));
  }

  /**
   * Get settings->teamCategories
   * @return \Illuminate\Http\Response
   */

  public function teamCategories()
  {
    return response()->json($this->translate('teamCategories'));
  }

  protected function translate($type)
  {
    // Set to german for use in backend
    App::setLocale('de');
    
    // Get settings by type
    $settings = $this->settings[$type];

    // Translate
    $translated = [];
    foreach($settings as $key => $val)
    {
      $translated[$key] = Lang::get('settings.' . $val);
    }
    return $translated;
  }
}
