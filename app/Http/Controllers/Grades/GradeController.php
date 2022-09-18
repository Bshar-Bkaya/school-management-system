<?php

namespace App\Http\Controllers\Grades;


use App\Models\Classroom;
use App\Models\grade\Grade;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Requests\StoreRequest;
use App\Http\Controllers\Controller;

class GradeController extends Controller
{
  public function index()
  {
    $Grades = Grade::all();
    return view("pages.Grades.Grades", compact('Grades'));
  }

  public function store(StoreRequest $request)
  {

    // -----The validation on unique in StoreRequest------
    // if (Grade::where('Name->ar', $request->Name)->orWhere('Name->en', $request->Name_en)->exists()) {
    //   return redirect()->back()->withErrors(__('messages.alredy_exist'));
    // }

    try {
      $Grade = new Grade;
      $Grade->setTranslation('Name', 'en', $request->Name_en);
      $Grade->setTranslation('Name', 'ar', $request->Name);
      $Grade->Notes = $request->Notes;
      $Grade->save();

      Toastr::success(__('messages.success'));
      return redirect()->route('Grades.index');
    } catch (\Throwable $e) {
      Toastr::error(__('messages.error'));
      return redirect()->route('Grades.index');
    }
  }

  public function update(StoreRequest $request)
  {
    try {
      $Grade = Grade::findOrFail($request->id);
      $Grade->setTranslation('Name', 'en', $request->Name_en);
      $Grade->setTranslation('Name', 'ar', $request->Name);
      $Grade->Notes = $request->Notes;
      $Grade->update();

      Toastr::success(__('messages.success'));
      return redirect()->route('Grades.index');
    } catch (\Throwable $e) {
      Toastr::error(__('messages.error'));
      return redirect()->route('Grades.index');
    }
  }

  public function destroy(Request $request)
  {
    try {
      $classrooms = Classroom::where('Grade_id', $request->id)->get();
      if (count($classrooms) == 0) {
        Grade::findOrFail($request->id)->delete();
        Toastr::success(__('messages.Delete'));
      }else{
        Toastr::error(__('messages.their_is_classroom'));
      }
      return redirect()->route('Grades.index');
    } catch (\Throwable $e) {
      Toastr::error(__('messages.error'));
      return redirect()->route('Grades.index');
    }
  }
}
