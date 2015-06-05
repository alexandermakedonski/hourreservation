<?php namespace App\Services;

use App\User;
use Attach;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use Validator;

class Registrar implements RegistrarContract
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ], [
            'name.required' => 'Името е задължително.',
            'name.max' => 'Максимална дължина на името 255 символа.',
            'email.required' => 'Имейлът е задължителен.',
            'email.email' => 'Невалиден имейл.',
            'email.max' => 'Максимална дължина на имейла 255 символа.',
            'email.unique' => 'Този имейл адрес се повтаря.',
            'password.required' => 'Паролата е задължителна.',
            'password.confirmed' => 'Потвърдената парола е грешна.',
            'password.min' => 'Минимална дължина на паролата 6 символа.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    public function create(array $data)
    {
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->save();
        if (array_key_exists('categories',$data)) {
            $user->categoryServices()->attach($data['categories']);
        }
        $user->roles()->attach($data['role']);


        return $user;
    }
}