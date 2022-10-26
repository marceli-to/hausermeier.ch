<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\Team;
use App\Models\TeamImage;
use App\Models\Profile;
use App\Models\ProfileImage;
use App\Models\Job;
use App\Models\JobImage;
use Illuminate\Http\Request;

class OfficeController extends BaseController
{
  protected $viewPath = 'frontend.pages.office.';
  
  /**
   * Constructor
   * 
   * @param Contact $contact
   */

  public function __construct(
    Team $team,
    TeamImage $teamImage,
    Profile $profile,
    ProfileImage $profileImage,
    Job $job,
    JobImage $jobImage
  )
  {
    parent::__construct();
    $this->team         = $team;
    $this->teamImage    = $teamImage;
    $this->profile      = $profile;
    $this->profileImage = $profileImage;
    $this->job          = $job;
    $this->jobImage     = $jobImage;
  }

  /**
   * Show the about page
   *
   * @return \Illuminate\Http\Response
   */

  public function about()
  {
    // Team -> Data
    $partner_data  = $this->team->published()->with('publishedPortrait')->where('category', '=', 1)->orderBy('order')->get();
    $employee_data = $this->team->published()->where('category', '=', 2)->orderBy('order')->get();
    $former_data   = $this->team->published()->where('category', '=', 3)->orderBy('order')->get();

    // Team -> Images
    $partner_images  = $this->teamImage->published()->where('category', '=', 1)->get();
    $employee_images  = $this->teamImage->published()->where('category', '=', 2)->get();

    // Profile
    $profile_data  = $this->profile->published()->get();
    $profile_image = $this->profileImage->published()->get()->first();

    return 
      view($this->viewPath . 'about', 
        [
          'partner_data'    => $partner_data,
          'partner_images'  => $partner_images,
          'employee_data'   => $employee_data,
          'employee_images' => $employee_images,
          'profile_data'    => $profile_data,
          'profile_image'   => $profile_image,
          'former_data'     => $former_data
        ]
    );
  }

  /**
   * Show the jobs page
   *
   * @return \Illuminate\Http\Response
   */

  public function jobs()
  {
    $jobs = $this->job->published()->with('publishedImages')->orderBy('order')->get();
    return 
      view($this->viewPath . 'jobs', 
        [
          'jobs' => $jobs,
        ]
    );
  }
}
