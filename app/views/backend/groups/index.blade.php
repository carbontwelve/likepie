@extends('backend.layouts.default')

@section('content')
<h1 class="page-header">
    Groups
    <div class="pull-right">
        <a href="{{ route('admin.groups.create') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Create New Group</a>
    </div>
</h1>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th style="width:60px;">{{ link_to_sort_column_by('id', 'admin.groups.index', '#') }}</th>
            <th>{{ link_to_sort_column_by('name', 'admin.groups.index', 'Name') }}</th>
            <th style="width:80px; text-align: center;">Users</th>
            <th style="width:150px; text-align: right;">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($groups->count() > 0)
        @foreach($groups as $group)
        <tr>
            <td>{{ $group->id }}</td>
            <td>{{ $group->name }}</td>
            <td>{{ $group->users->count() }}</td>
            <td style="text-align: right">
                <div class="btn-group">
                    <a href="{{ route('admin.groups.edit', $group->id) }}" class="btn btn-info btn-xs">Edit</a>
                    <button type="button" class="btn btn-danger btn-xs">Delete</button>
                </div>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="5">No groups in the database</td>
        </tr>
        @endif
        </tbody>
    </table>
</div>

@stop
