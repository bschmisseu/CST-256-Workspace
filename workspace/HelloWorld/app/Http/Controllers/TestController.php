<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test1()
    {
        return "Hello World From TestContoller in the method of test1";
    }
    
    public function test2()
    {
        return view('helloworld');
    }
}
