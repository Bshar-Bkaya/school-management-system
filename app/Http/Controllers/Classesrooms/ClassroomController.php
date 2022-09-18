<?php

namespace App\Http\Controllers\Classesrooms;

use App\Models\Grade\Grade;
use App\Models\Classroom;
use Yoeunes\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Requests\add_classroom_request;
use App\Http\Controllers\Controller;

class ClassroomController extends Controller
{

  public function index()
  {
    $classrooms = Classroom::all();
    $grades = Grade::all();
    return view('pages.classrooms.classroom', compact('classrooms', 'grades'));
  }

  public function create()
  {
    return "create";
  }

  public function store(add_classroom_request $request)
  {
    try {
      $Classroom = new Classroom;
      $Classroom->setTranslation('Name_Class', 'ar', $request->Name);
      $Classroom->setTranslation('Name_Class', 'en', $request->Name_en);
      $Classroom->Grade_id = $request->Grade;
      $Classroom->Notes = $request->Notes;
      $Classroom->save();

      toastr()->success(trans('messages.success'));
      return redirect()->route('Classroom.index');
    } catch (\Exception $ex) {
      return redirect()->route('Classroom.index')->withErrors(["error" => $ex->getMessage()]);
    }
  }

  public function show($id)
  {
  }

  public function edit()
  {
    return "edit";
  }

  public function update(add_classroom_request $request)
  {
    try {
      $Classroom = Classroom::findOrFail($request->id);
      $Classroom->setTranslation('Name_Class', 'ar', $request->Name);
      $Classroom->setTranslation('Name_Class', 'en', $request->Name_en);
      $Classroom->Grade_id = $request->Grade;
      $Classroom->Notes = $request->Notes;
      $Classroom->update();

      toastr()->success(trans('messages.success'));
      return redirect()->route('Classroom.index');
    } catch (\Exception $ex) {
      return redirect()->route('Classroom.index')->withErrors(["error" => $ex->getMessage()]);
    }
  }

  public function destroy(Request $request)
  {
    try {
      Classroom::findOrFail($request->id)->delete();
      Toastr::success(__('messages.Delete'));
      return redirect()->route('Classroom.index');
    } catch (\Throwable $e) {
      Toastr::error(__('messages.error'));
      return redirect()->route('Classroom.index');
    }
  }

  public function deleteall(Request $request)
  {
    if ($request->selected_box_id != [null]) {
      // create array from classroom id
      $arr = implode('|', $request->selected_box_id);
      $delete_all = explode(',', $arr);
      classroom::whereIn('id', $delete_all)->delete();
      Toastr::success(__('messages.Delete'));
      return redirect()->route('Classroom.index');
    } else {
      Toastr::error(__('الرجاء اختيار صفوف'));
      return redirect()->route('Classroom.index');
    }
  }

  public function filter(Request $request)
  {
    $grades = Grade::all();
    // $classrooms = Classroom::select('*')->where('Grade_id', $request->Grade_id)->get();
    if ($request->Grade_id != -1) {
      $classrooms = Classroom::where('Grade_id', $request->Grade_id)->get();
    } else {
      $classrooms = Classroom::all();
    }
    return view('pages.classrooms.classroom', compact('classrooms', 'grades'));
  }
}
