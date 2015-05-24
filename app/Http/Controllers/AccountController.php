<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Input;
use DB;

use Illuminate\Http\Request;

class AccountController extends Controller {

	public function __construct(){
        $this->middleware('routeVerification');
    }

    public function getIndex(){
        $users = User::get();
        $roles = Role::get();

        return view('accounts.index',compact('users','roles'));
    }

    public function postRole(){

        $user_id = \Hashids::decode(Input::get('user_id'));
        $role_id = \Hashids::decode(Input::get('role_id'));
        DB::table('role_user')->where('user_id','=',$user_id[0])->update(['role_id' => $role_id[0]]);

    }

}
