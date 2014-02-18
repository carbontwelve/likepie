@extends('backend.layouts.default')

@section('content')
<h1 class="page-header">
    Groups
    <div class="pull-right">
        <a href="{{ route('admin.groups.create') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Create New Group</a>
    </div>
</h1>

@stop
