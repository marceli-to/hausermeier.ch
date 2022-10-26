<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class ProjectTextStoreRequest extends FormRequest
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
      'text.de' => 'required',
      'project_id' => 'required',
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
      'text.de.required' => 'Date is required!',
      'project_id.required' => 'Project id is required!',
    ];
  }
}
