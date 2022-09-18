<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class add_classroom_request extends FormRequest
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
      'Name'     => 'required|unique:classrooms,Name_Class->ar,' . $this->id,
      'Name_en'  => 'required|unique:classrooms,Name_Class->en,' . $this->id,
      'Grade'    => 'required',
    ];
  }

  public function messages()
  {
    return [
      'Name.required' => trans('validation.required'),
      'Name_class_en.required' => trans('validation.required'),
    ];
  }
}
