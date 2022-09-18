<?php

namespace App\Models\Grade;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
  use HasTranslations;
  public $translatable = ['Name'];
  public $timestamps = true;
  protected $fillable = ['Name', 'Notes', "created_at", "updated_at"];
  protected $table = 'Grades';

  public function sections()
  {
    return $this->hasMany('App\Models\section');
  }
}
