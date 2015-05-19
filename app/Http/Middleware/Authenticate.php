<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Route;
use Auth;

class Authenticate {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;


	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
//        $routes = Route::where('role_id','=',Auth::user()->roles[0]->pivot->role_id)->lists('route');
//        $array = explode('\\',$request->route()->getAction()['controller']);
//        $method = array_pop($array);
//        dd(in_array ($method,$routes));

		if ($this->auth->guest())
		{
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
				return redirect()->guest('auth/login');
			}
		}

		return $next($request);
	}

//    public function handle($request, Closure $next)
//    {
//        if($this->auth->guest())
//        {
//            return redirect()->guest('auth/login');
//        }else{
//            $routes = $this->auth->user()->role->paths;
//            $requestedRoute = $request->route();
//            if(){
//
//            }else
//        }
//    }

}
