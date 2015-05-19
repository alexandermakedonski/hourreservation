<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Route;
use Auth;

class RouteVerification {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
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

	public function handle($request, Closure $next)
    {
        if($this->auth->guest())
        {
            return redirect()->guest('auth/login');
        }else{
            $routes = Route::where('role_id','=',Auth::user()->roles[0]->pivot->role_id)->lists('route');
            $array = explode('\\',$request->route()->getAction()['controller']);
            $method = array_pop($array);

            if(in_array ($method,$routes)){
                return $next($request);
            }else{
                return redirect('/');
            }
        }



	}

}
