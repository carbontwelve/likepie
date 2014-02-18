@extends('backend.layouts.default')

@section('content')
<h1 class="page-header">
    Permissions
    <div class="pull-right">
        <a href="{{ route('admin.permissions.create') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Create New Permission</a>
    </div>
</h1>

@stop
