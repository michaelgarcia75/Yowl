<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Post::create($request->all())) {
            return response()->json(['success' => 'Post created'], 200);
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if ($post->update($request->all())) {
            return response()->json(['success' => 'Post updated'], 200);
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
    }

    public function getPostsByUser($UserId)
    {
        $posts = User::find($UserId)->posts;
        return $posts;
    }

    public function getPostsByCommunity($CommunityId)
    {
        $posts = Community::find($CommunityId)->posts;
        return $posts;
    }

    public function filterPosts(Request $request)
    {
        $text = $request->input('text');
        $category_id = $request->input('category');
        $posts = DB::table('posts');

        if ($text) {
            $posts = $posts->where('title', 'LIKE', "%{$text}%")->orWhere('content', 'LIKE', "%{$text}%");
        }
        if ($category_id) {
            $communityIdsArray = Community::where('category_id', $category_id)->pluck('id')->toArray();
            $posts = $posts->whereIn('community_id', $communityIdsArray);
        }
        return $posts->get();
    }

    public function getUpvotedPostsByUser($user_id)
    {

        $postIdsArray = DB::table('upvotes')->where('user_id', $user_id)->pluck('post_id')->toArray();
        return Post::whereIn('id', $postIdsArray)->get();
    }
}
