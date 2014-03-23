<div class="panel panel-default">
    <div class="panel-heading">
        <span class="{{ $data->icon }}"></span> {{ $data->title }}
        <div class="btn-toolbar pull-right" role="toolbar">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-cog"></span></button>
                <button type="button" class="btn btn-default btn-xs portlet-toggle"><span class="glyphicon glyphicon-minus"></span></button>
                <button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove"></span></button>
            </div>
        </div>
    </div>
    <div class="panel-body">{{ $data->html }}</div>
</div>
