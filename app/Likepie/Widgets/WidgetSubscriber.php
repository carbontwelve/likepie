<?php namespace Likepie\Widgets;

use Event;

class WidgetSubscriber
{
    public function subscribe()
    {
        Event::subscribe( new ServerHealthWidget() );
    }
}
