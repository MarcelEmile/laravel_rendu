@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>Formulaire pour créer un article</h1>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{route('article.store')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input class="form-control" type="text" name="title" placeholder="Titre"
                                   style="width:100%;">
                            <br>
                            <textarea class="form-control" name="content" id="" cols="30" row="10" style="width:100%;"
                                      placeholder="contenu"></textarea>
                            <br>
                            <input type="file" name="picture" id="files" class="hidden">
                            <label class="btn btn-primary" for="files">Choissisez une image</label>
                            <br>
                            <div class="text-center">
                                <input class="btn btn-primary" type="submit" value="Envoyer">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection