@extends('backend.layout')
@section('backend_content')

@push('backend_css')
   
 <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endpush
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title mb-0 mt-1">product Add +</h3>
                <a class="btn btn-primary" href="#">Show All</a>
            </div>

            <div class="card-body">
             {{-- <form action="{{ route('dashboard.product.image') }}" method="post"> --}}
               <form action="{{ route('dashboard.product.image') }}" method="post" enctype="multipart/form-data">
 
                    @csrf
                <div class="row">
                  <div class="col-lg-6">
                      <label for="image">Image Upload</label>
                    <input name="images[]" multiple type="file" />
                     @error('images')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    
                    <div class="row">
                       @forelse ($findImages->images as $data)
                           <div class="col-lg-3 card">
                            <div class="card-header text-center">
                               <a href="#" class="btn btn-danger btn-sm">Delete</a>

                            </div>

                            <div class="card-body">
                                    <img src="{{ asset('storage/product/' . $data->image) }}"
                                                class="card-img-top img-fluid" style="height: 130px; object-fit: cover;"
                                                alt="Product Image"> 
                            </div>
                         
                           

                           </div>

                       @empty
                               <p class="text-muted text-center">No images found.</p>
                       @endforelse
                      
                    </div>



                  </div>
                  <div class="col-lg-6">
                    <label for="image">Image Upload</label>
                    <select name="product_id" id="" class="form-control p-4">
                        <option value="" selected disabled>---select product---</option>
                        @foreach ($products as $product)
                            {{-- <option value="{{ $product->id }}">{{ $product->title }}</option> --}}
                             <option value="{{ $product->id }}" {{ $product->id == $findImages->id ? 'selected' : ''}}>{{ $product->title }}</option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
               

                <button class="btn btn-primary p-2 w-100  mt-3" type="submit">upload</button>
            </form>  

            </div>


        </div>
    </div>
@endsection

@push('backend_js')

 <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

 <script>
    const inputElement = document.querySelector('input[type="file"]');


    const pond = FilePond.create(inputElement,{
      storeAsFile:true,
      allowMultiple:true
    });
</script>
    
@endpush  













 


 