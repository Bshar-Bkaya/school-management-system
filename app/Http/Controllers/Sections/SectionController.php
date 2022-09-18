<?php

namespace App\Http\Controllers\Sections;

use App\Models\Section;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\grade\Grade;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectionRequest;

class SectionController extends Controller
{
  public function index()
  {
    $Grades        = Grade::with(['sections'])->get();
    $list_Grades   = Grade::all();
    $list_teachers = Teacher::all();

    return view("pages.section.section", compact('Grades', 'list_Grades', 'list_teachers'));
  }

  public function store(StoreSectionRequest $request)
  {
    try {
      $Section = new Section;
      $Section->setTranslation('Name', 'en', $request->Name_Section_En);
      $Section->setTranslation('Name', 'ar', $request->Name_Section_Ar);
      $Section->grade_id = $request->grade_id;
      $Section->classroom_id = $request->classroom_id;
      $Section->Status = 1;
      $Section->save();
      // Set Keys To Pivot Table
      $Section->teachers()->attach($request->teacher_id);

      Toastr::success(__('messages.success'));
      return redirect()->route('Section.index');
    } catch (\Throwable $e) {
      Toastr::error(__('messages.error'));
      return redirect()->route('Section.index');
    }
  }

  public function update(StoreSectionRequest $request)
  {
    try {
      $Section = Section::findOrFail($request->id);
      $Section->setTranslation('Name', 'en', $request->Name_Section_En);
      $Section->setTranslation('Name', 'ar', $request->Name_Section_Ar);
      $Section->grade_id = $request->grade_id;
      $Section->classroom_id = $request->classroom_id;
      // $Section->Status = $request->Status == 'on' ? 1 : 2;
      $Section->Status = isset($request->Status) ? 1 : 2;
      $Section->update();
      // Update Pivot Table
      $Section->teachers()->sync($request->teacher_id);

      Toastr::success(__('messages.success'));
      return redirect()->route('Section.index');
    } catch (\Throwable $e) {
      Toastr::error(__('messages.error'));
      return redirect()->route('Section.index');
    }
  }

  public function destroy(Request $request)
  {
    try {
      $section = section::findOrFail($request->id)->delete();
      Toastr::success(__('messages.Delete'));
      return redirect()->route('Section.index');
    } catch (\Throwable $e) {
      Toastr::error(__('messages.error'));
      return redirect()->route('Section.index');
    }
  }
}
