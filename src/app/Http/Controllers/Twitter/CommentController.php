<?php

namespace App\Http\Controllers\Twitter;

use App\Http\Controllers\Controller;
use App\Models\Twitter\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * コメントの投稿
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Comment::create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            'text' => $request->comment,
        ]);

        return redirect()->route('twitter.edit', $request->post_id);
    }
}
