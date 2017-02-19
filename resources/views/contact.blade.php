@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>Formulaire de contact</h1>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{route('contact.store')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input class="form-control" type="text" name="name" placeholder="Nom"
                                   style="width:100%;">
                            <br>
                            <input class="form-control" type="text" name="email" placeholder="Email"
                                   style="width:100%;">
                            <br>
                            <input class="form-control" type="text" name="subject" placeholder="Sujet"
                                   style="width:100%;">
                            <br>
                            <textarea class="form-control" name="content" id="" cols="30" row="10" style="width:100%;"
                                      placeholder="contenu"></textarea>
                            <br>
                            <div class="text-center">
                                <input class="btn btn-primary" type="submit" value="Envoyer">
                            </div>
                        </form>
                        @include('messages.errors');
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection