<ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#general" data-toggle="tab">General</a></li>
    <li><a href="#permissions" data-toggle="tab">Permissions</a></li>
</ul>


<div class="tab-content">
    <div class="tab-pane active" id="general">
        <br/>
        <!-- Group Name -->
        <div class="form-group <?php echo ( $errors->has('name') ? 'error' : '' ); ?>">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Admin'])}}
            <?php echo $errors->first('name'); ?>
        </div>
        <!-- ./ group name -->
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

    <?php var_dump($permissions); ?>
    <?php var_dump($selectedPermissions); ?>

</div>

<button type="submit" class="btn btn-default pull-right">{{ ( (isset($buttonText)) ? $buttonText : 'Save Group' ) }}</button>
