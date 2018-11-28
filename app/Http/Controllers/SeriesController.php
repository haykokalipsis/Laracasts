<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSeriesRequest;
use App\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.series.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSeriesRequest $request)
    {
        return $request->uploadSeriesImage()
            ->storeSeries();
    }

//    public function store_before_refactoring(CreateSeriesRequest $request)
//    {
//        $uploadedImage = $request->image;
//        $fileName = str_slug($request->title) . '.' . $uploadedImage->getClientOriginalExtension();
//        $image = $uploadedImage->storePubliclyAs('series', $fileName);
//
//        Series::create([
//            'title' => $request->title,
//            'slug' => str_slug($request->title),
//            'description' => $request->description,
//            'image_url' => 'series/' . $fileName
//        ]);
//
//        return redirect()->back();
//    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Series $series)
    {
//        dd(Series::find($id) );
//        dd($series);
        return view('admin.series.index')->with('series', $series);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
