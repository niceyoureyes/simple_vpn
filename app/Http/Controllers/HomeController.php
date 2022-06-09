<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use App\Models\User_stat;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $row = Vacancy::where('server', 'niceyoureyes.ga')->where('avail', '>', 0)->orderBy('price', 'asc')->get();

        for($i = 0; $i < count($row); $i++)
        {
            $price = $row[$i]["price"];
            $avail = $row[$i]["avail"];
            $busy = User_stat::where('price', $price)->count();

            if( $avail > $busy )
            {
                $avail = $avail - $busy;
                return view('home', compact('avail', 'price'));
            }
        }

        $price = $avail = 0;

        return view('home', compact('avail', 'price'));
    }
}
