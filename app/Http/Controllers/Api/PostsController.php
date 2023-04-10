<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts =  Post::with("user:id,name,avatar_thumb")->with("tags:id,tag")->orderBy("created_at", "desc")->get();
        $posts->makeHidden(["id", "content", "user_id"]);
        return response()->json([
            "posts" => $posts
        ]);
    }
    public function show(string $slug)
    {
        return response()->json([
            "post" => Post::where("slug", $slug)->with("user:id,name,avatar")->with("tags:id,tag")->get()
        ]);
    }
}
