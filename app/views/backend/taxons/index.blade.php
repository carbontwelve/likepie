@extends('backend.layouts.default')

@section('content')
<h1 class="page-header">
    Taxons
    <div class="pull-right">
        <a href="{{ route('admin.taxons.create') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Create Taxon</a>
    </div>
</h1>

@include('backend.notifications')

<table class="table table-striped">
    <thead>
    <tr>
        <th style="width:60px;">{{ link_to_sort_column_by('id', 'admin.taxons.index', '#') }}</th>
        <th>{{ link_to_sort_column_by('name', 'admin.taxons.index', 'Name') }}</th>
        <th style="width: 120px;">{{ link_to_sort_column_by('taxonomic_unit_id', 'admin.taxons.index', 'Taxonomy') }}</th>
        <th style="width:150px; text-align: right;">Actions</th>
    </tr>
    </thead>
    <tbody>
    @if ($taxons->count() == 0)
    <tr>
        <td colspan="5">No Taxons in database yet!</td>
    </tr>
    @else
    @foreach($taxons as $taxon)
    <tr>
        <td>{{ $taxon->id }}</td>
        <td>{{ $taxon->name }}</td>
        <td>{{ $taxon->taxonomy }}</td>
        <td style="text-align: right;">
            <div class="btn-group">
                <a href="{{ route('admin.taxons.edit', $taxon->id) }}" class="btn btn-info btn-xs">Edit</a>
                <a href="{{ route('admin.taxons.delete', $taxon->id) }}" class="btn btn-danger btn-xs">Delete</a>
            </div>
        </td>
    </tr>
    @endforeach
    @endif
    </tbody>
</table>

{{ $taxons->appends( Request::only(['sortBy', 'direction']) )->links() }}

<?php var_dump( Menu::handler('main')->render() ); ?>

<?php var_dump(Menu::handler('main')
    ->breadcrumbs()
    ->setElement('ol')
    ->addClass('breadcrumb')
    ->render()); ?>

@stop
