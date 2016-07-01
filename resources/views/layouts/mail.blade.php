@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-sm-3 col-md-2">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        Mail <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/inbox">Mail</a></li>
                        <li><a href="/contacts">Contacts</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-9 col-md-10">
                @yield('toolbar')
            </div>

        </div>
        <hr>
        <div class="row">

            @include('includes.sidebar')

            <div class="col-sm-9 col-md-10">

                @if(Session::has('message'))
                   <div class="alert alert-danger alert-dismissable fade in">
                       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                       {{Session::get('message')}}
                   </div>
                @endif

                @yield('body')
            </div>

        </div>
    </div>


    @include('includes.compose')

@endsection