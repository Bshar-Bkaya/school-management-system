<?php

namespace App\Repository\Classes;

use App\Models\Student;
use App\Models\Grade\Grade;
use App\Repository\Interfaces\GraduatedRepoInterface;


class GraduatedRepo implements GraduatedRepoInterface
{
  public function index()
  {
    $students = Student::onlyTrashed()->get();
    return view('pages.students.Graduated.index', compact('students'));
  }

  public function create()
  {
    $Grades = Grade::all();
    return view('pages.students.Graduated.create', compact('Grades'));
  }

  public function softDelete($request)
  {
    $students = Student::where('Grade_id', $request->Grade_id)->where('Classroom_id', $request->Classroom_id)->where('section_id', $request->section_id)->get();
    if ($students->count() < 1) {
      return redirect()->back()->with('error_Graduated', __('لاتوجد بيانات في جدول الطلاب'));
    }

    foreach ($students as $student) {
      student::where('id', $student->id)->Delete();
    }

    toastr()->success(trans('messages.success'));
    return redirect()->route('Graduated.index');
  }

  public function returnData($request)
  {
    $flight = Student::onlyTrashed()->where('id', $request->id)->restore();
    if ($flight) {
      toastr()->success(trans('messages.success'));
    } else {
      toastr()->error(trans('messages.error'));
    }
    return redirect()->route('Graduated.index');
  }

  public function destroy($request)
  {
    $flight = Student::onlyTrashed()->where('id', $request->id)->forceDelete();
    if ($flight) {
      toastr()->success(trans('messages.success'));
    } else {
      toastr()->error(trans('messages.error'));
    }
    return redirect()->route('Graduated.index');
  }
}
