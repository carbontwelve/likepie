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

<?php var_dump($groups); ?>

<hr/>

<button type="submit" class="btn btn-default pull-right">{{ ( (isset($buttonText)) ? $buttonText : 'Save User' ) }}</button>
