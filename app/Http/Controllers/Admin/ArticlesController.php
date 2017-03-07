<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;

class ArticlesController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $articles = Article::latest()->paginate(15);

        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ArticleRequest $request)
    {
        $this->createArticle($request);

        flash()->success('Your article has been created!');

        return redirect('admin/articles/index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($slug)
    {
        $article = Article::findBySlug($slug);

        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);

        return view('admin.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);

        $article->update($request->all());

        return redirect('admin/articles/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        Article::find($id)->delete();

        return redirect('admin/articles/index');
    }

    public function trash()
    {
        $articles = Article::onlyTrashed()->latest('deleted_at')->paginate(15);

        return view('admin.articles.trash', compact('articles'));
    }

    public function restore($id)
    {
        Article::onlyTrashed()->find($id)->restore();

        return redirect('admin/articles/index');
    }

    public function forceDelete($id)
    {
        Article::onlyTrashed()->find($id)->forceDelete();

        return redirect('admin/articles/trash');
    }

    public function createArticle(ArticleRequest $request)
    {
        $article = \Auth::user()->articles()->create($request->all());
    }
}
