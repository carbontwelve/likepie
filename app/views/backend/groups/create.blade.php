@extends('backend.layouts.default')

@section('content')

<h1 class="page-header">
    Create Group
    <div class="pull-right">
        <a href="{{ route('admin.groups.index') }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Back to Groups</a>
    </div>
</h1>

@include('backend.notifications')

<?php echo Form::model(new \Likepie\Accounts\Groups\Group, array('route' => array('admin.groups.store'))); ?>

@include('backend.groups._form')

<?php echo Form::close(); ?>
@stop

{{-- Footer Scripts --}}
@section('scripts')

@stop
