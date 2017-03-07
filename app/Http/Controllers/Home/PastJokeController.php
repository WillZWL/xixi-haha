<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class PastJokeController extends Controller
{
    public function index()
    {
        return view('home.past.index');
    }
}
