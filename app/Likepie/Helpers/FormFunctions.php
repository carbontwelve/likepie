<?php

function link_to_sort_column_by($column, $route, $text)
{
    $direction = (Request::get('direction') == 'asc') ? 'desc' : 'asc';

    if (Request::get('sortBy') == $column)
    {
        switch ($direction)
        {
            case 'asc':
                $text = '<i class="glyphicon glyphicon-sort-by-alphabet-alt"></i> ' . $text;
                break;

            case 'desc':
                $text = '<i class="glyphicon glyphicon-sort-by-alphabet"></i> ' . $text;
                break;
        }
    }else{
        $text = '<i class="glyphicon glyphicon-sort"></i> ' . $text;
    }

    return '<a href="'. route($route, ['sortBy' => $column, 'direction' => $direction])  .'">' . $text . '</a>';

    return link_to_route($route, $text, ['sortBy' => $column, 'direction' => $direction]);
}
