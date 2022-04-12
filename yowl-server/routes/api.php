<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UpvoteController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//JWT Auth

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

// Users

Route::apiResource('users', UserController::class);
Route::get('/users/community/{CommunityId}', [UserController::class, 'getUsersByCommunity']);


// Categories

Route::get('/categories/top5', [CategoryController::class, 'getTopFiveCategories']);
Route::apiResource('categories', CategoryController::class);


// Communities
Route::get('/communities/top5', [CommunityController::class, 'getTopFiveCommunities']);
Route::get('/communities/desc', [CommunityController::class, 'OrderCommunitiesByNumberOfUsers']);
Route::apiResource('communities', CommunityController::class);
Route::get('/communities/category/{Categoryid}', [CommunityController::class, 'getCommunitiesByCategory']);
Route::get('/communities/user/{UserId}', [CommunityController::class, 'getCommunitiesByUser']);


// Community-User Joint

Route::get('/community_user', [CommunityController::class, 'getCommunityUserData']);
Route::post('/community_user', [CommunityController::class, 'createCommunityUser']);
Route::delete('/community/user/{CommunityId}/{UserId}', [CommunityController::class, 'DeleteCommunityUser']);


// Posts

Route::get('/posts/filter', [PostController::class, 'filterPosts']);
Route::apiResource('posts', PostController::class);
Route::get('/posts/user/{Userid}', [PostController::class, 'getPostsByUser']);
Route::get('/posts/community/{CommunityId}', [PostController::class, 'getPostsByCommunity']);
Route::get('/posts/upvotes/{user_id}', [PostController::class, 'getUpvotedPostsByUser']);


// Comments

Route::apiResource('comments', CommentController::class);
Route::get('/comments/user/{UserId}', [CommentController::class, 'getCommentsByUser']);
Route::get('/comments/post/{PostId}', [CommentController::class, 'getCommentsByPost']);

// Upvotes Joint

Route::get('/upvotes', [UpvoteController::class, 'index']);
Route::post('/upvotes', [UpvoteController::class, 'store']);
Route::delete('/upvotes', [UpvoteController::class, 'destroy']);
