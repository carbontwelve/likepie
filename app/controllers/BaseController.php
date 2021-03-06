<?php

class BaseController extends Controller {

    public function __construct()
    {

    }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    /**
     * Helper function to redirect back with input and data
     * @param array $data
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectBack($data = [])
    {
        return Redirect::back()->withInput()->with($data);
    }

    /**
     * Helper function to redirect to a route with given parameters
     * @param $route
     * @param array $parameters
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectToRoute($route, $parameters = [])
    {
        return Redirect::route($route, $parameters);
    }

    /**
     * Helper function to redirect to an intended route or if one does not
     * exist a viable default.
     * @param string $else
     * @param array $parameters
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectToIntended($else = '', $parameters = [])
    {
        if ( ! empty($else) )
        {
            $redirectElse = route($else, $parameters);
        }else{
            $redirectElse = route('home');
        }

        return Redirect::to(Session::get('url.intended', $redirectElse));
    }
}
