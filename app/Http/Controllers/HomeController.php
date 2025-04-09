<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class HomeController extends Controller
{

    public function homePage(){
        return view('home');
    }
    public function index()
    {


        $listings = Listing::with(['modelYear.carModel.brand', 'photos'])
            ->where('is_active', true)
            ->latest()
            ->paginate(9); 

        return view('home', compact('listings'));
    }



}
