{{ Form::open(array('url' => $form['url'], 'method' => $form['method'], 'class' => 'form-horizontal')) }}

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="password">Password</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="password" id="password" value="" type="password" class="form-control" placeholder="Password">
            {{ ($errors->has('password') ?  $errors->first('password') : '') }}
        </div>
    </div>

    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="password_confirmation">Confirm Password</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="password_confirmation" id="password_confirmation" value="" type="password" class="form-control" placeholder="Confirm Password">
            {{ ($errors->has('password_confirmation') ? $errors->first('password_confirmation') : '') }}
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
            <button class="btn btn-primary" type="submit"><i class="fa fa-rocket"></i> {{ $form['button'] }}</button>
        </div>
    </div>
{{ Form::close() }}
