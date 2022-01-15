<?php

namespace App\Twitter\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
  use HasFactory;
  protected $fillable = [
    'text',
  ];
}
