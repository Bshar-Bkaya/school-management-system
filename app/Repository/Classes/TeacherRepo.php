<?php

namespace App\Repository\Classes;

use App\Models\Gender;
use App\Models\Teacher;
use App\Models\Specialization;
use Illuminate\Support\Facades\Hash;
use App\Repository\Interfaces\TeacherRepoInterface;



class TeacherRepo implements TeacherRepoInterface
{

  // Get All Teachers
  public function getAllTeachers()
  {
    return Teacher::all();
  }

  // Get All Teachers
  public function getAllSpecializations()
  {
    return Specialization::all();
  }

  // Store Teachers
  public function getAllGenders()
  {
    return Gender::all();
  }

  // Get All Teachers
  public function storeTeacher($request)
  {
    try {
      $Teachers = new Teacher();
      $Teachers->email = $request->Email;
      $Teachers->password =  Hash::make($request->Password);
      $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
      $Teachers->Specialization_id = $request->Specialization_id;
      $Teachers->Gender_id = $request->Gender_id;
      $Teachers->Joining_Date = $request->Joining_Date;
      $Teachers->Address = $request->Address;
      $Teachers->save();

      toastr()->success(trans('messages.success'));
      return redirect()->route('Teachers.create');
    } catch (\Exception $e) {
      return redirect()->back()->with(['error' => $e->getMessage()]);
    }
  }

  // Edit Teachers
  public function editTeacher($id)
  {
    return Teacher::findOrFail($id);
  }

  // Update Teachers
  public function updateTeacher($request)
  {
    try {
      $Teachers = $this->editTeacher($request->id);
      $Teachers->email = $request->Email;
      $Teachers->password =  Hash::make($request->Password);
      $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
      $Teachers->Specialization_id = $request->Specialization_id;
      $Teachers->Gender_id = $request->Gender_id;
      $Teachers->Joining_Date = $request->Joining_Date;
      $Teachers->Address = $request->Address;
      $Teachers->save();

      toastr()->success(trans('messages.success'));
      return redirect()->route('Teachers.index');
    } catch (\Exception $e) {
      return redirect()->back()->with(['error' => $e->getMessage()]);
    }
  }

  // Delete Teachers
  public function deleteTeacher($id)
  {
    try {
      Teacher::findOrFail($id)->delete();
      toastr()->success(trans('messages.Delete'));
      return redirect()->route('Teachers.index');
    } catch (\Exception $e) {
      return redirect()->back()->with(['error' => $e->getMessage()]);
    }
  }
}
