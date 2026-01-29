<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.home');
        
    }
     public function about(){
        
         return view('admin.about');
    }

    public function contact(){
        
         return view('admin.contact');
    }
}
