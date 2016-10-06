<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\EOrder;
use TG\Test;

class HomeController extends Controller
{
    //
    public function Index(){
        $test = new Test();
        $order = EOrder::firstOrFail();
        return view('home', ['sumprice'=> 'abc', 'test'=> $test->play()]);
    }
}
