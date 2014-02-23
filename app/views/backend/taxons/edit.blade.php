@extends('backend.layouts.default')

@section('content')

<h1 class="page-header">
    Edit Taxon
    <div class="pull-right">
        <a href="{{ route('admin.taxons.index') }}" class="btn btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Back to Taxons</a>
    </div>
</h1>

@include('backend.notifications')

<?php echo Form::model($taxon, array('method' => 'PATCH', 'route' => array('admin.taxons.update', 'id' => $taxon->id))); ?>
    @include('backend.taxons._form', [ 'buttonText' => 'Update Taxon' ])
<?php echo Form::close(); ?>

@stop

{{-- Footer Scripts --}}
@section('scripts')

@stop
