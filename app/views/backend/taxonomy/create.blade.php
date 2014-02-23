@extends('backend.layouts.default')

@section('content')

<h1 class="page-header">
    Create Taxonomy
    <div class="pull-right">
        <a href="{{ route('admin.articles.index') }}" class="btn btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Back to Taxonomy</a>
    </div>
</h1>

@include('backend.notifications')

<?php echo Form::model(new \Likepie\Classification\Taxonomy\Taxonomy, array('route' => array('admin.taxonomy.store'))); ?>

@include('backend.taxonomy._form')

<?php echo Form::close(); ?>
@stop

{{-- Footer Scripts --}}
@section('scripts')

@stop
