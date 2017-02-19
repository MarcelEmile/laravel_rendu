@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">vos articles</div>

                    <div class="panel-body">
                        @foreach($articles as $article)
                            <h2>{{ $article->title }}</h2>
                            <p>{{ $article->content }}</p>
                            <h2>Vous n'avez pas encore d'articles</h2>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
