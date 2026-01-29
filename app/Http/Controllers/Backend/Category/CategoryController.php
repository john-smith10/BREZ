<?php


namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;




class CategoryController extends Controller
{
    public function index()
    {
        $allCategory = Category::select('id', 'title')->get();
        return view('backend.category.index', compact('allCategory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        $category = new Category();
        $category->title = $request->title;
        $category->parent_id = $request->state; 
        $category->status = $request->status; 
        $category->meta_title = $request->meta_title; 
        $category->meta_description = $request->meta_des;
        
        
         if ($request->hasFile('meta_image')) {
                $image = $request->file('meta_image');
                $imageName = 'category-' . time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                
                $image->storeAs('category', $imageName, 'public');
                $category->meta_image = $imageName;
            //    dd( $category->meta_image); 
               
            }
        
    
        $category->save();
        
    
        return redirect()->back()->with('success', 'Category created successfully!');
    }



    // SHOW

    //  public function show(){
     
    //    $categories = Category::with('subCategories')->get(); 
    //     dd($categories);
    //     return view('backend.category.show');

    //  }

    public function show()
   {
      $categories = Category::with('subCategories') ->latest()->get();
      return view('backend.category.show', compact('categories'));
   }


//    EDIT

  public function edit($id){
    $edit_category = Category::find($id);
     $allCategory = Category::select('id', 'title')->get();
    
    return view('backend.category.edit', compact('edit_category', 'allCategory'));

  
}


// UPDATE

public function update(Request $request, $id){

    
     $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);



    $update_category = Category::find($id);

        // $update_category = new Category();
        $update_category->title = $request->title;
        $update_category->parent_id = $request->state; 
        $update_category->status = $request->status; 
        $update_category->meta_title = $request->meta_title; 
        $update_category->meta_description = $request->meta_des;
        
        
         if ($request->hasFile('meta_image')) {
                $image = $request->file('meta_image');
                $imageName = 'category-' . time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                
                $image->storeAs('category', $imageName, 'public');
                $update_category->meta_image = $imageName;
            //    dd( $category->meta_image); 
               
            }
        
    
        $update_category->save();
        
    
        return redirect()->route('dashboard.category.show')->with('success', 'Category update successfully!');
}



//DELETE


 public function delete($id){

     Category::find($id)->delete();
     return back();

 }


}


