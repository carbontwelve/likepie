<div class="row">
    <div class="col-sm-10">

        <div class="form-group <?php echo ( $errors->has('title') ? 'error' : '' ); ?>">

            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter title here...', 'style' => 'height: 40px; font-size:1.2em;'])}}

            <?php echo $errors->first('title'); ?>
        </div>

        <div class="form-group <?php echo ( $errors->has('body') ? 'error' : '' ); ?>" style="height: 322px;overflow: hidden;">

            {{ Form::label('content', 'Content') }}
            {{ Form::textarea('content', null, ['data-editor' => 'markdown', 'rows' => '15', 'style' => 'width:100%'] ) }}

            <?php echo $errors->first('content'); ?>

        </div>
    </div>

    <div class="col-sm-2">
        <div class="panel panel-default published-details">
            <div class="panel-heading">
                <h3 class="panel-title">Publish</h3>
            </div>
            <div class="panel-body">

                <button type="submit" class="btn btn-default pull-left">{{ ( (isset($buttonText)) ? $buttonText : 'Save Draft' ) }}</button>

                @if($article->status == 'published')
                <button type="submit" class="btn btn-success disabled pull-right">Publish</button>
                @else
                <button type="submit" class="btn btn-success pull-right" name="publish_this" value="1">Publish</button>
                @endif

                <div style="clear:both; margin-bottom:20px;"></div>

                <div class="form-group">
                    {{ Form::label('status', 'Status') }}
                    {{ Form::select('status', $statuses ) }}
                </div>
            </div>
        </div>

        <div class="panel panel-default published-details">
            <div class="panel-heading">
                <h3 class="panel-title">Category</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    @foreach($categories as $id => $category)
                    <div class="checkbox">
                        <label>
                            {{ Form::checkbox('categories['.$id.']', $id); }}
                            {{ $category }}
                        </label>
                    </div>
                    @endforeach
                </div>

                <a href="#"><span class="glyphicon glyphicon-plus"></span> Add New Category</a>

            </div>
        </div>

        <div class="panel panel-default published-details">
            <div class="panel-heading">
                <h3 class="panel-title">Tags</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    {{ Form::text('tags', null, [ 'id' => 'tags', 'class' => 'form-control', 'placeholder' => 'Article Title']) }}
                </div>
            </div>
        </div>

    </div>
</div>
