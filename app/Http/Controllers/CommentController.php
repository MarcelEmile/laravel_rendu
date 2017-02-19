<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
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
        $comments = Comment::paginate(5);
        return view('articles.show', ['comments' => $comments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request,
            [
                'body' => 'required'
            ],
            [
                'body.required' => 'veuillez entrer un commentaire.'
            ]);


        Comment::create([
            'article_id' => $request->article_id,
            'user_id' => Auth::user()->id,
            'content' => $request->body,
        ]);
        /*return dd($request);*/
        return redirect()->route('article.show', [$request->article_id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return redirect()->route('article.index');
        }
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required'
        ],
            [
                'content.required' => 'Content obligatoire'
            ]);
        $comment = Comment::find($id);
        $comment->content = $request->content;
        $comment->save();
        return redirect()->route('article.show', [$comment->article_id])->with('success', 'Commentaire modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->route('article.show', [$comment->article_id])->with('success', 'Commentaire supprimé');
    }
}
