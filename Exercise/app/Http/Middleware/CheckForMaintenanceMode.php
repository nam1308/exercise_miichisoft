<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
//use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Http\Response;
class CheckForMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    protected $viewFactory;

    public function __construct(ViewFactory $viewFactory)
    {
        $this->viewFactory = $viewFactory;
    }

    public function handle(Request $request, Closure $next): Response
    {

        if($_ENV['APP_CHECK_MAINTAIN'] === 'true'){
            $view = $this->viewFactory->make('Errors.503');
            return \Response($view->render());
        }

        return $next($request);
    }
}
