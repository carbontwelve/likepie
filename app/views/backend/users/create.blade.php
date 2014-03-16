@extends('backend.layouts.default')

@section('content')

<h1 class="page-header">
    Create User
    <div class="pull-right">
        <a href="{{ route('admin.users.index') }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Back to Users</a>
    </div>
</h1>

@include('backend.notifications')

<?php echo Form::model($user, array('route' => array('admin.users.store'), 'autocomplete' => 'off')); ?>

@include('backend.users._form')

<?php echo Form::close(); ?>
@stop

{{-- Footer Scripts --}}
@section('scripts')

@stop
