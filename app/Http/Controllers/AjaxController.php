<?php

namespace App\Http\Controllers;

use App\Models\section;
use App\Models\Classroom;
use Illuminate\Http\Request;

class AjaxController extends Controller
{

  public function getSections($id)
  {
    $sections = section::where('classroom_id', $id)->pluck('Name', 'id');
    return $sections;
  }

  public function getClasses($id)
  {
    $classrooms = Classroom::where('Grade_id', $id)->pluck('Name_Class', 'id');
    return $classrooms;
  }
}
