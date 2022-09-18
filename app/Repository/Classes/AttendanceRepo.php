<?php

namespace App\Repository\Classes;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Attendance;
use App\Models\Grade\Grade;
use App\Repository\Interfaces\AttendanceRepoInterface;


class AttendanceRepo implements AttendanceRepoInterface
{
  public function index()
  {
    $Grades = Grade::with(['sections'])->get();
    $list_Grades = Grade::all();
    $teachers = Teacher::all();
    return view('pages.Attendance.Sections', compact('Grades', 'list_Grades', 'teachers'));
  }

  public function show($id)
  {
    $students = Student::with('attendance')->where('section_id', $id)->get();
    return view('pages.Attendance.index', compact('students'));
  }

  public function store($request)
  {
    try {
      $dateNow = date('Y-m-d');
      if (isset($request->attendence)) {
        $edit_attendence = Attendance::where('attendence_date', $dateNow)->Where('student_id', $request->id)->first();
        if ($request->attendence == 'presence') {
          $attendence_status = true;
        } else if ($request->attendence == 'absent') {
          $attendence_status = false;
        }

        $edit_attendence->update([
          'attendence_status' => $attendence_status
        ]);
      } elseif (isset($request->attendences)) {
        foreach ($request->attendences as $studentid => $attendence) {

          if ($attendence == 'presence') {
            $attendence_status = true;
          } else if ($attendence == 'absent') {
            $attendence_status = false;
          }

          Attendance::create([
            'student_id' => $studentid,
            'grade_id' => $request->grade_id,
            'classroom_id' => $request->classroom_id,
            'section_id' => $request->section_id,
            'teacher_id' => 1,
            'attendence_date' => $dateNow,
            'attendence_status' => $attendence_status
          ]);
        }
      } else {
        toastr()->error(trans('الرجاء اختيار الحضور او الغياب'));
        return redirect()->back();
      }
      toastr()->success(trans('messages.success'));
      return redirect()->back();
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  public function destroy($request)
  {
    // TODO: Implement destroy() method.
  }
}
