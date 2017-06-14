<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexCOntroller extends Controller
{
    //

    public function __construct()
    {
    	$this->middleware('auth'); 
        
    }
    public function index()
    {
    	return "Selamat datang di halaman Index"; 
        
    }
}
