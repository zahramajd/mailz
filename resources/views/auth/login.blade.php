@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row">

            <div class="col-sm-12">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif‍‍‍
            </div>

            <div class="col-sm-6">
                @include('auth.register_form')
            </div>

            <div class="col-sm-6">
                @include('auth.login_form')
            </div>



        </div>
    </div>

@endsection