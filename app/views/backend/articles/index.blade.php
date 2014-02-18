@extends('backend.layouts.default')

@section('content')
<h1 class="page-header">
    Articles
    <div class="pull-right">
        <a href="{{ route('admin.articles.create') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Create New Article</a>
    </div>
</h1>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Published On</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @if ($articles->count() == 0)
        <tr>
            <td colspan="5">No Articles in database yet!</td>
        </tr>
        @else

        @endif
        </tbody>
    </table>
</div>
@stop
