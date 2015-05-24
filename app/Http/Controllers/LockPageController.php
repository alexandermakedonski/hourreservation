<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Request;
use Input;
use Auth;
use Session;
use Validator;

class LockPageController extends Controller {


    public function getIndex()
    {

        if(Auth::check()){

            $data = $this->authUserInfo();
            session()->put('key',$data);
            Auth::logout();

        }else {

            $data = $this->hasSessoin();

        }

        return view('pages.lockpage',compact('data'));
    }

    public function authUserInfo(){
        $data[] = [
            'name' => Auth::user()->name,
            'profile_picture' => '/avatar/'.\Hashids::encode(Auth::user()->id,rand(0,100)),
            'email' => Auth::user()->email,
        ];

        return $data;
    }

    public function hasSessoin(){

        if (Session::has('key'))
        {
            $data = session()->get('key');
            return $data;

        }else{
            return redirect('/');
        }
    }

    public function postIndex(Request $request){

        $data = session()->get('key');
        $email = $data[0]['email'];
        $password = Input::all()['password'];

        $validator = Validator::make(Input::all(), [
            'password' => 'required',
        ]);

        $result = $this->result($email,$password,$validator);

        return $result;
    }

    public function result($email,$password,$validator)
    {
        if (Auth::attempt(array('email' => $email, 'password' => $password)))
        {
            return redirect('/');
        }
        if ($validator->fails())
        {
            return redirect()->back()->with('message', 'Въведете парола');
        }
        return redirect()->back()->with('message', 'Грешен парола.');
    }

}
