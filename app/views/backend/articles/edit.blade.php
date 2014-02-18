@extends('backend.layouts.default')

@section('content')

<div style="padding: 30px 0;">

    <pre><?php var_dump($errors); ?></pre>

    <h2>Create Article</h2>

    <?php echo Form::model($article, array('route' => array('admin.articles.store'))); ?>

        <?php echo $errors->first('src'); ?>

        <div class="form-group <?php echo ( $errors->has('title') ? 'error' : '' ); ?>">
            <label for="title">Title</label>
            <input name="title" type="title" class="form-control" id="title" value="<?php echo Input::old('title', $article->title) ?>" placeholder="Article Title"/>
            <?php echo $errors->first('title'); ?>
        </div>

        <div class="form-group <?php echo ( $errors->has('body') ? 'error' : '' ); ?>" style="height: 322px;overflow: hidden;">
            <label for="body">Body</label>
            <div class="toolbar">

            </div>
            <textarea name="body" data-editor="markdown" rows="15"><?php echo Input::old('body', $article->body) ?></textarea>
        </div>

        <hr/>

        <button type="submit" class="btn btn-default pull-right">Update</button>

    <?php echo Form::close(); ?>
</div>
@stop

{{-- Footer Scripts --}}
@section('scripts')

<script src="<?php echo asset('assets/javascripts/vendor/ace/src-noconflict/ace.js'); ?>" type="text/javascript" charset="utf-8"></script>

<script>
    // Hook up ACE editor to all textareas with data-editor attribute
    $(function () {
        $('textarea[data-editor]').each(function () {
            var textarea = $(this);

            var mode = textarea.data('editor');

            var editDiv = $('<div>', {
                position: 'absolute',
                width: textarea.width(),
                height: textarea.height(),
                'class': textarea.attr('class')
            }).insertBefore(textarea);

            textarea.css('visibility', 'hidden');

            var editor = ace.edit(editDiv[0]);
            editor.renderer.setShowGutter(true);
            editor.setTheme("ace/theme/github");
            editor.getSession().setValue(textarea.val());
            editor.getSession().setMode("ace/mode/" + mode);
            // editor.setTheme("ace/theme/idle_fingers");

            // copy back to textarea on form submit...
            textarea.closest('form').submit(function () {
                textarea.val(editor.getSession().getValue());
            })

        });
    });
</script>

@stop
