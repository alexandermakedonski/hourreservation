<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Category_service;
use Input;
use DB;
use View;

class AccountController extends Controller {

	public function __construct(){
        $this->middleware('routeVerification');
    }

    public function getIndex(){

        $users = User::paginate(10);
        $roles = Role::orderBy('id', 'DESC')->get();
        $root_categories = Category_service::whereIsRoot()->get();
        $categories = Category_service::get();
        return view('accounts.index',compact('users','roles','root_categories','categories'));
    }

    public function getAccounts(){

        $users = User::paginate(10);
        $roles = Role::orderBy('id', 'DESC')->get();
        $root_categories = Category_service::whereIsRoot()->get();
        $categories = Category_service::get();
        if(Request::ajax()){
            return \Response::json(View::make('accounts.users',compact('users','roles','root_categories','categories'))->render());
        }

        return View::make('accounts.users', compact('users','roles','root_categories','categories'));
    }

    public function postRole(){

        $user_id = \Hashids::decode(Input::get('user_id'));
        $role_id = \Hashids::decode(Input::get('role_id'));
        DB::table('role_user')->where('user_id','=',$user_id[0])->update(['role_id' => $role_id[0]]);

    }

    public function postEmployment(){
        $bool = Input::get('bool');
        if($bool == 'true'){
            $user_id = Input::get('user_id');
            $category_service_id = Input::get('category_service_id');
            $user = User::find($user_id);
            $user->categoryServices()->attach($category_service_id);
            return 'true';
        }else{
            $user_id = Input::get('user_id');
            $category_service_id = Input::get('category_service_id');
            $user = User::find($user_id);
            $user->categoryServices()->detach($category_service_id);
            return 'false';
        }
    }

}
