{{ Form::open(array('url' => $form['url'], 'method' => $form['method'], 'class' => 'form-horizontal')) }}

    <div class="control-group{{ ($errors->has('title')) ? ' error' : '' }}">
        <label class="control-label" for="title">Event Title</label>
        <div class="controls">
            <input name="title" value="{{ Request::old('title', $form['defaults']['title']) }}" type="text" class="input-xlarge" placeholder="Event Title">
            {{ ($errors->has('title') ? $errors->first('title') : '') }}
        </div>
    </div>

    <div class="control-group{{ ($errors->has('location')) ? ' error' : '' }}">
        <label class="control-label" for="location">Event Location</label>
        <div class="controls">
            <input name="location" value="{{ Request::old('location', $form['defaults']['location']) }}" type="text" class="input-xlarge" placeholder="Event Location">
            {{ ($errors->has('location') ? $errors->first('location') : '') }}
        </div>
    </div>

    <div class="control-group{{ ($errors->has('date')) ? ' error' : '' }}">
        <label class="control-label" for="date">Event Date</label>
        <div class="controls">
            <div id="datetimepicker1" class="input-append date">
                <input name="date" value="{{ Request::old('date', $form['defaults']['date']) }}" type="text" class="input-xlarge" placeholder="Event Date" data-format="yyyy-MM-dd hh:mm:ss"></input>
                <span class="add-on">
                    <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                </span>
                {{ ($errors->has('date') ? $errors->first('date') : '') }}
            </div>
        </div>
    </div>

    <div class="control-group{{ ($errors->has('body')) ? ' error' : '' }}">
        <label class="control-label" for="body">Event Body</label>
        <div class="controls">
            <textarea name="body" type="text" class="input-xlarge" data-provide="markdown" placeholder="Event Body" rows="10">{{ Request::old('body', $form['defaults']['body']) }}</textarea>
            {{ ($errors->has('body') ? $errors->first('body') : '') }}
        </div>
    </div>

    <div class="form-actions">
        <button class="btn btn-primary" type="submit"><i class="icon-rocket"></i> {{ $form['button'] }}</button>
    </div>
{{ Form::close() }}
