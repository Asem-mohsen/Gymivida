<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function privacy()
    {
        return view('privacy');
    }
    public function terms()
    {
        return view('terms');
    }
    public function serviceDetails()
    {
        return view('service-details');
    }
    public function portfolioDetails()
    {
        return view('portfolio-details');
    }
}
