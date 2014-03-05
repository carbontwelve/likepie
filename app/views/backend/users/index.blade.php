@extends('backend.layouts.default')

@section('content')
<h1 class="page-header">
    Users
    <div class="pull-right">
        <a href="{{ route('admin.groups.index') }}" class="btn btn-info"><i class="glyphicon glyphicon-th-large"></i> Groups</a>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Create New User</a>
    </div>
</h1>

@include('backend.notifications')

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th style="width:60px;">{{ link_to_sort_column_by('id', 'admin.users.index', '#') }}</th>
            <th>{{ link_to_sort_column_by('email', 'admin.users.index', 'Email') }}</th>
            <th style="width:140px; text-align: center;">{{ link_to_sort_column_by('first_name', 'admin.users.index', 'Full Name') }}</th>
            <th style="width:100px; text-align: center;">Groups</th>
            <th style="width:150px; text-align: right;">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($users->count() > 0)
            @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->fullName }}</td>
            <td>{{ $user->inGroups }}</td>
            <td style="text-align: right">
                <div class="btn-group">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info btn-xs">Edit</a>
                    <button type="button" class="btn btn-danger btn-xs">Delete</button>
                </div>
            </td>
        </tr>
            @endforeach
        @else
        <tr>
            <td colspan="5">No users in the database</td>
        </tr>
        @endif
        </tbody>
    </table>
</div>

@stop
