<?php

namespace App\Models\Twitter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  use HasFactory;
  protected $fillable = [
    'text',
  ];
}
