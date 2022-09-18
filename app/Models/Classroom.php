<?php

namespace App\Models;

use App\Models\grade\Grade;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
  use HasTranslations;
  public $translatable = ['Name_Class'];
  protected $table = 'Classrooms';
  public $timestamps = true;
  protected $fillable = ['Name_Class', 'Grade_id', 'Notes'];

  public function Grades()
  {
    return $this->belongsTo('App\Models\Grade\Grade','Grade_id');
  }
}
