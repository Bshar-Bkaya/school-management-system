<?php

namespace App\Http\Controllers\Teachers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeachers;
use App\Repository\Interfaces\TeacherRepoInterface;

class TeacherController extends Controller
{

  protected $Teacher;

  public function __construct(TeacherRepoInterface $Teacher)
  {
    $this->Teacher = $Teacher;
  }

  public function index()
  {
    $Teachers = $this->Teacher->getAllTeachers();
    return view('pages.teachers.Teachers', compact('Teachers'));
  }

  public function create()
  {
    $specializations = $this->Teacher->getAllSpecializations();
    $genders         = $this->Teacher->getAllGenders();
    return view('pages.teachers.create', compact('specializations', 'genders'));
  }

  public function store(StoreTeachers $request)
  {
    return $this->Teacher->storeTeacher($request);
  }

  public function show($id)
  {
    //
  }

  public function edit($id)
  {
    $Teachers         = $this->Teacher->editTeacher($id);
    $specializations  = $this->Teacher->getAllSpecializations();
    $genders          = $this->Teacher->getAllGenders($id);
    return view('pages.teachers.Edit', compact('Teachers', 'specializations', 'genders'));
  }

  public function update(StoreTeachers $request)
  {
    return $this->Teacher->updateTeacher($request);
  }

  public function destroy(Request $request)
  {
    return $this->Teacher->deleteTeacher($request->id);
  }
}
