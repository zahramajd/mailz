@extends('layouts.mail')


@section('body')

    <div class="panel">

        <div class="panel-body">

            <h2>Contacts</h2>

            <div class="row">
                @foreach($contacts as $user)
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail contact-item">
                            <img class="img-rounded img-responsive" src="{{$user->avatar}}">
                            <div class="caption">
                                <h3>{{$user->name}}</h3>
                                <p>{{$user->email}}</p>
                                <p><a href="/contacts/reject/{{$user->id}}" class="btn btn-danger" role="button">Reject</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


            <hr>

            <h2>All Users</h2>

            <div class="row">
                @foreach($all_users as $user)
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail contact-item">
                            <img class="img-rounded img-responsive" src="{{$user->avatar}}">
                            <div class="caption">
                                <h3>{{$user->name}}</h3>
                                <p>{{$user->email}}</p>
                                <p><a href="/contacts/add/{{$user->id}}" class="btn btn-info" role="button">Add To Contacts</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>


        @endsection


        @section('toolbar')

            <button type="button" class="btn btn-default">
                &nbsp;&nbsp;&nbsp;Add <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;&nbsp;
            </button>


@endsection