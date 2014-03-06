<?php
    $breadcrumbs = Menu::handler('main')
        ->breadcrumbs()
        ->setElement('ol')
        ->addClass('breadcrumb');

    echo $breadcrumbs;

