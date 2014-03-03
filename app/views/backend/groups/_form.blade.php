<!-- Group Name -->
<div class="form-group <?php echo ( $errors->has('name') ? 'error' : '' ); ?>">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Admin'])}}
    <?php echo $errors->first('name'); ?>
</div>
<!-- ./ group name -->

<button type="submit" class="btn btn-default pull-right">{{ ( (isset($buttonText)) ? $buttonText : 'Save Group' ) }}</button>
