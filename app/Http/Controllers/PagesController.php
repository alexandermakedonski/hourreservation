<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Route;
use App\User;


use Illuminate\Http\Request;

class PagesController extends Controller {

    public function __construct(){
        $this->middleware('auth');
    }

	public function home()
	{
        $services = \App\Service::all();
        $reservedhours = \App\ReservedHours::all();
        foreach($services as $service){
//            $hours = $service->time;
//            $minutes = $hours%60;
//            $hours = intval($hours/60);
//           $service->time = $hours.':'.$minutes;
            $service->name = '('.$service->category->name.')-'.$service->name;
            //dd($service->name);
        }

        foreach($reservedhours as $reservedhour){

            $reservedhour->name = '('.$reservedhour->services[0]->category->name.')-'.$reservedhour->services[0]->name;

        }
		return view('pages.home',compact('services','reservedhours'));
	}


}
