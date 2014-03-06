@extends('backend.layouts.default')

@section('content')

<h1 class="page-header">
    Create Article
    <div class="pull-right">
        <a href="{{ route('admin.articles.index') }}" class="btn btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Back to Articles</a>
    </div>
</h1>

@include('backend.partials.breadcrumbs')

@include('backend.notifications')

<?php echo Form::model(new \Likepie\Articles\Article, array('route' => array('admin.articles.store'))); ?>

    @include('backend.articles._form')

<?php echo Form::close(); ?>
@stop

{{-- Footer Scripts --}}
@section('scripts')

<script src="<?php echo asset('assets/javascripts/vendor/ace/src-noconflict/ace.js'); ?>" type="text/javascript" charset="utf-8"></script>

<script>
    // Hook up ACE editor to all textareas with data-editor attribute
    $(function () {

        $('#tags').tagsInput();

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
