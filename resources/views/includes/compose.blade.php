<div class="modal" id="modalCompose">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" class="form-horizontal" method="post" action="{{url('/compose')}}"
                  enctype="multipart/form-data">


                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">New Message</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="inputTo" placeholder="Recipient" name="to">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="inputSubject" placeholder="Subject"
                                   name="subject">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea class="summernote" id="inputBody" name="text"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="inputAttachment" placeholder="Attachment"
                                   name="attachment">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        Send <i class="fa fa-arrow-circle-right fa-lg"></i>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>