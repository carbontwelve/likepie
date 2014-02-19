<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Simon Dann">
    <link rel="shortcut icon" href="<?php echo asset('favicon.ico'); ?>">

    <title>Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="<?php echo asset('assets/stylesheets/admin.css'); ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo route('home'); ?>">likepie.net</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Help</a></li>
            </ul>
            <form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Search...">
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li <?php if (Route::is('admin.dashboard')){ echo 'class="active"'; } ?>><a href="<?php echo route('admin.dashboard'); ?>"><i class="glyphicon glyphicon-dashboard"></i> Overview</a></li>
                <li <?php if (Route::is('admin.articles.index')){ echo 'class="active"'; } ?>><a href="<?php echo route('admin.articles.index'); ?>"><i class="glyphicon glyphicon-file"></i> Articles</a></li>
                <li <?php if (Route::is('admin.taxonomy.units.index')){ echo 'class="active"'; } ?>><a href="<?php echo route('admin.taxonomy.units.index'); ?>"><i class="glyphicon glyphicon-tags"></i> Taxonomy Units</a></li>
                <li <?php if (Route::is('admin.taxonomy.index')){ echo 'class="active"'; } ?>><a href="<?php echo route('admin.taxonomy.index'); ?>"><i class="glyphicon glyphicon-tag"></i> Taxonomy</a></li>
                <li <?php if (Route::is('admin.media.index')){ echo 'class="active"'; } ?>><a href="<?php echo route('admin.media.index'); ?>"><i class="glyphicon glyphicon-picture"></i> Media</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li <?php if (Route::is('admin.users.index')){ echo 'class="active"'; } ?>><a href="<?php echo route('admin.users.index'); ?>"><i class="glyphicon glyphicon-user"></i> Users</a></li>
                <li <?php if (Route::is('admin.groups.index')){ echo 'class="active"'; } ?>><a href="<?php echo route('admin.groups.index'); ?>"><i class="glyphicon glyphicon-list-alt"></i> Groups</a></li>
                <li <?php if (Route::is('admin.permissions.index')){ echo 'class="active"'; } ?>><a href="<?php echo route('admin.permissions.index'); ?>"><i class="glyphicon glyphicon-list-alt"></i> Permissions</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li><a href="">Nav item again</a></li>
                <li><a href="">One more nav</a></li>
                <li><a href="">Another nav item</a></li>
            </ul>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        @yield('content')
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="<?php echo asset('assets/javascripts/vendor/holder.js');?>"></script>
@yield('scripts')
</body>
</html>
