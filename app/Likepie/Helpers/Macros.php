<?php

Form::macro('delete_form_for', function ($resource){

    $output  = Form::open(['method' => 'DELETE', 'action' => ['Admin\CategoriesController@destroy', $resource->id]]);
    $output .= '<button type="submit">Delete</button>';
    $output .= Form::close();

    return $output;

});
