@extends('backend.layouts.default')

@section('content')

<style>
    .column{padding-bottom: 100px;}

    .portlet-placeholder {
        border: 1px dotted black;
        margin: 0 1em 1em 0;
        height: 50px;
    }

    .panel-heading{
        cursor: move;
    }

</style>

<h1 class="page-header">Dashboard</h1>

<div class="widgets">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="glyphicon glyphicon-signal"></i> Stats
            <ul class="nav nav-tabs pull-right">
                <li class="active"><a href="#general" data-toggle="tab"><i class="glyphicon glyphicon-dashboard"></i> General Stats</a></li>
                <li><a href="#social" data-toggle="tab"><i class="glyphicon glyphicon-fire"></i> Social Media</a></li>
                <li><a href="#seo" data-toggle="tab"><i class="glyphicon glyphicon-globe"></i> SEO</a></li>
            </ul>
        </div>
        <div class="panel-body tab-content">
            <div class="tab-pane active" id="general">
                <div class="row no-space">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        Left Column
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

                        <ul class="not-a-list">
                            <li>
                                <div class="text">
                                    Month Post Target
                                    <span class="pull-right">
                                        6/10
                                    </span>
                                </div>
                                <div class="progress progress-sml">
                                    <div class="progress-bar progress-bar-brown" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                </div>
                            </li>
                            <li>
                                <div class="text">
                                    Month Visitor Target
                                    <span class="pull-right">
                                        250/1000
                                    </span>
                                </div>
                                <div class="progress progress-sml">
                                    <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                                </div>
                            </li>
                            <li>
                                <div class="text">
                                    Month Comment Target
                                    <span class="pull-right">
                                        1/10
                                    </span>
                                </div>
                                <div class="progress progress-sml">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 10%;"></div>
                                </div>
                            </li>
                            <li>
                                <div class="text">
                                    Month Star Target
                                    <span class="pull-right">
                                        64/100
                                    </span>
                                </div>
                                <div class="progress progress-sml">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 64%;"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="social">Social</div>
            <div class="tab-pane" id="seo">SEO</div>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-4 column">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-tree-conifer"></span> Column 1
                    <div class="btn-toolbar pull-right" role="toolbar">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-cog"></span></button>
                            <button type="button" class="btn btn-default btn-xs portlet-toggle"><span class="glyphicon glyphicon-minus"></span></button>
                            <button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove"></span></button>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    Rar!
                </div>
            </div>

        </div>

        <div class="col-sm-4 column">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-tree-conifer"></span> Column 2
                    <div class="btn-toolbar pull-right" role="toolbar">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-cog"></span></button>
                            <button type="button" class="btn btn-default btn-xs portlet-toggle"><span class="glyphicon glyphicon-minus"></span></button>
                            <button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove"></span></button>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    Rar!
                </div>
            </div>

        </div>

        <div class="col-sm-4 column">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-tree-conifer"></span> Column 3
                    <div class="btn-toolbar pull-right" role="toolbar">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-cog"></span></button>
                            <button type="button" class="btn btn-default btn-xs portlet-toggle"><span class="glyphicon glyphicon-minus"></span></button>
                            <button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove"></span></button>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    Rar!
                </div>
            </div>

            @foreach($widgets as $widget)
            {{ $widget }}
            @endforeach

        </div>

    </div>
</div>

@stop

@section('scripts')

<script>
    $(function() {
        $( ".column" ).sortable({
            connectWith: ".column",
            handle: ".panel-heading",
            cancel: ".portlet-toggle",
            placeholder: "portlet-placeholder"
        });

        $( ".portlet-toggle" ).click(function() {
            var icon = $( this );
            icon.find('span').toggleClass( "glyphicon-minus glyphicon-plus" );
            icon.closest( ".panel" ).find( ".panel-body" ).slideToggle();
        });
    });
</script>

@stop
