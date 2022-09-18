<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Interfaces\AttendanceRepoInterface;

class AttendanceController extends Controller
{
  protected $Attendance;

  public function __construct(AttendanceRepoInterface $Attendance)
  {
    $this->Attendance = $Attendance;
  }


  public function index()
  {
    return $this->Attendance->index();
  }



  public function store(Request $request)
  {
    return $this->Attendance->store($request);
  }


  public function show($id)
  {
    return $this->Attendance->show($id);
  }

  public function destroy($id)
  {
    //
  }
}
