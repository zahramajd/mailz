<div class="panel panel-default">
    <div class="panel-heading">Register</div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">

            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Name</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}">
                </div>
            </div>

            <div class="form-group">
                <label for="captcha" class="col-md-4 control-label">Captcha</label>

                <div class="col-md-3">
                    <input id="captcha" type="text" class="form-control" name="captcha" value="">
                </div>

                <div class="col-md-3">
                    {!! captcha_img() !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="glyphicon glyphicon-user"></i> Register
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

