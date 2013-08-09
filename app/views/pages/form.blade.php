{{ Form::open(array('url' => $form['url'], 'method' => $form['method'], 'class' => 'form-horizontal')) }}

    <div class="control-group{{ ($errors->has('title')) ? ' error' : '' }}">
        <label class="control-label" for="title">Page Title</label>
        <div class="controls">
            <input name="title" id="title" value="{{ Request::old('title', $form['defaults']['title']) }}" type="text" class="input-xlarge" placeholder="Page Title">
            {{ ($errors->has('title') ? $errors->first('title') : '') }}
        </div>
    </div>

    <div class="control-group{{ ($errors->has('icon')) ? ' error' : '' }}">
        <label class="control-label" for="icon">Page Icon</label>
        <div class="controls">
            <input name="icon" id="icon" value="{{ Request::old('icon', $form['defaults']['icon']) }}" type="text" class="input-xlarge" placeholder="Page Icon">
            {{ ($errors->has('icon') ? ' '.$errors->first('icon') : '(optional)') }}
        </div>
    </div>

    <div class="control-group{{ ($errors->has('body')) ? ' error' : '' }}">
        <label class="control-label" for="body">Page Body</label>
        <div class="controls">
            <textarea name="body" id="body" class="input-xlarge" placeholder="Page Body" rows="8">{{ Request::old('body', $form['defaults']['body']) }}</textarea>
            {{ ($errors->has('body') ? $errors->first('body') : '') }}
        </div>
    </div>

    <div class="control-group{{ ($errors->has('show_title')) ? ' error' : '' }}">
        <label class="control-label" for="show_title">Show Title</label>
        <div class="controls">
            <div class="make-switch" data-on-label="<i class='icon-ok icon-white'></i>" data-off-label="<i class='icon-remove'>">
                <input name="show_title" id="show_title" type="checkbox"{{ (Request::old('show_title', $form['defaults']['show_title']) == true) ? ' checked' : '' }}>
            </div>
            {{ ($errors->has('show_title') ? $errors->first('show_title') : '') }}
        </div>
    </div>

    <div class="control-group{{ ($errors->has('show_nav')) ? ' error' : '' }}">
        <label class="control-label" for="show_nav">Show On Nav</label>
        <div class="controls">
            <div class="make-switch" data-on-label="<i class='icon-ok icon-white'></i>" data-off-label="<i class='icon-remove'>">
                <input name="show_nav" id="show_nav" type="checkbox"{{ (Request::old('show_nav', $form['defaults']['show_nav']) == true) ? ' checked' : '' }}>
            </div>
            {{ ($errors->has('show_nav') ? $errors->first('show_nav') : '') }}
        </div>
    </div>

    <div class="form-actions">
        <button class="btn btn-primary" type="submit"><i class="icon-rocket"></i> {{ $form['button'] }}</button>
    </div>
{{ Form::close() }}
