<?php

namespace App\Models\Twitter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'post_id',
        'text',
    ];

    public function post()
    {
        return $this->belongsTo('App\Models\Twitter\Post');
    }
}
