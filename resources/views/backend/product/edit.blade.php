@extends('backend.layout')
@section('backend_content')

@push('backend_css')
    <link rel="stylesheet" href="{{ asset(path: 'assets/css/rte_theme_default.css') }}">
@endpush
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title mb-0 mt-1">product Add +</h3>
                <a class="btn btn-primary" href="#">Show All</a>
            </div>

            <div class="card-body">
             <form action="{{ route('dashboard.product.update', $editProduct->id) }}" method="post">
                    @csrf
                    @method('put ')
                
                <div class="row">
                    <div class="col-lg-6">
                       <label for="title">Title:</label>
                        <input name="title" value="{{ $editProduct->title }}" type="text" class="form-control p-3 mb-3" placeholder="product title">
                    </div>

                    <div class="col-lg-6">
                       <label for="category_id">Category Id:</label>
                        <select class="js-example-basic-single form-control" name="category_id">
                        <option value="">--Select Parent Category--</option>
                        @foreach ( $categories as $category )
                        {{-- <option {{ $category->id == $editProduct ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->title }}</option>
                             --}}

                             <option {{ $category->id == $editProduct->category_id ? 'selected' : '' }} 
                              value="{{ $category->id }}">
                          {{ $category->title }}
                             </option>
                        @endforeach
                        
                    </select>
                    </div>
 

                    <div class="col-lg-4">
                       <label for="price">Price:</label>
                        <input value="{{ $editProduct->price }}" name="price" type="number" class="form-control p-3 mb-3" placeholder="product price">
                    </div>

                    <div class="col-lg-4">
                       <label for="dis_price">Discount Price:</label>
                       
                       <input value="{{ $editProduct->dis_price }}" name="dis_price" type="number" class="form-control p-3 mb-3" placeholder="product discount price">
 
                    </div>


                      <div class="col-lg-2">
                       <label for="status">Status:</label>
                    <select name="status" class="form-control p-3" id="status">
                        <option value="">--- select status--</option>
                        <option {{ $editProduct->status == 1 ? 'selected' : '' }} value="1">Active</option>
                        <option {{ $editProduct->status == 0 ? 'selected' : '' }} value="0">inactive</option>
                    </select>
                    </div>

                    
                      <div class="col-lg-2">
                       <label for="stock">Stock:</label>
                    <select name="stock" class="form-control p-3" id="stock">
                        <option value="">--- select stock--</option>
                        <option {{ $editProduct->is_stock == 1 ? 'selected' : '' }} value="1">In stock</option>
                        <option {{ $editProduct->is_stock == 0 ? 'selected' : '' }} value="0">out of stock</option>
                    </select>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <label for="descriptions">Descriptions :</label>
                        <div id="descriptions">
	                   {{ $editProduct->description }}
	                        
                         </div>
                         <textarea hidden name="descriptions" id="allData" ></textarea>
                    </div>



              
                </div>

                <button class="btn btn-primary p-2 w-100 mt-3" type="submit">upload</button>
            </form>  

            </div>


        </div>
    </div>
@endsection

@push('backend_js')

<script src="{{ asset(path: 'assets/js/rte.js') }}"></script>
<script src="{{ asset(path: 'assets/js/all_plugins.js') }}"></script>
    <script>
	var editor1 = new RichTextEditor("#descriptions");

    $('form').on('submit', function(){
     
    $('#allData').val(editor1.getHTMLCode())
    

});

</script>
@endpush