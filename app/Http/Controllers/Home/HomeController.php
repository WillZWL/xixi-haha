<?php namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Article;

class HomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $articles = Article::getIndexData();
        return view('home.index', compact('articles'));
    }

    public function ajaxData()
    {
        $n = \Request::input('page', 1);
        if ($n <= 100) {
            $key = 'joke'.$n;
            $value = \Cache::tags('xixihaha')->get($key);
            if ($value) {
                $data['data'] = $value;
                $data['status'] = 'success';
            } else {
                $data['status'] = 'failed';
            }
        } else {
            $data['status'] = 'failed';
        }
        return response()->json($data);
    }
}
