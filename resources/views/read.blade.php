@extends('layouts.mail')


@section('body')

    <div class="panel">

        <div class="panel-body">
            <h2>{{$mail->subject}}</h2>
            <div>From:<br><br>
                <img class="avatar img-circle" src="{{$mail->from->avatar}}"/>
                <span class="label label-default">
                    {{$mail->from->email}}
                </span></div>
            <hr>
            <blockquote class="mail-text">
                {!! $mail->text !!}
            </blockquote>
        </div>

        <div class="panel-footer">
            @if($mail->attachments!=null)
                <h4><i class="glyphicon glyphicon-paperclip"></i> Attachments</h4>
                <br>
                @foreach($mail->attachments as $attachment)

                    <a class="btn" href="{{url('upload/attachment/'.$mail->id.'/'.$attachment)}}">
                        {{$attachment}}
                        <img class="preview img-responsive"
                             src="{{url('upload/attachment/'.$mail->id.'/'.$attachment)}}">
                    </a>

                @endforeach

            @endif

        </div>

    </div>


@endsection


@section('toolbar')



    @if($mail->from_id!=Auth::user()->id)
        <a type="button" class="btn btn-default" href="{{url('/delete/'.$mail->id)}}">
            &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;&nbsp;
        </a>
        <a type="button" class="btn btn-default" href="{{url('/inbox')}}">
            &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-left"></span>&nbsp;&nbsp;&nbsp;
        </a>
        @push('scripts')
        <script>app.tab = "inbox"</script>@endpush
    @else
        <a type="button" class="btn btn-default" href="{{url('/inbox/sent')}}">
            &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-left"></span>&nbsp;&nbsp;&nbsp;
            @push('scripts')
            <script>app.tab = "sent"</script> @endpush
        </a>
    @endif

@endsection