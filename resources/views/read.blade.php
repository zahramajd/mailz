@extends('layouts.mail')


@section('body')

    <div class="panel">

        <div class="panel-body">
            <h2>{{$mail->subject}}</h2>
            <div>From:<br><br>
                <img class="avatar img-circle" src="{{$mail->from->avatar}}"/>
                <span class="label label-default">
                    {{$mail->from->email}}
                </span> </div>
            <hr>
            <blockquote class="mail-text">
                {!! $mail->text !!}
            </blockquote>

        </div>

    </div>


@endsection


@section('toolbar')

    <a type="button" class="btn btn-default" href="{{url('/inbox')}}">
        &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-left"></span>&nbsp;&nbsp;&nbsp;
    </a>

    <a type="button" class="btn btn-default" href="{{url('/delete/'.$mail->id)}}">
        &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;&nbsp;
    </a>

@endsection