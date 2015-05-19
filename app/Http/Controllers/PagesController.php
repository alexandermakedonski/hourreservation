<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Route;

use Illuminate\Http\Request;

class PagesController extends Controller {

    public function __construct(){
        $this->middleware('auth');
    }
	public function home()
	{

		return view('pages.home');
	}

}
