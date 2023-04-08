<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts =  Post::with("user:id,name,avatar_thumb")->orderBy("created_at", "desc")->get();
        return response()->json([
            "posts" => $posts
        ]);
    }
    public function show(string $id)
    {
        return response()->json([
            "post" => Post::where("id", $id)->with("user:id,name,avatar")->with("tags:id,tag")->get()
        ]);
    }
}
