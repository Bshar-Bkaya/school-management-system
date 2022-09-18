<?php

namespace App\Http\Controllers\Students;


use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Repository\Interfaces\StudentRepoInterface;

class StudentController extends Controller
{

  protected $Student;

  public function __construct(StudentRepoInterface $Student)
  {
    $this->Student = $Student;
  }

  public function index()
  {
    return $this->Student->getAllStudents();
  }

  public function create()
  {
    return $this->Student->createStudent();
  }

  public function store(StoreStudentRequest $request)
  {
    return $this->Student->storeStudent($request);
  }

  public function show($id)
  {
    $Student = Student::findOrFail($id);
    return view('pages.students.show', compact('Student'));
  }

  public function edit($id)
  {
    return $this->Student->editStudent($id);
  }

  public function update(StoreStudentRequest $request)
  {
    return $this->Student->updateStudent($request);
  }

  public function destroy(Request $request)
  {
    return $this->Student->deleteStudent($request->id);
  }

  public function softDelete($id)
  {
    return $this->Student->softDeleteStudent($id);
  }

  public function uploadAttach(Request $request)
  {
    return $this->Student->uploadAttach($request);
  }

  public function downloadAttach($foldername, $filename)
  {
    return $this->Student->downloadAttach($foldername, $filename);
  }

  public function showAttach($foldername, $filename)
  {
    return $this->Student->showAttach($foldername, $filename);
  }

  public function deleteAttach(Request $request)
  {
    return $this->Student->deleteAttach($request);
  }
}
