<?php
namespace App\Http\Controllers\Api;
use App\Models\Contact;
use App\Models\ContactImage;
use App\Http\Resources\DataCollection;
use App\Http\Requests\ContactStoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
  protected $contact;
  protected $contactImage;
  
  /**
   * Constructor
   * 
   * @param Contact $contact
   */

  public function __construct(Contact $contact, ContactImage $contactImage)
  {
    $this->contact = $contact;
    $this->contactImage = $contactImage;
  }

  /**
   * Get all records
   *
   * @return \Illuminate\Http\Response
   */

  public function get()
  {
    return new DataCollection($this->contact->get());
  }

  /**
   * Fetch one record
   *
   * @param Contact $contact
   * @return \Illuminate\Http\Response
   */

  public function getOne(Contact $contact)
  {
    return response()->json($contact);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  
  public function store(Request $request)
  {   
    $contact = new Contact([
      'address' => [
        'de' => $request->input('address.de'),
        'en' => $request->input('address.en'),
      ],
      'imprint' => [
        'de' => $request->input('imprint.de'),
        'en' => $request->input('imprint.en'),
      ],
      'publish' => $request->input('publish') ? $request->input('publish') : 0,
    ]);
    $contact->save();
    
    // Documents
    if (!empty($request->images))
    {
      foreach($request->images as $i)
      {
        $image = new ContactImage([
          'contact_id' => $contact->id,
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
        $image->save();
      }
    }

    return response()->json(['contactId' => $contact->id]);
  }

  /**
   * Edit a specified resource.
   *
   * @param Contact $contact
   * @return \Illuminate\Http\Response
   */
  public function edit(Contact $contact)
  {
    $contact = $this->contact->with('images')->findOrFail($contact->id);
    return response()->json($contact);
  }

  /**
   * Update the status of the specified resource.
   *
   * @param Contact $contact
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function update(Contact $contact, ContactStoreRequest $request)
  {
    $contact = $this->contact->findOrFail($contact->id);
    $contact->setTranslation('address', 'de', $request->input('address.de'));
    $contact->setTranslation('imprint', 'de', $request->input('imprint.de'));
    $contact->setTranslation('address', 'en', $request->input('address.en'));
    $contact->setTranslation('imprint', 'en', $request->input('imprint.en'));
    $contact->publish  = $request->input('publish');
    $contact->save();
   
    // Documents
    if (!empty($request->images))
    {
      foreach($request->images as $i)
      {
        $image = ContactImage::updateOrCreate(
          ['id' => $i['id']], 
          [
            'contact_id' => $contact->id,
            'name' => $i['name'],
            'caption' => [
              'de' => $i['caption']['de'],
              'en' => $i['caption']['en']
            ],
            'coords_w' => $i['coords_w'] ? round($i['coords_w'], 12) : NULL,
            'coords_h' => $i['coords_h'] ? round($i['coords_h'], 12) : NULL,
            'coords_x' => $i['coords_x'] ? round($i['coords_x'], 12) : NULL,
            'coords_y' => $i['coords_y'] ? round($i['coords_y'], 12) : NULL,
            'publish'  => $i['publish'] ? $i['publish'] : 0,
          ]
        );
      }
    }

    return response()->json('successfully updated');
  }

  /**
   * Update the status of the specified resource.
   *
   * @param  Contact $contact
   * @return \Illuminate\Http\Response
   */
  public function status(Contact $contact)
  {
    $contact->publish = $contact->publish == 0 ? 1 : 0;
    $contact->save();
    return response()->json($contact->publish);
  }

  /**
   * Remove the specified resource from storage.
   *
   * \Observers\ContactObserver observes and deletes child elements (images, images).
   *
   * @param  Contact $contact
   * @return \Illuminate\Http\Response
   */
  public function destroy(Contact $contact)
  {
    $contact->delete();
    return response()->json('successfully deleted');
  }
}
