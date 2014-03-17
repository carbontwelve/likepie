@extends('backend.layouts.default')

@section('content')
<style>
    .chart div {
        background-color:green;
        border:1px solid green;
        width: 15px;
        float:left;
        position: absolute;
        bottom: 0;
        border-radius: 3px 3px 0px 0px;
    }

    .chart-container{
        position:relative;
        width:60px;
        height: 82px;
        /*background: #ccc;*/
    }

    .chart div.bar-0{
        background-color: #eae874;
        border-color: #eae874;
    }

    .chart div.bar-1{
        background-color: dimgrey;
        border-color: dimgrey;
    }

    .chart div.bar-2{
        background-color: #d9534f;
        border-color: #d9534f;
    }
</style>

<h1 class="page-header">
    Articles
    <div class="pull-right">
        <a href="{{ route('admin.articles.create') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Create New Article</a>
    </div>
</h1>

<div class="toolbar">
    <div id="bar-chart" class="chart-container">
        <div class="chart"></div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th style="width:60px;">{{ link_to_sort_column_by('id', 'admin.articles.index', '#') }}</th>
            <th>{{ link_to_sort_column_by('title', 'admin.articles.index', 'Title') }}</th>
            <th style="width:140px; text-align: center;">{{ link_to_sort_column_by('published_at', 'admin.articles.index', 'Published On') }}</th>
            <th style="width:100px; text-align: center;">{{ link_to_sort_column_by('status', 'admin.articles.index', 'Status') }}</th>
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

    {{ $articles->appends( Request::only(['sortBy', 'direction']) )->links() }}

</div>
@stop

@section('scripts')

<script>
    var data = [40, 80, 60];
    var n  = 0;
    var bn = 0;
    var h  = document.getElementById("bar-chart").style.height
    var x  = d3.scale.linear()
        .domain([0, d3.max(data)])
        .range([0, 80]);

    d3.select(".chart")
        .selectAll("div")
        .data(data)
        .enter().append("div")
        .style("height", function(d) { return x(d) + "px"; })
        .style("left", function(d){ var output = (21 * n) + "px";  n++; return output; })
        .attr("class", function(d){ var output = "bar-" + bn; bn++; return output; });
</script>

@stop
