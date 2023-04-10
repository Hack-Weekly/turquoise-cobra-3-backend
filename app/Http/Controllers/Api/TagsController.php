<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagsController extends Controller
{
    public function index()
    {
        return response()->json([
            "tags" => Tag::select("id", "tag")->orderBy("tag", "desc")->get()
        ]);
    }
    public function show(string $slug)
    {
        return response()->json([
            "tag" => Tag::where("slug", $slug)->with("posts:id,title")->get()
        ]);
    }
}
