@extends('layouts.mail')


@section('body')

    <div class="panel">

        <div class="panel-body">

            <h2>Profile</h2>

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/profile') }}" enctype="multipart/form-data">
                {{ csrf_field() }}


                <div class="form-group">
                    <label for="email" class="col-md-4 control-label">Email</label>
                    <div class="col-md-6">
                        <input id="email" type="email" readonly class="form-control"  value="{{Auth::user()->email}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-md-4 control-label">Full Name</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" autocomplete="off"
                               value="{{Auth::user()->name}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-md-4 control-label">Password</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="email" autocomplete="off" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="avatar" class="col-md-4 control-label">Avatar</label>
                    <div class="col-md-6">
                        <input id="avatar" type="file" class="form-control" name="avatar" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="background" class="col-md-4 control-label">Background</label>
                    <div class="col-md-6">
                        <input id="background" type="file" class="form-control" name="background" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="glyphicon glyphicon-ok"></i> Save Changes
                        </button>
                    </div>
                </div>

            </form>

        </div>

    </div>


@endsection


@section('toolbar')

    <a type="button" class="btn btn-default" href="{{url('/inbox')}}">
        &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-left"></span>&nbsp;&nbsp;&nbsp;
    </a>


@endsection