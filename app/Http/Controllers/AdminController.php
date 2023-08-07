<?php

namespace App\Http\Controllers;

use App\Models\Dare;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dares = Dare::with('quizess')->get();
        return view('dashboard', compact('dares'));
    }
}
