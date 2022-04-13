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
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TwitterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_user = Auth::user();

        $count_like = DB::table('likes')
            ->selectRaw('post_id, count(*) as `count`')
            ->groupBy('post_id');

        $new_post = new Post();

        // 全ての投稿とそれにログインユーザがいいねしているか(タイムライン)
        $posts = $new_post->newQuery()
            ->leftJoin('likes', function ($query) use ($current_user) {
                // いいねされた状態のものを結合
                // 結合前の結合条件を指定
                $query->on('posts.id', '=', 'likes.post_id');
                // 結合後の条件でデータ絞り込み
                // （ログインしているユーザのいいね）
                $query->where('likes.user_id', $current_user->id);
            })
            ->leftJoinSub($count_like, 'count_like', function ($join) {
                $join->on('posts.id', '=', 'count_like.post_id');
            })
            ->selectRaw('posts.*, IFNULL(count_like.`count`, 0) as `count`, posts.id = IFNULL(likes.post_id, 0) as is_liked')
            ->orderBy('created_at', 'desc')
            ->get();

        // リレーション
        $posts->load('user');

        // 投稿に紐づくコメント数を取得
        $posts->each(function ($post) {
            $post->comment_count = $post->comments()->count();
        });

        return Inertia::render('Twitter/Index', [
            'current_user' => $current_user,
            'posts' => $posts,
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
