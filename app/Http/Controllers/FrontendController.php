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

}
