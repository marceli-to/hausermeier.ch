<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class ProjectStoreRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name.de' => 'required|string',
      'location.de' => 'required|string',
      'type.de' => 'required|string',
      'year' => 'required|string',
    ];
  }

  /**
   * Custom message for validation
   *
   * @return array
   */
  public function messages()
  {
    return [
      'name.de.required' => 'Name is required!',
      'location.de.required' => 'Location is required!',
      'type.de.required' => 'Type is required!',
      'year.required' => 'Year is required!',
    ];
  }
}
