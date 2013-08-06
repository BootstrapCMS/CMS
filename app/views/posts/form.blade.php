{{ Form::open(array('url' => $form['url'], 'method' => $form['method'], 'class' => 'form-horizontal')) }}

    <div class="control-group{{ ($errors->has('title')) ? ' error' : '' }}">
        <label class="control-label" for="title">Post Title</label>
        <div class="controls">
            <input name="title" value="{{ Request::old('title', $form['defaults']['title']) }}" type="text" class="input-xlarge" placeholder="Post Title">
            {{ ($errors->has('title') ? $errors->first('title') : '') }}
        </div>
    </div>

    <div class="control-group{{ ($errors->has('summary')) ? ' error' : '' }}">
        <label class="control-label" for="summary">Post Summary</label>
        <div class="controls">
            <input name="summary" value="{{ Request::old('summary', $form['defaults']['summary']) }}" type="text" class="input-xlarge" placeholder="Post Title">
            {{ ($errors->has('summary') ? $errors->first('summary') : '') }}
        </div>
    </div>

    <div class="control-group{{ ($errors->has('body')) ? ' error' : '' }}">
        <label class="control-label" for="body">Post Body</label>
        <div class="controls">
            <textarea name="body" type="text" class="input-xlarge" placeholder="Post Body" rows="8">{{ Request::old('body', $form['defaults']['body']) }}</textarea>
            {{ ($errors->has('body') ? $errors->first('body') : '') }}
        </div>
    </div>

    <div class="form-actions">
        <button class="btn btn-primary" type="submit"><i class="icon-rocket"></i> {{ $form['button'] }}</button>
    </div>
{{ Form::close() }}
