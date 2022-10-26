<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends BaseController
{
  protected $viewPath = 'frontend.pages.contact.index';
  
  /**
   * Constructor
   * 
   * @param Contact $contact
   */

  public function __construct(Contact $contact)
  {
    parent::__construct();
    $this->contact = $contact;
  }

  /**
   * Show the contact page
   *
   * @return \Illuminate\Http\Response
   */

  public function index()
  {
    $data  = $this->contact->with('publishedImages')->get()->first();
    $image = NULL;
    if ($data->publishedImages && isset($data->publishedImages[0]))
    {
      $image = $data->publishedImages[0];
    }
    return 
      view($this->viewPath, 
        [
          'data'  => $data,
          'image' => $image
        ]
    );
  }
}
