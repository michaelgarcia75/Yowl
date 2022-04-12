<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\User;
use App\Models\Category;
use App\Models\CommunityUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Community::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Community::create($request->all())) {
            return response()->json(['success' => 'Community created'], 200);
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function show(Community $community)
    {
        return $community;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Community $community)
    {
        if ($community->update($request->all())) {
            return response()->json(['success' => 'Community updated'], 200);
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function destroy(Community $community)
    {
        $community->delete();
    }


    public function getCommunitiesByCategory($CategoryId)
    {
        $communities = Category::find($CategoryId)->communities;
        return $communities;
    }

    public function getCommunitiesByUser($UserId)
    {
        $communities = User::find($UserId)->communities;
        return $communities;
    }

    public function getCommunityUserData()
    {
        $communityUser = DB::table('community_users')->get();
        return $communityUser;
    }

    public function createCommunityUser(Request $request)
    {
        $communityUser = Community::find($request->input('community_id'));

        if ($communityUser->users()->attach($request->input('user_id'))) {
            // return response()->json(['success' => 'CommunityUser created : user with id = ' + $request->input('user_id') + ' community with id = ' + $request->input('community_id')], 200);
            return response()->json(['success' => 'CommunityUser created'], 200);
        };
        // if (CommunityUser::create($request->all())) {
        //     return response()->json(['success' => 'CommunityUser created'], 200);
        // };
    }

    public function DeleteCommunityUser($CommunityId, $UserId)
    {
        $communityUser = DB::table('community_users')->where('user_id', $UserId)->where('community_id', $CommunityId)->delete();
        return $communityUser;
    }

    // public function OrderCommunitiesByNumberOfUsers ()
    // {
    //     $users = DB::table('community_users')->count();
    //     $communityUser = DB::table('community_users')->where('user_id', $UserId)->where('community_id', $CommunityId)->delete();
    //     return $communityUser;
    // }

    public function OrderCommunitiesByNumberOfUsers()
    {
        $communities = Community::withCount('users')->orderBy('users_count', 'desc')->get();
        return $communities;
    }

    public function getTopFiveCommunities()
    {

        $communities = Community::withCount('users')->orderBy('users_count', 'desc')->take(5)->get();
        return $communities;
    }
}
