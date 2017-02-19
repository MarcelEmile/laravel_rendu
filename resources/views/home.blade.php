@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @if(auth::check())
                            <h2>Bonjour, {{Auth::user()->name}}</h2>
                            <a href="{{route('article.index')}}"> Voir les articles </a>
                        @else
                            <h2>Bonjour invité</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
