@extends('backend.layouts.default')

@section('content')
<h1 class="page-header">
    Taxonomy
    <div class="pull-right">
        <a href="{{ route('admin.taxonomy.create') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Create Taxonomy</a>
    </div>
</h1>

@stop
