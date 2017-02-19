@extends('layouts.app')

@section('content')
<div class="panel-body">
    <p>Commenter l'aricle :</p>
    <form method="POST" action="{{route('comment.store'), [$article->id]}}">
        {{csrf_field()}}
        <textarea class="form-control" name="body" id="" cols="30" row="10" style="width:50%;"
                  placeholder="Commentaire"></textarea>
        <br>
        <div style="width:50%;">
            <div class="text-center">
                <input class="btn btn-primary" type="submit" value="Envoyer">
            </div>
        </div>
    </form>
</div>
@endsection