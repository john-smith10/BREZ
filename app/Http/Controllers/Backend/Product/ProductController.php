<?php

 










namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Category\Category;
use App\Models\Image\Image;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;







class ProductController extends Controller
{
    public function product()
    {
        $categories = Category::get(); 
        return view('backend.product.index', compact('categories'));
    }


    // create
    public function productCreate(Request $request)
    {
        
        $product = new Product();
        $product->title = $request->title;
        $product->category_id = $request->category_id;
        $product->slug = Str::slug($request->title);
        $product->price = $request->price;
        $product->dis_price = $request->dis_price;
        $product->is_stock = $request->stock;
        $product->status = $request->status;
        $product->description = $request->descriptions;
        $product->save();

        
        return redirect()->back()->with('success', 'Product created successfully!');
    }

    //  public function productCreate(Request $request)
    // {

    //     $product = new Product();
    //     $product->title = $request->title;
    //     $product->category_id = $request->state;
    //     $product->slug = 'product' . time() . Str::slug($request->title);
    //     $product->price = $request->price;
    //     $product->dis_price = $request->discount_price;
    //     $product->is_stock = $request->in_stock;
    //     $product->status = $request->status;
    //     $product->description = $request->description;
    //     $product->save();
        
    //     return back();
    // }



    // *SHOW

    public function productShow(){
        $products = product::get();
         return view('backend.product.show', compact('products'));
    }




    // *EDIT

    public function productEdit($id){
        $categories = Category::get(); 
        $editProduct = product::find($id);
        return view('backend.product.edit', compact('editProduct', 'categories') );
        dd( $editProduct);
    }



    // *UPDATE

    public function productUpdate(Request $request, $id){

     $product = product::find($id);
        $product->title = $request->title;
        $product->category_id = $request->category_id;
        $product->slug = Str::slug($request->title);
        $product->price = $request->price;
        $product->dis_price = $request->dis_price;
        $product->is_stock = $request->stock;
        $product->status = $request->status;
        $product->description = $request->descriptions;
        $product->save();

        
        return redirect()->route('dashboard.product.show', $id)
    ->with('success', 'Product updated successfully!');

    }



    // // *DELETE
    


    public function productDelete($id){
    $product = Product::find($id);
    
    if($product) {
        $product->delete();
        return redirect()->route('dashboard.product.show')->with('success', 'Product deleted successfully');
    }
    
    return redirect()->route('dashboard.product.show')->with('error', 'Product not found');
}




    // *PRODUCTIMAGE
    public function productImage(){
       $products = product::select('id', 'title')->get();
    //    dd($products);
    return view('backend.product.image', compact('products'));
   }




//  image store
 public function productImagesStore(Request $request)
    {

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // $uniName = 'product-' . time() . '.' . $image->getClientOriginalName();
                $uniName = 'product-' . time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('product/', $uniName, 'public');
                Image::create([
                    'image' => $uniName,
                    'product_id' => $request->product_id,

                ]);

                
            }
          
        };




        // dd($request->all());
        return redirect()->route('dashboard.product.image.show');

    } 



    // product image show 

  
   public function productImageShow()
    {
        $images = Product::with('images')->get();
        // dd($ima ges);
        return view('backend.product.imageShow', compact('images'));
    }







    // PRODUCT IMAGE EDIT
    public function productImageEdit($id)
    {
        $products = Product::select('id', 'title')->get();
        $findImages = Product::with('images')->find($id);
        // dd($products, $findImages);
        return view('backend.product.editImage', compact('products','findImages' ));
       
    }




    // Product_Image_Delete

    public function productImageDelete($id)
{
    $image = Image::findOrFail($id); 
    $image->delete();
    return back()->with('success', 'Image deleted successfully.');
}

   





   // Product_Image_Update

   public function productImageUpdate(Request $request, $id)
    {

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $uniName = 'product-' . time() . '.' . $image->getClientOriginalName();
                $image->storeAs('product/', $uniName, 'public');
                Image::create([
                    'image' => $uniName,
                    'product_id' => $request->product_id,

                ]);
            }
        };
        
        
        return redirect()->route('dashboard.product.image.show');
    }




    // *ADD TO CART

    public  function addToCart($id){
        // dd(product::find($id));
        $product = product::with('images')->find($id);
        $cart = session('cart', []);

        if(isset($cart[$id])){
            $cart[$id]['qty'] += 1; 

            session()->put('cart', $cart);
             
        }else{
             $cart[$id] = [
            'title' => $product->title,
            'descriptions' => $product->description,
            'price' => $product->price,
            'qty' => 1,
            'image' => $product->images[0]->image,
        ];
        }

        // $cart[$id] = [
        //     'title' => $product->title,
        //     'descriptions' => $product->description,
        //     'price' => $product->price,
        //     'qty' => 1,
        //     'image' => $product->images[0]->image,
        // ];

        

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'new cart added');
    }



    // DELETECART

    public  function cartDelete($id){
         $cart = session('cart', []);
         if(isset($cart[$id])){
            unset($cart[$id]);
            session()->put('cart', $cart);
         }

         return redirect()->back()->with('success', 'Cart Deleted');
    }




    // CHECKOUT FORM
     public function checkoutForm(){
        return view('frontend.checkoutForm');
     }



    //  CHECK OUT ORDER

    // public function order(Request $request){
    //     dd($request->all());
    // }


    public function order(Request $request){
    // dd($request->all());  
    $request->validate([

    'name' => 'required',
    'email' => 'required|email',
    'phone' => 'required',
    'address' => 'required',


    ]);
     $cart = session('cart', []);


     if(empty($cart)){
         return redirect()->back()->with('success', 'Your cart is empty');
     }

     $testamount = 0;
    foreach($cart as $item){
         $testamount += ($item['price'] ?? 0) * ($item['qty'] ?? 0);
    }




     if($request->payment_method == 'online_payment'){
         $post_data = array();
        $post_data['total_amount'] = $testamount ?? 10; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $request->name;
        $post_data['cus_email'] = $request->email;
        $post_data['cus_add1'] = $request->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $request->phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

        return;
     }


     $tx_id = uniqid();


     DB::table('orders')
            ->where('transaction_id', $tx_id )
            ->updateOrInsert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'amount' => $testamount,
                'status' => 'Pending',
                'address' => $request->address,
                'transaction_id' => $tx_id,
                'currency' => "BDT",
            ]);

            session()->forget('cart');
             return redirect()->back()->with('success', 'Your order has been placed successfully'); 



}

}

    

