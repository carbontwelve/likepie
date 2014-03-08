@extends('backend.layouts.default')

@section('content')

<h1 class="page-header">
    Update User
    <div class="pull-right">
        <a href="{{ route('admin.users.index') }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Back to Users</a>
    </div>
</h1>

@include('backend.notifications')

<?php echo Form::model($user, array('method' => 'PATCH', 'route' => array('admin.users.update', 'id' => $user->id))); ?>

@include('backend.users._form')

<?php echo Form::close(); ?>
@stop

{{-- Footer Scripts --}}
@section('scripts')

@stop
