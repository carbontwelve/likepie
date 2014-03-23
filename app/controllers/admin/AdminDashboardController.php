<?php namespace App\Controllers\Admin;

use Event;
use Likepie\Widgets\WidgetSubscriber;
use View;

/**
 * Class AdminDashboardController
 * @package App\Controllers\Admin
 */
class AdminDashboardController extends AdminBaseController {

    /**
     * Setup the Widget subscriber event listeners.
     * @param WidgetSubscriber $widgets
     */
    public function __construct( WidgetSubscriber $widgets )
    {
        $widgets->subscribe();
        parent::__construct();
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $widgets = Event::fire('dashboard.widgets');

        return View::make('backend.dashboard')
            ->with('widgets', $widgets)
            ->with('user', $this->user);

    }

}
