<div class="col-sm-3 col-md-2">
    <a data-toggle="modal" data-target="#modalCompose" class="btn btn-danger btn-sm btn-block" role="button"><i
                class="glyphicon glyphicon-edit"></i> Compose</a>
    <hr>
    <ul class="nav nav-pills nav-stacked">

        <li v-bind:class="[(tab=='inbox')?'active':'']">
            <a href="/inbox" >Inbox</a>
        </li>

        <li v-bind:class="[(tab=='sent')?'active':'']">
            <a href="/inbox/sent">Sent Mail</a>
        </li>

        <li v-bind:class="[(tab=='trash')?'active':'']">
            <a href="/inbox/trash">Trash</a>
        </li>


    </ul>
</div>
