<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TagsController extends Controller
{
    public function index()
    {
        return Inertia::render('Tags/Index', [
            "tags" => Tag::all(),
        ]);
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                "tag" => "required|unique:tags,tag"
            ],
            [
                "tag.required" => "Please Input A Tag",
                "tag.unique" => "This tag already exists"
            ]

        );
        try
        {
            Tag::create([
                "tag" => $request->tag
            ]);
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors([
                $e->getMessage()
            ]);
        }
        return Redirect::route('tags.index');
    }
    public function update(Tag $tag, Request $request)
    {
        try
        {
            $request->validate(
                [
                    "tag" => "required|unique:tags,tag," . $tag->id
                ],
                [
                    "tag.required" => "Please Input A Tag",
                    "tag.unique" => "Tag Already Exists",
                ]

            );
            $tag->update(["tag" => $request->tag]);
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors([
                $e->getMessage()
            ]);
        }
        return Redirect::route('tags.index');
    }
    public function destroy(Tag $tag)
    {
        try
        {
            $tag->deleteOrFail();
        }
        catch (ModelNotFoundException $e)
        {
            return redirect()->back()->withErrors([
                "Tag Not Found"
            ]);
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors([
                $e->getMessage()
            ]);
        }
        return Redirect::route('tags.index');
    }
}
