@extends('backend.layouts.default')

@section('content')

<h1 class="page-header">
    Edit Taxonomy
    <div class="pull-right">
        <a href="{{ route('admin.taxonomy.index') }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Back to Taxonomy</a>
    </div>
</h1>

@include('backend.notifications')

<?php echo Form::model($taxonomy, array('method' => 'PATCH', 'route' => array('admin.taxonomy.update', 'id' => $taxonomy->id))); ?>

@include('backend.taxonomy._form', [ 'buttonText' => 'Update Taxonomy' ])

<?php echo Form::close(); ?>

@stop

{{-- Footer Scripts --}}
@section('scripts')

@stop
