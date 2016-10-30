<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PastJokeController extends Controller
{
    public function index()
    {
        //

        return view('home.past.index');
    }
}
