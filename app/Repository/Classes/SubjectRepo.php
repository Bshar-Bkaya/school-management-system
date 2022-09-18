<?php

namespace App\Repository\Classes;

use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Grade\Grade;
use App\Repository\Interfaces\SubjectRepoInterface;


class  SubjectRepo implements SubjectRepoInterface
{
  public function index()
  {
    $subjects = Subject::get();
    return view('pages.Subjects.index', compact('subjects'));
  }

  public function create()
  {
    $grades = Grade::get();
    $teachers = Teacher::get();
    return view('pages.Subjects.create', compact('grades', 'teachers'));
  }


  public function store($request)
  {
    try {
      $subjects = new Subject();
      $subjects->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
      $subjects->grade_id = $request->Grade_id;
      $subjects->classroom_id = $request->Class_id;
      $subjects->teacher_id = $request->teacher_id;
      $subjects->save();
      toastr()->success(trans('messages.success'));
      return redirect()->route('Subjects.index');
    } catch (\Exception $e) {
      return redirect()->back()->with(['error' => $e->getMessage()]);
    }
  }


  public function edit($id)
  {

    $subject = Subject::findorfail($id);
    $grades = Grade::get();
    $teachers = Teacher::get();
    return view('pages.Subjects.edit', compact('subject', 'grades', 'teachers'));
  }

  public function update($request)
  {
    try {
      $subjects =  Subject::findorfail($request->id);
      $subjects->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
      $subjects->grade_id = $request->Grade_id;
      $subjects->classroom_id = $request->Class_id;
      $subjects->teacher_id = $request->teacher_id;
      $subjects->save();

      toastr()->success(trans('messages.Update'));
      return redirect()->route('Subjects.index');
    } catch (\Exception $e) {
      return redirect()->back()->with(['error' => $e->getMessage()]);
    }
  }

  public function destroy($id)
  {
    try {
      Subject::destroy($id);
      toastr()->error(trans('messages.Delete'));
      return redirect()->back();
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }
}
