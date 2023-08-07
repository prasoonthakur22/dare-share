<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticController extends Controller
{
    public function about(Request $request)
    {
        return view('static.about');
    }

    public function privacy(Request $request)
    {
        return view('static.privacy');
    }
}
