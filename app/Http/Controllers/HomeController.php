<?php

namespace App\Http\Controllers;

use App\Models\Dare;
use App\Models\Quizze;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dares = Dare::with('quizess')->get();
        return view('welcome', compact('dares'));
    }
}
