@extends('backend.layouts.default')

@section('content')
<h1 class="page-header">
    Media
    <div class="pull-right">
        <a href="{{ route('admin.media.create') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-upload"></i> Upload</a>
    </div>
</h1>

@stop
