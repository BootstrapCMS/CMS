<form class="form-horizontal" action="{{ $form['url'] }}" method="post">   
    
    {{ Form::token() }}

    @if ($form['method'] != 'POST')
    <input type="hidden" name="_method" value="{{ $form['method'] }}">
    @endif

    <div class="control-group {{ ($errors->has('title')) ? 'error' : '' }}" for="title">
        <label class="control-label" for="title">Post Title</label>
        <div class="controls">
            <input name="title" value="{{ Request::old('title', $form['defaults']['title']) }}" type="text" class="input-xlarge" placeholder="Post Title">
            {{ ($errors->has('title') ? $errors->first('title') : '') }}
        </div>
    </div>

    <div class="control-group {{ ($errors->has('summary')) ? 'error' : '' }}" for="summary">
        <label class="control-label" for="summary">Post Summary</label>
        <div class="controls">
            <input name="summary" value="{{ Request::old('summary', $form['defaults']['summary']) }}" type="text" class="input-xlarge" placeholder="Post Title">
            {{ ($errors->has('summary') ? $errors->first('summary') : '') }}
        </div>
    </div>

    <div class="control-group {{ ($errors->has('body')) ? 'error' : '' }}" for="body">
        <label class="control-label" for="body">Post Body</label>
        <div class="controls">
            <textarea name="body" type="text" class="input-xlarge" placeholder="Post Body" rows="8">{{ Request::old('body', $form['defaults']['body']) }}</textarea>
            {{ ($errors->has('body') ? $errors->first('body') : '') }}
        </div>
    </div>

    <div class="form-actions">
        <button class="btn btn-primary" type="submit"><i class="icon-rocket"></i> {{ $form['button'] }}</button>
    </div>
</form>
