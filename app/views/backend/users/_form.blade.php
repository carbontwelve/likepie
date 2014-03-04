<ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#general" data-toggle="tab">General</a></li>
    <li><a href="#permissions" data-toggle="tab">Permissions</a></li>
</ul>

<div class="tab-content">
    <div class="tab-pane active" id="general">
        <br/>
        <!-- First Name -->
        <div class="form-group <?php echo ( $errors->has('first_name') ? 'error' : '' ); ?>">
            {{ Form::label('first_name', 'First name') }}
            {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Jane'])}}
            <?php echo $errors->first('first_name'); ?>
        </div>
        <!-- ./ last name -->

        <!-- Last Name -->
        <div class="form-group <?php echo ( $errors->has('last_name') ? 'error' : '' ); ?>">
            {{ Form::label('last_name', 'Last name') }}
            {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Doe'])}}
            <?php echo $errors->first('last_name'); ?>
        </div>
        <!-- ./ last name -->

        <!-- Email -->
        <div class="form-group <?php echo ( $errors->has('email') ? 'error' : '' ); ?>">
            {{ Form::label('email', 'Email') }}
            {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'jane.doe@example.com'])}}
            <?php echo $errors->first('email'); ?>
        </div>
        <!-- ./ email -->

        <!-- Password -->
        <div class="form-group <?php echo ( $errors->has('password') ? 'error' : '' ); ?>">
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password', ['class' => 'form-control'])}}
            <?php echo $errors->first('password'); ?>
        </div>
        <!-- ./ password -->

        <!-- Password Conform -->
        <div class="form-group <?php echo ( $errors->has('password_confirm') ? 'error' : '' ); ?>">
            {{ Form::label('password_confirm', 'Confirm Password') }}
            {{ Form::password('password_confirm', ['class' => 'form-control'])}}
            <?php echo $errors->first('password_confirm'); ?>
        </div>
        <!-- ./ password conform -->


        <!-- Activation Status -->
        <div class="form-group <?php echo ( $errors->has('activated') ? 'error' : '' ); ?>">
            {{ Form::label('activated', 'User Activated') }}
            {{
                Form::select('activated', array(
                    1 => trans('general.yes'),
                    0 => trans('general.no')
                ));
            }}
            <?php echo $errors->first('activated'); ?>
        </div>
        <!-- ./ activation status -->

        <!-- Groups -->
        <div class="form-group <?php echo ( $errors->has('group') ? 'error' : '' ); ?>">
            {{ Form::label('group', 'Group') }}
            {{ Form::select('group', $groups); }}
            <?php echo $errors->first('group'); ?>
        </div>
        <!-- ./ groups -->
    </div>

    <div class="tab-pane" id="permissions">
        @foreach ($permissions as $area => $permissions)
        <div class="panel panel-default">
            <div class="panel-heading">{{ $area }}</div>
            <div class="panel-body">
                @foreach($permissions as $permission)
                <div class="form-group">
                    <label>{{ $permission['label'] }}</label>
                    <br/>
                    <label class="radio-inline">
                        <input type="radio" value="1" id="{{ $permission['permission'] }}_allow" name="permissions[{{ $permission['permission'] }}]"{{ (array_get($selectedPermissions, $permission['permission']) === '1' ? ' checked="checked"' : '') }}> Allow
                    </label>
                    <label class="radio-inline">
                        <input type="radio" value="-1" id="{{ $permission['permission'] }}_deny" name="permissions[{{ $permission['permission'] }}]"{{ (array_get($selectedPermissions, $permission['permission']) === '-1' ? ' checked="checked"' : '') }}> Deny
                    </label>
                    <label class="radio-inline">
                        <input type="radio" value="0" id="{{ $permission['permission'] }}_inherit" name="permissions[{{ $permission['permission'] }}]"{{ ( ! array_get($selectedPermissions, $permission['permission']) ? ' checked="checked"' : '') }}> Inherit
                    </label>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>

<hr/>

<button type="submit" class="btn btn-default pull-right">{{ ( (isset($buttonText)) ? $buttonText : 'Save User' ) }}</button>
