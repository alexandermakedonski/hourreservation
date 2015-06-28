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
        foreach($services as $service){
            $hours = $service->time;
            $minutes = $hours%60;
            $hours = intval($hours/60);
            $service->time = $hours.':'.$minutes;
        }
		return view('pages.home',compact('services'));
	}


}
