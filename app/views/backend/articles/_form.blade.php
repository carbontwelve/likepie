<div class="form-group <?php echo ( $errors->has('title') ? 'error' : '' ); ?>">

    {{ Form::label('title', 'Title') }}
    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Article Title'])}}

    <?php echo $errors->first('title'); ?>
</div>

<div class="form-group <?php echo ( $errors->has('body') ? 'error' : '' ); ?>" style="height: 322px;overflow: hidden;">

    {{ Form::label('content', 'Content') }}
    {{ Form::textarea('content', null, ['data-editor' => 'markdown', 'rows' => '15', 'style' => 'width:100%'] ) }}

    <?php echo $errors->first('content'); ?>

</div>

<div class="form-group">
    {{ Form::label('status', 'Status') }}
    {{ Form::select('status', $statuses ) }}
</div>

<div class="form-group">
    {{ Form::label('category', 'Category') }}
    <br/>
    @foreach($categories as $id => $category)
    {{ Form::label('categories['.$id.']', $category) }}
    {{ Form::checkbox('categories['.$id.']', $id); }}
    @endforeach
</div>

<div class="form-group">
    {{ Form::label('tags', 'Tags') }}
    {{ Form::text('tags', null, [ 'id' => 'tags', 'class' => 'form-control', 'placeholder' => 'Article Title']) }}
</div>

<hr/>

<button type="submit" class="btn btn-default pull-right">{{ ( (isset($buttonText)) ? $buttonText : 'Save Article' ) }}</button>
