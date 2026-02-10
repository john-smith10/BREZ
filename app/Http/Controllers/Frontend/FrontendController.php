<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use app\models\product\product;
use App\Models\Product\Product;

class FrontendController extends Controller
{

 public function index() { 
        
        //  $products = product::with('images')->get(); 
        //  return view("welcome");

       $products = Product::with('images')->get();
     //    dd($products);

return view('welcome', compact('products'));

     }


     





}
