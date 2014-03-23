<?php namespace Likepie\Widgets;

class ServerHealthWidget extends Widget
{

    /**
     * Widget
     * @param $event
     */
    public function widget()
    {
        $this->output->name  = 'ServerHealth';
        $this->output->title = 'Server Health';
        $this->output->html  = 'Hello world!';

        return $this->renderOutput();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('dashboard.widgets', 'Likepie\Widgets\ServerHealthWidget@widget');
    }
}
