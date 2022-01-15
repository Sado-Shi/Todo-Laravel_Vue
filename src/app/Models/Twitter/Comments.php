<?php

namespace App\Twitter\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = [
    'text',
  ];
}
