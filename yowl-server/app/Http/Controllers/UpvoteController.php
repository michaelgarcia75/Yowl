<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UpvoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('upvotes')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $post = Post::find($request->input('post_id'));

        if ($post->upvoteUsers()->attach($request->input('user_id'))) {
            return response()->json(['success' => 'Upvote created : user with id = ' + $request->input('user_id') + ' upvoted post with id = ' + $request->input('post_id')], 200);
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $post = Post::find($request->input('post_id'));
        if ($post->upvoteUsers()->detach($request->input('user_id'))) {
            return response()->json(['success' => 'Upvote deleted'], 200);
        };
    }
}
