<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MyParents extends Authenticatable
{
  use HasFactory;
  use HasTranslations;
  public $translatable = ['Name_Father', 'Job_Father', 'Name_Mother', 'Job_Mother'];
  // protected $table = 'my_parents';
  protected $guarded = [];

  public function parentAttachments()
  {
    return $this->hasMany('App\Models\ParentAttachment');
  }
}
