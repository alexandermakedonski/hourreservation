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
            $data[] = [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'profile_picture' => Auth::user()->profile_picture,
            ];
            session()->put('key',$data);
            Auth::logout();
        }else {

            if (Session::has('key'))
            {
                $data = session()->get('key');

            }else{
                return redirect('/');
            }

        }



//        dd($data[0]['name']);
        return view('pages.lockpage',compact('data'));
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
