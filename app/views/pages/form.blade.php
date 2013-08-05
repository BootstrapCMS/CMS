<form class="form-horizontal" action="{{ $form['url'] }}" method="post">   
    
    {{ Form::token() }}

    @if ($form['method'] != 'POST')
    <input type="hidden" name="_method" value="{{ $form['method'] }}">
    @endif

    <div class="control-group {{ ($errors->has('title')) ? 'error' : '' }}" for="title">
        <label class="control-label" for="title">Page Title</label>
        <div class="controls">
            <input name="title" id="title" value="{{ Request::old('title', $form['defaults']['title']) }}" type="text" class="input-xlarge" placeholder="Page Title">
            {{ ($errors->has('title') ? $errors->first('title') : '') }}
        </div>
    </div>

    <div class="control-group {{ ($errors->has('icon')) ? 'error' : '' }}" for="icon">
        <label class="control-label" for="icon">Page Icon</label>
        <div class="controls">
            <input name="icon" id="icon" value="{{ Request::old('icon', $form['defaults']['icon']) }}" type="text" class="input-xlarge" placeholder="Page Icon">
            {{ ($errors->has('icon') ? ' '.$errors->first('icon') : '(optional)') }}
        </div>
    </div>

    <div class="control-group {{ ($errors->has('body')) ? 'error' : '' }}" for="body">
        <label class="control-label" for="body">Page Body</label>
        <div class="controls">
            <textarea name="body" id="body" type="text" class="input-xlarge" placeholder="Page Body" rows="8">{{ Request::old('body', $form['defaults']['body']) }}</textarea>
            {{ ($errors->has('body') ? $errors->first('body') : '') }}
        </div>
    </div>

    <div class="control-group {{ ($errors->has('show_title')) ? 'error' : '' }}" for="show_title">
        <label class="control-label" for="show_title">Show Title</label>
        <div class="controls">
            <div class="switch" data-on-label="<i class='icon-ok icon-white'></i>" data-off-label="<i class='icon-remove'>">
                <input name="show_title" id="show_title" type="checkbox" {{ (Request::old('show_title', $form['defaults']['show_title']) == true) ? 'checked' : '' }} >
            </div>
            {{ ($errors->has('show_title') ? $errors->first('show_title') : '') }}
        </div>
    </div>

    <div class="control-group {{ ($errors->has('show_nav')) ? 'error' : '' }}" for="show_nav">
        <label class="control-label" for="show_nav">Show On Nav</label>
        <div class="controls">
            <div class="switch" data-on-label="<i class='icon-ok icon-white'></i>" data-off-label="<i class='icon-remove'>">
                <input name="show_nav" id="show_nav" type="checkbox" {{ (Request::old('show_nav', $form['defaults']['show_nav']) == true) ? 'checked' : '' }} >
            </div>
            {{ ($errors->has('show_nav') ? $errors->first('show_nav') : '') }}
        </div>
    </div>

    <div class="form-actions">
        <button class="btn btn-primary" type="submit"><i class="icon-rocket"></i> {{ $form['button'] }}</button>
    </div>
</form>
