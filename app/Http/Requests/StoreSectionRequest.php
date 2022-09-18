<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectionRequest extends FormRequest
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

      'Name_Section_Ar' => 'required',
      'Name_Section_En' => 'required',
      'grade_id'        => 'required',
      'classroom_id'    => 'required',
    ];
  }

  public function messages()
  {
    return [
      'Name_Section_Ar.required' => trans('section.required_ar'),
      'Name_Section_En.required' => trans('section.required_en'),
      'grade_id.required'        => trans('section.grade_id_required'),
      'classroom_id.required'    => trans('section.classroom_required'),
    ];
  }
}
