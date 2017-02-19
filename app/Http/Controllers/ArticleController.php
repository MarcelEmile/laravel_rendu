<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::paginate(5);
        $comments = Comment::paginate(2);
        return view('articles.index', ['articles' => $articles], ['comments' => $comments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request,
            [
                'title' => 'required',
                'content' => 'required',
                'picture' => 'required',
            ],
            [
                'title.required' => 'un titre est requis.',
                'content.required' => 'un déscriptif est requis.',
                'picture.required' => 'Votre article doit contenir une image',

            ]);


        $articlePicture = $request->file('picture');
        $extension = Input::file('picture')->getClientOriginalExtension();
        $filename = rand(1111111, 9999999) . '.' . $extension;
        Image::make($articlePicture)->resize(600, 300)->save(public_path('/uploads/article_pictures/' . $filename));


        $article = new Article;
        $input = $request->input();
        $input['user_id'] = Auth::user()->id;
        $input['picture'] = $filename;

        $article->fill($input)->save();

        return redirect('article')->with('success', 'Votre article a bien été enregistré');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        $comments = Comment::where('article_id', $id)->get();
        if (!$article) {
            return redirect()->route('article.index');
        }
        return view('articles.show', compact('article'), compact('comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        if (!$article) {
            return redirect()->route('article.index');
        }
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ],
            [
                'content.required' => 'Content obligatoire'
            ]);
        $article = Article::find($id);
        $article->title = $request->title;
        $article->content = $request->content;
        $article->save();
        return redirect()->route('article.show', [$article->id])->with('success', 'Article modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect()->route('article.index')->with('success', 'Article supprimé');
    }
}
