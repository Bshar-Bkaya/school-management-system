<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class section extends Model
{
  // use HasFactory;
  use HasTranslations;
  public $translatable = ['Name'];
  public $fillable = ["Name", "grade_id", "classroom_id", "Status", "created_at", "updated_at"];

  public function classroom()
  {
    return $this->belongsTo("\App\Models\classroom", "classroom_id");
  }

  public function grade()
  {
    return $this->belongsTo("App\Models\Grade\Grade", "grade_id");
  }

  public function teachers()
  {
    return $this->belongsToMany('App\Models\Teacher', 'teacher_section');
  }

  public function promotion_old()
  {
    return $this->hasMany("\App\Models\promotion", "section_id_old");
  }

  public function promotion_new()
  {
    return $this->hasMany("\App\Models\promotion", "section_id_new");
  }


  public function students()
  {
    return $this->hasMany("App\Models\student", "section_id");
  }
}
