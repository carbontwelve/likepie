<?php namespace Likepie\Articles;

use Likepie\Core\FormModel;

class ArticleForm extends FormModel
{

    protected $validationRules = [
        'title'   => 'required|min:10',
        'content' => 'required'
    ];

}
