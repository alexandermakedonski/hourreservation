<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;

use Illuminate\Http\Request;

class CalendarController extends Controller {

	public function getUsersForService(){
        $category_id = \App\Service::find(Input::get('id'))->category_id;
        $service_users = \App\Category_service::find($category_id)->users;
        return $service_users;
    }

    public function postServiceForUsers(){
        $request = Input::all();
        \DB::table('service_user')->insert(['user_id'=>Input::get('user_id'),'service_id'=>Input::get('service_id'),'description'=>Input::get('description'),'start'=>Input::get('start'),'end'=>Input::get('end')]);
        return $request;
    }

}
