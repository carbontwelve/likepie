<div class="form-group <?php echo ( $errors->has('name') ? 'error' : '' ); ?>">

    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Taxon'])}}
    <?php echo $errors->first('name'); ?>
</div>

<div class="form-group <?php echo ( $errors->has('taxonomic_unit_id') ? 'error' : '' ); ?>">

    {{ Form::label('taxonomic_unit_id', 'Taxonomy') }}
    {{ Form::select('taxonomic_unit_id', $taxonomy); }}
    <?php echo $errors->first('taxonomic_unit_id'); ?>
</div>



<hr/>

<button type="submit" class="btn btn-default pull-right">{{ ( (isset($buttonText)) ? $buttonText : 'Save Taxon' ) }}</button>
