<?php

namespace App\Models;

use App\Models\Gender;
use App\Models\section;
use App\Models\Student;
use App\Models\Grade\Grade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
  use HasFactory;

  protected $fillable = [
    'student_id',
    'grade_id',
    'classroom_id',
    'section_id',
    'teacher_id',
    'attendence_date',
    'attendence_status',
  ];

  public function students()
  {
    return $this->belongsTo(Student::class, 'student_id');
  }


  public function gender()
  {
    return $this->belongsTo(Gender::class, 'gender_id');
  }

  public function grade()
  {
    return $this->belongsTo(Grade::class, 'grade_id');
  }

  public function section()
  {
    return $this->belongsTo(section::class, 'section_id');
  }
}
