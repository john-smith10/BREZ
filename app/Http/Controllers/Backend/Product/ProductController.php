<?php

 










namespace App\Http\Controllers\Backend\Product;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product\Product;
use App\Models\Category\Category;

use App\Models\Image\Image;




// namespace App\Http\Controllers\Backend\Product;

// use App\Models\Image\Image;
// use Illuminate\Support\Str;
// use Illuminate\Http\Request;
// use SweetAlert2\Laravel\Swal;
// use App\Models\Product\Product;
// use App\Models\Category\Category;
// use App\Http\Controllers\Controller;




// use App\Models\Product\ProductImage;


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
        // return redirect()->route('dashboard.product.image.show');

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
    
}
