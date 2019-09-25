<?php

namespace App\Http\Controllers;

use App\PortfolioItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortfolioItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return PortfolioItem::all();
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
            'demo_url' => 'required',
            'repo_url' => 'required'
        ]);

        $portfolioitem = new PortfolioItem();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $name = Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/portfolioitem');
            $imagePath = $destinationPath . "/" . $name;
            $image->move($destinationPath, $name);
            $portfolioitem->image_src = $imagePath;
        }

        $portfolioitem->user_id = $request->user_id;
        $portfolioitem->title = $request->title;
        $portfolioitem->body = $request->body;
        $portfolioitem->demo_url = $request->demo_url;
        $portfolioitem->repo_url = $request->repo_url;
        $portfolioitem->slug = preg_replace("/\s/", "-", strtolower($portfolioitem->title));
        $portfolioitem->save();

        return new PortfolioItemResource($portfolioitem);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PortfolioItem  $portfolioitem
     * @return \Illuminate\Http\Response
     */
    public function show(PortfolioItem $portfolioitem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PortfolioItem  $portfolioitem
     * @return \Illuminate\Http\Response
     */
    public function edit(PortfolioItem $portfolioitem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PortfolioItem  $portfolioitem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PortfolioItem $portfolioitem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PortfolioItem  $portfolioitem
     * @return \Illuminate\Http\Response
     */
    public function destroy(PortfolioItem $portfolioitem)
    {
        $portfolioitem->delete();
        return response()->json(null, 204);
    }
}
