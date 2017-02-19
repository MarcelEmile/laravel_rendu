@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading "><h1> {{$article->title}}</h1>
                    <a style="" href="{{route('article.index')}}">Retour aux articles</a>
                        </div>
                    <div class="panel-body">
                        <p>{{$article->content}}</p>
                        <div class="text-center">
                        <img src="{{ asset('uploads/article_pictures/' . $article->picture) }}" alt="">
                            </div>
                        <p>
                            @if($article->user)
                                Utilisateur : {{$article->user->name}}
                            @else
                                pas d'utilisateur
                            @endif
                        </p>
                        @if($article->user->id == Auth::user()->id)
                            <a href="{{route('article.edit', [$article->id])}}">modifier l'article</a>
                        @else()
                            vous n'avez pas les droits pour modifier cet article
                        @endif
                        <div id="fb-root"></div>
                        <script>(function(d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id)) return;
                                js = d.createElement(s); js.id = id;
                                js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=241110544128";
                                fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>
                        <div class="fb-share-button" data-href="{{ $article->title }} {{ $article->content }}" data-layout="button"></div>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                        @endif
                        <div class="text-center"><h4>Commentaires :</h4></div>
                        <ul>
                            @foreach($comments as $comment)
                                <li><span style="color:#287EAE; font-size:16px;">{{ $comment->user->name }} :</span>
                                    <br>
                                    {{ $comment->content }}</li>

                                @if($comment->user->id == Auth::user()->id)
                                    <a href="{{route('comment.edit', [$comment->id])}}">modifier votre commentaire</a>
                                @else()
                                    vous n'avez pas les droits pour modifier ce commentaire
                                @endif
                            @endforeach
                        </ul>
                        <div class="panel-body">
                            <p>Commenter l'article :</p>
                            <form method="POST" action="{{route('comment.store')}}">
                                {{csrf_field()}}
                                <textarea class="form-control" name="body" id="" cols="30" row="10" style="width:50%;"
                                          placeholder="Commentaire"></textarea>
                                <input type="hidden" name="article_id" value="{{ $article->id }}">
                                <br>
                                <div style="width:50%;">
                                    <div class="text-center">
                                        <input class="btn btn-primary" type="submit" value="Envoyer">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection