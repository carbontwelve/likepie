@extends('backend.layouts.default')

@section('content')

<h1 class="page-header">
    Update Group
    <div class="pull-right">
        <a href="{{ route('admin.groups.index') }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Back to Groups</a>
    </div>
</h1>

@include('backend.notifications')
<?php echo Form::model($group, array('method' => 'PATCH', 'route' => array('admin.groups.update', 'id' => $group->id))); ?>
    @include('backend.groups._form')
<?php echo Form::close(); ?>
@stop
