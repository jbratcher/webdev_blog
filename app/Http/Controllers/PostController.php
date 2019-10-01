<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'image' => 'nullable',
        ]);

        $post = new Post();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $name = Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $destinationPath = '\images';
            $imagePath = $destinationPath . "\\" . $name;
            $image->move($destinationPath, $name);
            $post->image_src = $imagePath;
        }

        $post->user_id = $request->user_id;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->slug = preg_replace("/\s/", "-", strtolower($post->title));
        $post->save();

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'image' => 'nullable',
        ]);


        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $request->image
        ]);

        return response()->json(null, 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(null, 204);
    }
}
