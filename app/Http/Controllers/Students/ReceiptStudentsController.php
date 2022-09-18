<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Interfaces\ReceiptStudentRepoInterface;

class ReceiptStudentsController extends Controller
{
  protected $Receipt_Student;

  public function __construct(ReceiptStudentRepoInterface $Receipt_Student)
  {
    $this->Receipt_Student = $Receipt_Student;
  }

  public function index()
  {
    return $this->Receipt_Student->index();
  }

  public function create()
  {
    //
  }

  public function store(Request $request)
  {
    return $this->Receipt_Student->store($request);
  }

  public function show($id)
  {
    return $this->Receipt_Student->show($id);
  }

  public function edit($id)
  {
    return $this->Receipt_Student->edit($id);
  }

  public function update(Request $request)
  {
    return $this->Receipt_Student->update($request);
  }

  public function destroy(Request $request)
  {
    return $this->Receipt_Student->destroy($request->id);
  }
}
