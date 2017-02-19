@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center">
                            <h1>Articles de {{Auth::user()->name}}</h1>
                        </div>
                        <a href="{{route('article.create')}}">Créer un article</a>
                        <a style="margin-left:20px;" href="{{route('contact.create')}}">Contact</a>
                        <a style="float: right;" href="{{route('article.index')}}">Retour aux articles</a>
                    </div>

                    <div class="panel-body">
                        @forelse($articles as $article)
                            <h1>{{ $article->title }}</h1>
                            <h4>{{ $article->content }}</h4>
                            <a href="{{route('article.show', ['id' => $article->id])}}">
                                Voir mon article
                            </a>
                            <div id="fb-root"></div>
                            <script>(function(d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id)) return;
                                    js = d.createElement(s); js.id = id;
                                    js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=241110544128";
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));</script>
                            <div class="fb-share-button" data-href="{{ $article->title }} {{ $article->content }}" data-layout="button"></div>
                            <hr></hr>
                        @empty
                            Vous n'avez pas d'articles
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection