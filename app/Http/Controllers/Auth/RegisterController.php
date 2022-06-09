<?php

namespace App\Http\Controllers\Auth;

use App\Models\Vacancy;
use App\Models\User_stat;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $row = Vacancy::where('server', 'niceyoureyes.ga')->where('avail', '>', 0)->orderBy('price', 'asc')->get();
        $price = -1;

        for($i = 0; $i < count($row); $i++)
        {
            $a = $row[$i]["avail"];
            $p = $row[$i]["price"];

            if( $a > User_stat::where('price', $p)->count() )
            {
                $price = $p;
                break;
            }
        }

        if( $price != -1 )
        {
            /* Function showRegistrationForm() hide in vendor, so apply logic here */
            shell_exec('sudo -u root ./add_secret.sh '.$data['name'].' '.$data['password'].'');
        }

        /* Return new User */
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        /* Save Vacancy */
        $vacancy = new User_stat;
        $vacancy->user_id = $user->id;
        $vacancy->role = 'user';
        $vacancy->status = 'active';
        $vacancy->price = $price;
        $vacancy->save();

        return $user;
    }
}
