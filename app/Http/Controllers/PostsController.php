<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Tag;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Posts/Index", [
            "posts" => Post::orderBy("created_at", "desc")->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("Posts/CreateEdit", [
            "mode" => "create",
            "tags" => Tag::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $post = Post::create([
                "user_id" => auth()->user()->id,
                "title" => $request->title,
                "content" => $request->content,
                "meta_data" => json_encode($request->meta_data),
                "slug" => Str::slug($request->title),
                "is_published" => false
            ]);
            $tagsPosts = [];
            foreach ($request->tags as $tag)
            {
                array_push($tagsPosts, [
                    "tag_id" => $tag,
                    "post_id" => $post->id,
                ]);
            }
            DB::table("tags_posts")->insert($tagsPosts);
            DB::commit();
        }
        catch (Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->withErrors([
                $e->getMessage()
            ]);
        }
        return Redirect::route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Inertia::render("Posts/View", [
            Post::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return Inertia::render("Posts/CreateEdit", [
            "post" => Post::find($id),
            "mode" => "edit",
            "tags" => Tag::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        try
        {
            $post = Post::findOrFail($id);
            DB::beginTransaction();
            $post->update([
                "user_id" => auth()->user()->id,
                "title" => $request->title,
                "content" => $request->content,
                "meta_data" => json_encode($request->meta_data),
                "slug" => Str::slug($request->title),
                "is_published" => $request->is_published
            ]);

            // Remove Existing Tags.

            $existingTags = $post->tags;
            $existingTags = array_map(function ($tag)
            {
                return $tag["id"];
            }, $existingTags->toArray());
            $newTags = array_diff($request->tags, $existingTags);

            // Save New Tags
            $tagsPosts = [];
            foreach ($newTags as $newTag)
            {
                array_push($tagsPosts, [
                    "tag_id" => $newTag,
                    "post_id" => $post->id,
                ]);
            }
            DB::table("tags_posts")->insert($tagsPosts);
            DB::commit();
        }
        catch (Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->withErrors([
                $e->getMessage()
            ]);
        }
        return Redirect::route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try
        {
            $post->deleteOrFail();
        }
        catch (ModelNotFoundException $e)
        {
            return redirect()->back()->withErrors([
                "Post Not Found"
            ]);
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors([
                $e->getMessage()
            ]);
        }
        return Redirect::route('posts.index');
    }

    public function saveImage(Request $request)
    {
        try
        {
            $request->validate(
                [
                    "image" => "required|mimes:jpg,jpeg,png|image|max:2048"
                ],
                [
                    "image.required" => "Please Select An Image To Upload",
                    "image.mimes" => "Only .jpg,.jpeg or .png files allowed",
                    "image.image" => "Only Images Allowed",
                    "image.max" => "Maximum Allowed Image Size : 2048 Kilobyte"
                ]
            );
            $baseUrl = URL::to('/') . "/storage/";
            $path = "blog-images/";
            $savedPath = encodeAndSaveImage($request->image, $path, "webp");
            DB::table("blog_images")->insert([
                "image_url" => $baseUrl . $savedPath
            ]);
        }
        catch (\Exception $e)
        {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
        return response()->json([
            'url' => $baseUrl . $savedPath
        ]);
    }

    public function flipPublishStatus(Post $post)
    {
        try
        {
            $post->is_published = !$post->is_published;
            $post->save();
        }
        catch (\Exception $e)
        {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
        // return Redirect::route('posts.index');
    }
}
