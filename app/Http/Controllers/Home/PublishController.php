<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Article;

// use Illuminate\Http\Request;

class PublishController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$articles = $this->getData();
		return view('home.publish.index', compact('articles'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ArticleRequest $request)
	{
		if (Article::create($request->all())) {
			flash()->success('Thanks For Your Funny Story, Will Reply as soon as possible');
		} else {
			flash()->error('Sorry, Your Story post Failed, Please check Your Info.');
		}
		return redirect('publish');
	}

	private function getData()
	{
		$articles = \Cache::remember('publish_index', 60, function() {
		    $list = Article::latest()->take(8)->select('title', 'body', 'created_at')->get();
		    $data = [];
		    foreach ($list as $value) {
		    	$row['title'] = $value->title;
		    	$row['body'] = $value->body;
		    	$date = (array)$value->created_at;
		    	$row['created_at'] = date('Y-m-d H:i:s',strtotime($date['date']));
		    	$data[] = $row;
		    }
		    return $data;
		});
		return $articles;
	}
}
