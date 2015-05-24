<?php

use Illuminate\Support\Facades\Response;
use Illuminate\Filesystem\Filesystem;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PagesController@home');

Route::get('/avatar/{id}',function($id){

    $user_id = \Hashids::decode($id);
    if(!count($user_id)) return abort('404');

    try{
        $email = App\User::findOrFail($user_id[0])->email;
    }catch(\App\Exceptions\Exception $e){
        return abort(404);
    }

    $path = storage_path().'\profiles\\'.$email.'\avatar\avatar.jpg';
    $img = new Filesystem;

    try
    {
        $imgReal = $img->get($path);
        $headers = array('Content-Type' => $img->mimeType($path));
    }
    catch (Illuminate\Contracts\Filesystem\FileNotFoundException $exception)
    {
        $imgReal = $img->get(storage_path().'/profiles/default.jpg');
        $headers = array('Content-Type' => $img->mimeType(storage_path().'/profiles/default.jpg'));
    }

    return Response::make($imgReal,200,$headers);
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
    'accounts' => 'AccountController',
    'lock'     => 'LockPageController',
]);

