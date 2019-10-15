<?php

namespace App\Http\Controllers;

use App\Http\Resources\TutorialResource;
use App\Tutorial;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tutorial::all();
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

        $tutorial = new Tutorial();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $name = Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $destinationPath = '\images';
            $imagePath = $destinationPath . "\\" . $name;
            $image->move($destinationPath, $name);
            $tutorial->image_src = $imagePath;
        }
        else {
            $tutorial->image_src = "\images\blog1.jpg";
        }

        $tutorial->user_id = $request->user_id;
        $tutorial->title = $request->title;
        $tutorial->body = $request->body;
        $tutorial->slug = preg_replace("/\s/", "-", strtolower($tutorial->title));
        $tutorial->save();

        return new TutorialResource($tutorial);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tutorial  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tutorial  $post
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
     * @param  \App\Tutorial  $tutorial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tutorial $tutorial)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'image' => 'nullable',
        ]);


        $tutorial->update([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $request->image
        ]);

        return response()->json(null, 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tutorial  $tutorial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tutorial $tutorial)
    {
        $tutorial->delete();
        return response()->json(null, 204);
    }
}
