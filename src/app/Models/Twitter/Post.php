<?php

namespace App\Models\Twitter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'text',
        'user_id'
    ];

    protected $hidden = ['deleted_at', 'updated_at', 'created_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Twitter\Like');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Twitter\Comment');
    }
}
