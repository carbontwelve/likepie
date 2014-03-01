@extends('backend.layouts.default')

@section('content')
<h1 class="page-header">
    Users
    <div class="pull-right">
        <a href="{{ route('admin.users.create') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Create New User</a>
    </div>
</h1>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th style="width:60px;">{{ link_to_sort_column_by('id', 'admin.users.index', '#') }}</th>
            <th>{{ link_to_sort_column_by('email', 'admin.users.index', 'Email') }}</th>
            <th style="width:140px; text-align: center;">{{ link_to_sort_column_by('first_name', 'admin.users.index', 'Full Name') }}</th>
            <th style="width:100px; text-align: center;">Group</th>
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
            <td>&ndash;</td>
            <td>&ndash;</td>
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
