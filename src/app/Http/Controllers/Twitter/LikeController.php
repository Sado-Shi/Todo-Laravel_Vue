<?php

namespace App\Http\Controllers\Twitter;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Twitter\Post;
use App\Models\User;
use App\Models\Twitter\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        $likes = Like::with('user:id,account_name,body,profile_image')->where('post_id', $post->id)->get(['id', 'post_id', 'user_id']);

        return Inertia::render('Twitter/LikedUser', [
            'post' => $post,
            'likes' => $likes,
        ]);
    }

    /**
     * いいねがついていない場合、追加
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post)
    {
        Like::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
        ]);

        return redirect()->back();
    }

    /**
     * いいねがついていた場合、削除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Like::where('post_id', $post->id)->where('user_id', Auth::id())->first()->delete();

        return redirect()->back();
    }
}
