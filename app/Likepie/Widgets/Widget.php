<?php namespace Likepie\Widgets;

use stdClass;
use View;

class Widget
{
    /**
     * @var stdClass;
     */
    protected $output;

    public function __construct()
    {
        $this->setupOutput();
    }

    /**
     * Set up the output
     */
    protected function setupOutput()
    {
        $this->output = new stdClass();
        $this->output->name  = '';
        $this->output->title = '';
        $this->output->icon  = 'glyphicon glyphicon-tree-conifer';
        $this->output->html  = '';
    }

    protected function renderOutput()
    {
        return View::make('backend.partials.widget', [ 'data' => $this->output ])
            ->render();
    }
}
