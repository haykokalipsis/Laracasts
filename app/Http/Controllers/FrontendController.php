<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Series;

class FrontendController extends Controller
{

    public function welcome()
    {
        return view('welcome')->with('series', Series::all() );
    }
    
    public function series(Series $series)
    {
        return view('frontend.series')->with('series', $series);
    } 

}
