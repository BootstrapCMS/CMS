{{ Form::open(array('url' => $form['url'], 'method' => $form['method'], 'class' => 'form-horizontal')) }}

    <div class="form-group{{ ($errors->has('first_name')) ? ' has-error' : '' }}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">First Name</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="first_name" id="first_name" value="{{ Request::old('first_name', $form['defaults']['first_name']) }}" type="text" class="form-control" placeholder="First Name">
            {{ ($errors->has('first_name') ? $errors->first('first_name') : '') }}
        </div>
    </div>

    <div class="form-group{{ ($errors->has('last_name')) ? ' has-error' : '' }}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="last_name">Last Name</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="last_name" id="last_name" value="{{ Request::old('last_name', $form['defaults']['last_name']) }}" type="text" class="form-control" placeholder="Last Name">
            {{ ($errors->has('last_name') ? $errors->first('last_name') : '') }}
        </div>
    </div>

    <div class="form-group{{ ($errors->has('email')) ? ' has-error' : '' }}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="email">Email</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="email" id="email" value="{{ Request::old('email', $form['defaults']['email']) }}" type="text" class="form-control" placeholder="Email">
            {{ ($errors->has('email') ? $errors->first('email') : '') }}
        </div>
    </div>

    @foreach ($groups as $group)
        <div class="form-group">
            <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="email">{{ $group->name }}</label>
            <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
                <div class="make-switch" data-on-label="<i class='fa fa-check fa-inverse'></i>" data-off-label="<i class='fa fa-times'>">
                    <input name="group_{{ $group->id }}" id="group_{{ $group->id }}" type="checkbox"{{ (Request::old('group_'.$group->id, $form['defaults']['group_'.$group->id]) == true) ? ' checked' : '' }}>
                </div>
            </div>
        </div>
    @endforeach

    <div class="form-group">
        <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
            <button class="btn btn-primary" type="submit"><i class="fa fa-rocket"></i> {{ $form['button'] }}</button>
        </div>
    </div>
{{ Form::close() }}
