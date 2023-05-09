<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Patient;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

   
    protected $redirectTo = '/usermanager';

    
    public function __construct()
    {
        $this->middleware('guest');
    }

    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'NIN' => ['required', 'string', 'min:14'],
            'phone-number' => ['required', 'String', 'min:10'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],


        ]);
    }

    
    protected function create(array $data)
    {
        $user1= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => 'patient',
        ]);
        $patient=Patient::create([

            'fullname' => $data['name'],
            'gender'=>$data['Gender'],
            'dob'=>$data['dob'],
            'nin'=>$data['NIN'],
            'address1'=>$data['Address1'],
            'address2'=>$data['Address2'],
            'city'=>$data['City'],
            'phone'=>$data['phone-number'],
            'email' => $data['email'],
            'username' => $data['Username'],
            'password' => Hash::make($data['password']),

            ]);

            return $user1;
    }


}
