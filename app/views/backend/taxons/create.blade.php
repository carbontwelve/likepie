@extends('backend.layouts.default')

@section('content')

<h1 class="page-header">
    Create Taxon
    <div class="pull-right">
        <a href="{{ route('admin.taxons.index') }}" class="btn btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Back to Taxons</a>
    </div>
</h1>

@include('backend.notifications')

<?php echo Form::model(new \Likepie\Classification\Taxons\Taxon, array('route' => array('admin.taxons.store'))); ?>
    @include('backend.taxons._form')
<?php echo Form::close(); ?>
@stop

{{-- Footer Scripts --}}
@section('scripts')

@stop
