<div class="form-group <?php echo ( $errors->has('name') ? 'error' : '' ); ?>">

    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Taxonomy Name'])}}

    <?php echo $errors->first('name'); ?>
</div>

<hr/>

<button type="submit" class="btn btn-default pull-right">{{ ( (isset($buttonText)) ? $buttonText : 'Save Taxonomy' ) }}</button>
