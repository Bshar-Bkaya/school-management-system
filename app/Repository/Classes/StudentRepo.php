<?php

namespace App\Repository\Classes;

use App\Models\Image;
use App\Models\Gender;
use App\Models\section;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\MyParents;
use App\Models\TypeBlood;
use App\Models\grade\Grade;
use App\Models\Nationalitie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Repository\Interfaces\StudentRepoInterface;


class StudentRepo implements StudentRepoInterface
{
  // Get All Student
  public function getAllStudents()
  {
    $students = Student::all();
    return view('pages.students.index', compact('students'));
  }

  // Create Student
  public function createStudent()
  {
    $data['my_classes']  = Grade::all();
    $data['parents']     = MyParents::all();
    $data['Genders']     = $this->getAllGenders();
    $data['nationals']   = Nationalitie::all();
    $data['bloods']      = TypeBlood::all();

    return view('pages.students.add', $data);
  }

  // Store Student
  public function storeStudent($request)
  {
    DB::beginTransaction();
    try {
      $students = new Student();
      $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
      $students->email = $request->email;
      $students->password = Hash::make($request->password);
      $students->gender_id = $request->gender_id;
      $students->nationalitie_id = $request->nationalitie_id;
      $students->blood_id = $request->blood_id;
      $students->Date_Birth = $request->Date_Birth;
      $students->Grade_id = $request->Grade_id;
      $students->Classroom_id = $request->Classroom_id;
      $students->section_id = $request->section_id;
      $students->parent_id = $request->parent_id;
      $students->academic_year = $request->academic_year;

      // Insert Img
      if ($request->hasfile('photo')) {
        // Insert On Disk
        $name = $request->file('photo')->getClientOriginalName();
        $request->file('photo')->storeAs('attachments/photos/', $name, 'upload_attachments');
        // Insert On Table
        $students->photo = $name;
      }

      $students->save();

      // Insert Attachment
      if ($request->hasfile('photos')) {
        foreach ($request->file('photos') as $file) {
          $name = $file->getClientOriginalName();
          $file->storeAs('attachments/students/' . $students->name, $name, 'upload_attachments');

          // insert in image_table
          $images = new Image();
          $images->filename = $name;
          $images->imageable_id = $students->id;
          $images->imageable_type = 'App\Models\Student';
          $images->save();
        }
      }

      DB::commit();
      toastr()->success(trans('messages.success'));
      return redirect()->route('Students.create');
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  // Edit Student
  function editStudent($id)
  {
    $data['Students']   = Student::findOrFail($id);
    $data['Genders']    = $this->getAllGenders();
    $data['nationals']  = $this->getAllNationals();
    $data['bloods']     = $this->getAllBloods();
    $data['Grades']     = Grade::all();
    $data['parents']    = MyParents::all();

    return view('pages.students.edit', $data);
  }

  // Update Student
  public function updateStudent($request)
  {
    try {
      $Edit_Students = Student::findorfail($request->id);
      $Edit_Students->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
      $Edit_Students->email = $request->email;
      $Edit_Students->password = Hash::make($request->password);
      $Edit_Students->gender_id = $request->gender_id;
      $Edit_Students->nationalitie_id = $request->nationalitie_id;
      $Edit_Students->blood_id = $request->blood_id;
      $Edit_Students->Date_Birth = $request->Date_Birth;
      $Edit_Students->Grade_id = $request->Grade_id;
      $Edit_Students->Classroom_id = $request->Classroom_id;
      $Edit_Students->section_id = $request->section_id;
      $Edit_Students->parent_id = $request->parent_id;
      $Edit_Students->academic_year = $request->academic_year;
      $Edit_Students->save();

      toastr()->success(trans('messages.Update'));
      return redirect()->route('Students.index');
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  // Delete Student
  public function deleteStudent($id)
  {
    Student::destroy($id);
    toastr()->success(trans('messages.Delete'));
    return redirect()->route('Students.index');
  }

  public function softDeleteStudent($id)
  {
    $student = Student::find($id);
    if ($student) {
      $student->delete();
      toastr()->success(trans('messages.success'));
    } else {
      toastr()->error(trans('messages.error'));
    }
    return redirect()->route('Students.index');
  }

  // Get All Sections
  public function getAllSections()
  {
    $Sections = section::all();
    return $Sections;
  }

  // Get All Classrooms
  public function getAllClassrooms()
  {
    $classrooms = Classroom::all();
    return $classrooms;
  }

  // Get All Genders
  public function getAllGenders()
  {
    $genders = Gender::all();
    return $genders;
  }

  // Get All Nationals
  public function getAllNationals()
  {
    $Nationals = Nationalitie::all();
    return $Nationals;
  }

  // Get All bloods
  public function getAllBloods()
  {
    $bloods = TypeBlood::all();
    return $bloods;
  }

  // Upload Attachment
  public function uploadAttach($request)
  {
    // insert img
    if ($request->hasfile('photos')) {
      foreach ($request->file('photos') as $file) {
        $name = $file->getClientOriginalName();
        $file->storeAs('attachments/students/' . $request->student_name, $name, 'upload_attachments');

        // insert in image_table
        $images = new Image();
        $images->filename = $name;
        $images->imageable_id = $request->student_id;
        $images->imageable_type = 'App\Models\Student';
        $images->save();

        toastr()->success(trans('messages.success'));
        return redirect()->back();
      }
    }
  }

  // Download Attachment
  public function downloadAttach($foldername, $filename)
  {
    return response()->download(public_path('attachments/students/' . $foldername . '/' . $filename));
  }

  // Show Attachment
  public function showAttach($foldername, $filename)
  {
    $path = public_path() . '/attachments/students/' . $foldername . '/' . $filename;
    return response()->file($path);
  }

  // Delete Attachment
  public function deleteAttach($request)
  {
    // Delete img from server disk
    Storage::disk('upload_attachments')->delete('attachments/students/' . $request->student_name . '/' . $request->filename);

    // Delete from database
    image::where('id', $request->id)->where('filename', $request->filename)->delete();
    toastr()->error(trans('messages.Delete'));
    return redirect()->route('Students.show', $request->student_id);
  }
}
