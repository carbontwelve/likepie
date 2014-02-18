<?php namespace Likepie\Exceptions;

class ValidationException extends \Exception {

    protected $validationMessageBag;

    public function __construct( $validationErrors )
    {
        $this->validationMessageBag = $validationErrors;
    }



}
