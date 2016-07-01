@extends('layouts.mail')


@section('body')

    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#home" data-toggle="tab">
                <span class="glyphicon glyphicon-@{{tabIcon}}"></span>@{{tab}}
            </a>
        </li>
    </ul>


    <div class="tab-content">
        <div class="tab-pane fade in active" id="home">
            <div class="list-group mail-items">

                <div v-if="mails!=null">
                    <div v-for="mail in mails">
                        <a href="/read/@{{mail._id}}" v-bind:class="['list-group-item',(mail.read==null)?'unread':'']">
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <span class="name" style="min-width: 120px;
                                display: inline-block;">@{{mail.from.name}}</span>
                            <span class="">@{{mail.subject}}</span>
                            <span class="text-muted mail_item_description">...</span>
                            <span class="badge">@{{mail.created_at}}</span>

                         <span class="pull-right">
                             <span class="glyphicon glyphicon-paperclip"></span>
                         </span>

                        </a>
                    </div>
                </div>
                <div v-else="">
                    Loading...
                </div>

            </div>
        </div>
    </div>

@endsection


@section('toolbar')


    <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            Sort
            <span v-if="sortBy!=null">by @{{sortBy}}</span>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li><a @click="setSort('date')">By Date</a></li>
            <li><a @click="setSort('subject')">By Subject</a></li>
            <li><a @click="setSort('attachment')">By Attachment</a></li>
        </ul>
    </div>


    <button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" @click="getInbox()" >
    &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-refresh"></span>&nbsp;&nbsp;&nbsp;
    </button>


    <div class="pull-right">
        <div class="row">

            <span class="badge">@{{ page }}</span>


            <div class="btn-group btn-group-sm">
                <button type="button" class="btn btn-default" @click="prevPage()">
                <span class="glyphicon glyphicon-chevron-left"></span>
                </button>

                <button type="button" class="btn btn-default" @click="nextPage()">
                <span class="glyphicon glyphicon-chevron-right"></span>
                </button>
            </div>


            <div class="dropdown" style="display: inline;">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="true">
                    &nbsp;&nbsp;&nbsp; @{{perPage}} &nbsp;&nbsp;&nbsp;
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li v-for="c in [3,10,20,30,40,50]">
                        <a @click="setPerPage(c)" >@{{c}}</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

@endsection

@push('scripts')

<script>
    app.getInbox('{{$tab}}');
</script>


@endpush