<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
  use HasTranslations;
  public $translatable = ['Name'];
  protected $guarded = [];

  public function specialization()
  {
    return $this->belongsTo('App\Models\Specialization', 'Specialization_id');
  }

  public function gender()
  {
    return $this->belongsTo('App\Models\Gender', 'Gender_id');
  }

  public function sections()
  {
    return $this->belongsToMany('App\Models\section', 'teacher_section');
  }
}
