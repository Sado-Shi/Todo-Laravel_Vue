<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Twitter\Post;

/**
 * 投稿関連のサービス
 */
class PostService
{
    // 全ての投稿に関連するデータを取得
    public function getAllPost($user)
    {
        $count_like = DB::table('likes')
            ->selectRaw('post_id, count(*) as `count`')
            ->groupBy('post_id');

        $new_post = new Post();

        // 全ての投稿とそれにログインユーザがいいねしているか(タイムライン)
        $all_posts = $new_post->newQuery()
            ->leftJoin('likes', function ($query) use ($user) {
                // いいねされた状態のものを結合
                // 結合前の結合条件を指定
                $query->on('posts.id', '=', 'likes.post_id');
                // 結合後の条件でデータ絞り込み
                // （ログインしているユーザのいいね）
                $query->where('likes.user_id', $user->id);
            })
            ->leftJoinSub($count_like, 'count_like', function ($join) {
                $join->on('posts.id', '=', 'count_like.post_id');
            })
            ->selectRaw('posts.*, IFNULL(count_like.`count`, 0) as `count`, posts.id = IFNULL(likes.post_id, 0) as is_liked')
            ->orderBy('created_at', 'desc')
            ->paginate(3);
        // ->get()

        // リレーション
        $all_posts->load('user');

        // 投稿に紐づくコメント数を取得
        $all_posts->each(function ($post) {
            $post->comment_count = $post->comments()->count();
        });

        return $all_posts;
    }

    // ログインユーザのみの投稿データを取得
    public function getMyPost($user)
    {
        $count_like = DB::table('likes')
            ->selectRaw('post_id, count(*) as `count`')
            ->groupBy('post_id');

        $new_post = new Post();

        $my_posts = $new_post->newQuery()
            ->leftJoin('likes', function ($query) use ($user) {
                // いいねされた状態のものを結合
                // 結合前の結合条件を指定
                $query->on('posts.id', '=', 'likes.post_id');
                // 結合後の条件でデータ絞り込み
                // （ログインしているユーザのいいね）
                $query->where('likes.user_id', $user->id);
            })
            ->leftJoinSub($count_like, 'count_like', function ($join) {
                $join->on('posts.id', '=', 'count_like.post_id');
            })
            ->selectRaw('posts.*, IFNULL(count_like.`count`, 0) as `count`, posts.id = IFNULL(likes.post_id, 0) as is_liked')
            ->where('posts.user_id', '=', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(3);
        // ->get()

        // リレーション
        $my_posts->load('user');

        // 投稿に紐づくコメント数を取得
        $my_posts->each(function ($post) {
            $post->comment_count = $post->comments()->count();
        });

        return $my_posts;
    }

    // ログインユーザーがいいねしている投稿データを取得
    public function getLikedPost($user)
    {
        $count_like = DB::table('likes')
            ->selectRaw('post_id, count(*) as `count`')
            ->groupBy('post_id');

        $new_post = new Post();

        $liked_posts = $new_post->newQuery()
            ->leftJoin('likes', function ($query) use ($user) {
                // いいねされた状態のものを結合
                // 結合前の結合条件を指定
                $query->on('posts.id', '=', 'likes.post_id');
                // 結合後の条件でデータ絞り込み
                // （ログインしているユーザのいいね）
                $query->where('likes.user_id', $user->id);
            })
            ->leftJoinSub($count_like, 'count_like', function ($join) {
                $join->on('posts.id', '=', 'count_like.post_id');
            })
            ->selectRaw('posts.*, IFNULL(count_like.`count`, 0) as `count`, posts.id = IFNULL(likes.post_id, 0) as is_liked')
            ->orderBy('created_at', 'desc')
            // ->paginate(3);
            ->get();

        // リレーション
        $liked_posts->load('user');

        // 投稿に紐づくコメント数を取得
        $liked_posts->each(function ($post) {
            $post->comment_count = $post->comments()->count();
        });

        return $liked_posts;
    }
}
