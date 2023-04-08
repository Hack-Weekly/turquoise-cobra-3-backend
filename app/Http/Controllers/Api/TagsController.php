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
    public function show(string $id)
    {
        return response()->json([
            "tag" => Tag::where("id", $id)->with("posts:id,title")->get()
        ]);
    }
}
