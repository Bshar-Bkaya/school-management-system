<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParentAttachment extends Model
{
  use HasFactory;
  protected $fillable = ['file_name', 'parent_id'];

  public function parent()
  {
    return $this->belongsTo('App\Models\MyParents');
  }
}
