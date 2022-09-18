<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Authenticatable
{
  use SoftDeletes;
  use HasTranslations;
  public $translatable = ['name'];
  protected $guarded = [];

  public function gender()
  {
    return $this->belongsTo('App\Models\Gender');
  }

  public function myparent()
  {
    return $this->belongsTo('App\Models\MyParents', 'parent_id');
  }

  public function Nationality()
  {
    return $this->belongsTo('App\Models\Nationalitie', 'nationalitie_id');
  }

  // علاقة بين الطلاب والمراحل الدراسية لجلب اسم المرحلة في جدول الطلاب
  public function grade()
  {
    return $this->belongsTo('App\Models\Grade\Grade', 'Grade_id');
  }

  public function classroom()
  {
    return $this->belongsTo('App\Models\Classroom', 'Classroom_id');
  }

  public function section()
  {
    return $this->belongsTo('App\Models\section', 'section_id');
  }

  public function parents()
  {
    return $this->belongsTo('App\Models\MyParents', 'parent_id');
  }

  public function images()
  {
    return $this->morphMany('App\Models\Image', 'imageable');
  }

  public function student_account()
  {
    return $this->hasMany('App\Models\StudentAccount', 'student_id');
  }

  public function attendance()
  {
    return $this->hasMany('App\Models\Attendance', 'student_id');
  }
}
