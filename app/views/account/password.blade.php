{{ Form::open(array('url' => $form['url'], 'method' => $form['method'], 'class' => 'form-horizontal')) }}

    <div class="control-group{{ $errors->has('password') ? ' error' : '' }}">
        <label class="control-label" for="password">Password</label>
        <div class="controls">
            <input name="password" id="password" value="" type="password" class="input-xlarge" placeholder="Password">
            {{ ($errors->has('password') ?  $errors->first('password') : '') }}
        </div>
    </div>

    <div class="control-group{{ $errors->has('password_confirmation') ? ' error' : '' }}">
        <label class="control-label" for="password_confirmation">Confirm Password</label>
        <div class="controls">
            <input name="password_confirmation" id="password_confirmation" value="" type="password" class="input-xlarge" placeholder="Confirm Password">
            {{ ($errors->has('password_confirmation') ? $errors->first('password_confirmation') : '') }}
        </div>
    </div>

    <div class="form-actions">
        <button class="btn btn-primary" type="submit"><i class="icon-rocket"></i> {{ $form['button'] }}</button>
    </div>
{{ Form::close() }}
