<?php namespace Likepie\Media;

use LaravelBook\Ardent\Ardent;
use Closure;
use Str;

class Media extends Ardent
{

    protected $table       = 'media';

    protected $with        = ['author'];

    protected $fillable    = ['author_id', 'title', 'src'];

    protected $softDelete  = true;

    public $presenter      = 'Likepie\Media\MediaPresenter';

    public static $rules  = [
        'author_id' => 'required|exists:users,id',
        'title'     => 'required',
        'src'     => 'required',
    ];

}
