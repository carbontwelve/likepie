<!-- Hammy Style thing, move somewhere better asap -->
<style>
    label{font-size: 0.89em;}
</style>
<!-- ./ham -->

<ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#general" data-toggle="tab">General</a></li>
    <li><a href="#permissions" data-toggle="tab">Permissions</a></li>
    @if ($user->exists)
    <li><a href="#meta" data-toggle="tab">Meta</a></li>
    @endif
</ul>

<div class="tab-content">
    <div class="tab-pane active" id="general">

        <div class="form-horizontal" style="padding:15px;">

            <!-- First Name -->
            <div class="form-group <?php echo ( $errors->has('first_name') ? 'error' : '' ); ?>">
                {{ Form::label('first_name', 'First name', ['class' => 'col-sm-1 control-label']) }}
                <div class="col-sm-11">
                    {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Jane'])}}
                    <?php echo $errors->first('first_name'); ?>
                </div>
            </div>
            <!-- ./ last name -->

            <!-- Last Name -->
            <div class="form-group <?php echo ( $errors->has('last_name') ? 'error' : '' ); ?>">
                {{ Form::label('last_name', 'Last name', ['class' => 'col-sm-1 control-label']) }}
                <div class="col-sm-11">
                    {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Doe'])}}
                    <?php echo $errors->first('last_name'); ?>
                </div>
            </div>
            <!-- ./ last name -->

            <!-- Email -->
            <div class="form-group <?php echo ( $errors->has('email') ? 'error' : '' ); ?>">
                {{ Form::label('email', 'Email', ['class' => 'col-sm-1 control-label']) }}
                <div class="col-sm-11">
                    {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'jane.doe@example.com'])}}
                    <?php echo $errors->first('email'); ?>
                </div>
            </div>
            <!-- ./ email -->

            <!-- Password -->
            <div class="form-group <?php echo ( $errors->has('password') ? 'error' : '' ); ?>">
                {{ Form::label('password', 'Password', ['class' => 'col-sm-1 control-label']) }}
                <div class="col-sm-11">
                    {{ Form::password('password', ['class' => 'form-control'])}}
                    <?php echo $errors->first('password'); ?>
                </div>
            </div>
            <!-- ./ password -->

            <!-- Password Confirm -->
            <div class="form-group <?php echo ( $errors->has('password_confirm') ? 'error' : '' ); ?>">
                {{ Form::label('password_confirm', 'Confirm Password', ['class' => 'col-sm-1 control-label']) }}
                <div class="col-sm-11">
                    {{ Form::password('password_confirm', ['class' => 'form-control'])}}
                    <?php echo $errors->first('password_confirm'); ?>
                </div>
            </div>
            <!-- ./ password confirm -->


            <!-- Activation Status -->
            <div class="form-group <?php echo ( $errors->has('activated') ? 'error' : '' ); ?>">
                {{ Form::label('activated', 'User Activated', ['class' => 'col-sm-1 control-label'] ) }}
                <div class="col-sm-11">
                    {{
                        Form::select('activated', array(
                            1 => trans('general.yes'),
                            0 => trans('general.no')
                        ));
                    }}
                <?php echo $errors->first('activated'); ?>
                </div>
            </div>
            <!-- ./ activation status -->

            <!-- Groups -->
            <div class="form-group <?php echo ( $errors->has('group') ? 'error' : '' ); ?>">
                {{ Form::label('group', 'Group', ['class' => 'col-sm-1 control-label'] ) }}
                <div class="col-sm-11">
                    {{ Form::select('group', $groups); }}
                    <?php echo $errors->first('group'); ?>
                </div>
            </div>
            <!-- ./ groups -->

        </div>
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

    @if ($user->exists)
    <div class="tab-pane" id="meta">

        <div class="form-horizontal" style="padding:15px;">

            <div class="form-group ">
                <label for="first_name" class="col-sm-1 control-label">First Created</label>
                <div class="col-sm-11">
                    <p class="form-control-static">{{ $user->created_at }}</p>
                </div>
            </div>

            <div class="form-group ">
                <label for="first_name" class="col-sm-1 control-label">Last Updated</label>
                <div class="col-sm-11">
                    <p class="form-control-static">{{ $user->updated_at }}</p>
                </div>
            </div>

            <div class="form-group ">
                <label for="first_name" class="col-sm-1 control-label">Account Activated</label>
                <div class="col-sm-11">
                    <p class="form-control-static">{{ $user->isActivated }}</p>
                </div>
            </div>

            @if($user->isActivated === 'Yes')
            <div class="form-group ">
                <label for="first_name" class="col-sm-1 control-label">Activated On</label>
                <div class="col-sm-11">
                    <p class="form-control-static">{{ $user->activatedOn }}</p>
                </div>
            </div>
            @endif

            <div class="form-group ">
                <label for="first_name" class="col-sm-1 control-label">Last Login</label>
                <div class="col-sm-11">
                    <p class="form-control-static">{{ $user->loggedInOn }}</p>
                </div>
            </div>

            <div class="form-group ">
                <label for="first_name" class="col-sm-1 control-label">Article Count</label>
                <div class="col-sm-11">
                    <p class="form-control-static">{{ $user->articles->count() }}</p>
                </div>
            </div>

            <div class="form-group ">
                <label for="first_name" class="col-sm-1 control-label">Media Count</label>
                <div class="col-sm-11">
                    <p class="form-control-static">&ndash;</p>
                </div>
            </div>

            <div class="form-group ">
                <label for="first_name" class="col-sm-1 control-label">User Count</label>
                <div class="col-sm-11">
                    <p class="form-control-static">&ndash;</p>
                </div>
            </div>
        </div>

    </div>
    @endif

</div>

<hr/>

<button type="submit" class="btn btn-default pull-right">{{ ( (isset($buttonText)) ? $buttonText : 'Save User' ) }}</button>
