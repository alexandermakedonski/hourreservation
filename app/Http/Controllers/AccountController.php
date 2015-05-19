<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

use Illuminate\Http\Request;

class AccountController extends Controller {

	public function __construct(){
        $this->middleware('routeVerification');
    }

    public function getIndex(){
        $users = User::get();
        return view('accounts.index',compact('users'));
    }

}
