@extends('backend.layouts.default')

@section('content')
<h1 class="page-header">
    Users
    <div class="pull-right">
        <a href="{{ route('admin.users.create') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Create New User</a>
    </div>
</h1>

@stop
