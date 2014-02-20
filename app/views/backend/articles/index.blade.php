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
            <th style="width:20px;">#</th>
            <th>Title</th>
            <th style="width:120px; text-align: center;">Published On</th>
            <th style="width:100px; text-align: center;">Status</th>
            <th style="width:150px; text-align: right;">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if ($articles->count() == 0)
        <tr>
            <td colspan="5">No Articles in database yet!</td>
        </tr>
        @else
            @foreach($articles as $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td>{{ $article->title }}</td>
                <td style="text-align: center;">{{ $article->published_at }}</td>
                <td style="text-align: center;">{{ $article->prettyStatus }}</td>
                <td style="text-align: right;">
                    <div class="btn-group">
                        <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-info btn-xs">Edit</a>
                        <button type="button" class="btn btn-danger btn-xs">Delete</button>
                    </div>
                </td>
            </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
@stop
