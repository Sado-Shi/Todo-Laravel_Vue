<?php

namespace App\Http\Controllers\Twitter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\TwitterStoreRequest;
use App\Http\Requests\TwitterUpdateRequest;
use App\Http\Requests\TwitterProfileUpdateRequest;
use App\Models\Twitter\Comment;
use App\Models\Twitter\Like;
use App\Models\User;
use App\Models\Twitter\Post;
use App\Services\PostService;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class TwitterController extends Controller
{
    private $post_service;

    public function __construct(PostService $post_service)
    {
        $this->post_service = $post_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_user = Auth::user();

        return Inertia::render('Twitter/Index', [
            'current_user' => $current_user,
            'all_posts'    => $this->post_service->getAllPost($current_user),
            'my_posts'     => $this->post_service->getMyPost($current_user),
            'liked_posts'  => $this->post_service->getLikedPost($current_user),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        return Inertia::render('Twitter/Create', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TwitterStoreRequest $request)
    {
        Post::create([
            'user_id' => Auth::id(),
            'text' => $request->text,
        ]);

        return Redirect::route('twitter.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $user = Auth::user();

        $likes = Like::where('post_id', $post->id)->get();

        // 自分がいいねしているかどうかのデータを保存
        foreach ($likes as $like) {
            if ($like->user_id === $user->id) {
                $post['is_liked'] = 1;
            } else {
                $post['is_liked'] = 0;
            }
        }

        // いいね数
        $post['count'] = count($likes);
        $post->load('user');

        // Postに紐づくCommentを取得
        $comments = Comment::where('post_id', $post->id)->get()->toArray();
        // コメントしたユーザ名とプロフィール画像を追加
        foreach ($comments as $key => $comment) {
            $comments[$key]['user_name'] = User::where('id', $comment['user_id'])->first()->account_name;
            $comments[$key]['user_image'] = User::where('id', $comment['user_id'])->first()->profile_image;
        }

        return Inertia::render('Twitter/Edit', [
            'post' => $post,
            'user' => $user,
            'likes' => $likes,
            'comments' => $comments,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TwitterUpdateRequest $request, Post $post)
    {
        $post->update($request->all());

        return Redirect::route('twitter.edit', $post);
    }

    /**
     * プロフィール更新
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profileUpdate(TwitterProfileUpdateRequest $request)
    {
        User::where('id', '=', Auth::id())->update($request->all());

        return Redirect::route('twitter.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return Redirect::route('twitter.index');
    }

    /**
     * ファイルアップロード
     *
     * @return \Illuminate\Http\Response
     */
    public function fileUpload(Request $request)
    {
        $file_name = $request->file->getClientOriginalName();
        $request->file->storeAs('public/', $file_name);

        $user = User::find(Auth::id());
        $user->update(['profile_image' => '/storage/' . $file_name]);

        return back();
    }
}
