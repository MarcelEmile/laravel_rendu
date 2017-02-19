@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Modifier vos articles</div>

                    <div class="panel-body">
                        <form method="POST" action="{{route('article.update', [$article->id])}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                            <input class="form-control" style="width:100%;" required type="text"
                                   value="{{$article->title}}" name="title">
                            <textarea class="form-control" style="width:100%;" name="content" cols="30" rows="10">
                                {{$article->content}}
                            </textarea>
                            <div style="display:flex;">
                                <input class="btn btn-primary" type="submit" value="Modifier">
                        </form>
                        <form method="POST" action="{{route('article.destroy', [$article->id])}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <input class="btn btn-danger" type="submit" value="Supprimer">
                        </form>
                    </div>
                    @include('messages.errors')
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection