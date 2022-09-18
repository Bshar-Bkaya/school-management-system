<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fee extends Model
{
  use HasFactory;
  use HasTranslations;
  public $translatable = ['title'];
  protected $fillable = ['title', 'amount', 'Grade_id', 'Classroom_id', 'year', 'description', 'Fee_type'];

  public function classroom()
  {
    return $this->belongsTo('App\Models\Classroom', 'Classroom_id');
  }

  public function Grade()
  {
    return $this->belongsTo('App\Models\Grade\Grade', 'Grade_id');
  }
}
