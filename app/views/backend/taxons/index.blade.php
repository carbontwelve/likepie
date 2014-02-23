@extends('backend.layouts.default')

@section('content')
<h1 class="page-header">
    Taxons
    <div class="pull-right">
        <a href="{{ route('admin.taxonomy.create') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Create Taxon</a>
    </div>
</h1>

<?php var_dump( Menu::handler('main')->render() ); ?>

<?php var_dump(Menu::handler('main')
    ->breadcrumbs()
    ->setElement('ol')
    ->addClass('breadcrumb')
    ->render()); ?>

@stop
