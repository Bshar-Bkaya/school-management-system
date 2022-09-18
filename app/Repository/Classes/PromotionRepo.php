<?php

namespace App\Repository\Classes;

use App\Models\Student;
use App\Models\Promotion;
use App\Models\Grade\Grade;
use Illuminate\Support\Facades\DB;
use App\Repository\Interfaces\PromotionRepoInterface;

class PromotionRepo implements PromotionRepoInterface
{
  public function index()
  {
    $Grades = Grade::all();
    return view('pages.students.promotion.index', compact('Grades'));
  }

  public function store($request)
  {
    DB::beginTransaction();

    try {
      $students = Student::where('Grade_id', $request->Grade_id)->where('Classroom_id', $request->Classroom_id)->where('section_id', $request->section_id)->where('academic_year', $request->academic_year)->get();
      if ($students->count() < 1) {
        toastr()->error(__('لاتوجد مثل هذه البيانات في جدول الطلاب'));
        return redirect()->back();
      }

      foreach ($students as $student) {
        // Create Array From Ids
        $ids = explode(',', $student->id);

        // Update In Table Student
        student::whereIn('id', $ids)
          ->update([
            'Grade_id'      => $request->Grade_id_new,
            'Classroom_id'  => $request->Classroom_id_new,
            'section_id'    => $request->section_id_new,
            'academic_year' => $request->academic_year_new,
          ]);

        // insert in to promotions
        Promotion::updateOrCreate([
          'student_id'        => $student->id,
          'from_grade'        => $request->Grade_id,
          'from_Classroom'    => $request->Classroom_id,
          'from_section'      => $request->section_id,
          'to_grade'          => $request->Grade_id_new,
          'to_Classroom'      => $request->Classroom_id_new,
          'to_section'        => $request->section_id_new,
          'academic_year'     => $request->academic_year,
          'academic_year_new' => $request->academic_year_new,
        ]);
      }
      DB::commit();
      toastr()->success(trans('messages.success'));
      return redirect()->back();
    } catch (\Exception $e) {
      DB::rollback();
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  public function create()
  {
    $promotions = Promotion::all();
    return view('pages.students.promotion.management', compact('promotions'));
  }

  public function destroy($request)
  {
    try {
      // التراجع عن الكل
      if ($request->page_id == 1) {
        $Promotions = Promotion::all();
        foreach ($Promotions as $Promotion) {
          //التحديث في جدول الطلاب
          $ids = explode(',', $Promotion->student_id);
          student::whereIn('id', $ids)
            ->update([
              'Grade_id' => $Promotion->from_grade,
              'Classroom_id' => $Promotion->from_Classroom,
              'section_id' => $Promotion->from_section,
              'academic_year' => $Promotion->academic_year,
            ]);
        }

        //حذف جدول الترقيات
        Promotion::truncate();
      } else {
        $Promotion = Promotion::findorfail($request->id);
        Student::where('id', $Promotion->student_id)
          ->update([
            'Grade_id' => $Promotion->from_grade,
            'Classroom_id' => $Promotion->from_Classroom,
            'section_id' => $Promotion->from_section,
            'academic_year' => $Promotion->academic_year,
          ]);

        Promotion::destroy($request->id);
      }

      toastr()->error(trans('messages.Delete'));
      return redirect()->back();
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }
}
