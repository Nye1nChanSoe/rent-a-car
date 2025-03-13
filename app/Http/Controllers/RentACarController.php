<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RentACarController extends Controller
{
    public function index()
    {
        return view('rent-a-car.index');
    }
}
