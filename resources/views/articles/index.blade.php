@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center">
                            <h1>Articles</h1>
                        </div>
                        <a href="{{route('article.create')}}">Créer un article</a>
                        <a style="margin-left:20px;" href="{{route('contact.create')}}">Contact</a>
                        @if(Auth::user()->isadmin == 1)
                        <a style="margin-left:20px;" href="{{route('admin.show', [Auth::user()->id])}}">Page admin</a>
                        @endif
                        <a style="float:right;" href="{{route('home.index')}}">Retour au dashboard</a></div>

                    <div class="panel-body">
                        @forelse($articles as $article)
                            <h1>{{ $article->title }}</h1>
                            <h4>{{ $article->content }}</h4>
                            <a href="{{route('article.show', ['id' => $article->id])}}">
                                Voir mon article
                            </a>
                            <a style="float: right;" href="">Like<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></a>
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
                            Rien du tout
                        @endforelse
                    </div>
                    <div class="text-center">
                        {{$articles->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection