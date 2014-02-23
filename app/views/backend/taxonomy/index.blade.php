@extends('backend.layouts.default')

@section('content')
<h1 class="page-header">
    Taxonomy
    <div class="pull-right">
        <a href="{{ route('admin.taxonomy.create') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Create Taxonomy</a>
    </div>
</h1>

<table class="table table-striped">
    <thead>
    <tr>
        <th style="width:60px;">{{ link_to_sort_column_by('id', 'admin.taxonomy.index', '#') }}</th>
        <th>{{ link_to_sort_column_by('name', 'admin.taxonomy.index', 'Name') }}</th>
        <th style="width:150px; text-align: right;">Actions</th>
    </tr>
    </thead>
    <tbody>
    @if ($taxonomy->count() == 0)
    <tr>
        <td colspan="5">No Articles in database yet!</td>
    </tr>
    @else
    @foreach($taxonomy as $taxonomyUnit)
    <tr>
        <td>{{ $taxonomyUnit->id }}</td>
        <td>{{ $taxonomyUnit->name }}</td>
        <td style="text-align: right;">
            <div class="btn-group">
                <a href="{{ route('admin.taxonomy.edit', $taxonomyUnit->id) }}" class="btn btn-info btn-xs">Edit</a>
                <button type="button" class="btn btn-danger btn-xs">Delete</button>
            </div>
        </td>
    </tr>
    @endforeach
    @endif
    </tbody>
</table>

{{ $taxonomy->appends( Request::only(['sortBy', 'direction']) )->links() }}

@stop
