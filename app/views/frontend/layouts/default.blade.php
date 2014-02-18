<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>likepie.net &ndash; &pi;</title>

    <link rel="stylesheet" href="<?php echo asset('assets/stylesheets/normalize.css'); ?>">
    <link rel="stylesheet/less" type="text/css" href="<?php echo asset('assets/stylesheets/default.less'); ?>" />

    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/1.6.2/less.min.js"></script>
    <!--<script src="<?php echo asset('assets/javascripts/vendor/modernizr.js'); ?>"></script>-->
</head>
<body>
    <header class="panel main-panel">
        <div class="inner">
            <div class="content">
                <a href="<?php echo url('/'); ?>" title="like pie?">
                    <img src="<?php echo asset('assets/images/logo.png'); ?>" alt="like pie?" class="logo" />
                </a>
                <p>
                    Programming blog of Simon Dann.
                </p>
                <hr class="w-20"/>
                <p style="font-size: 4em;margin: 0;">&#9055;</p>
            </div>
        </div>
    </header>

    <div class="panel content-pane">
        @yield('content')

        <footer>
            <div class="inner">
                &copy; <?php echo date('Y'); ?> &ndash; Simon Dann, Some rights reserved.
            </div>
        </footer>
    </div>
</body>
</html>
