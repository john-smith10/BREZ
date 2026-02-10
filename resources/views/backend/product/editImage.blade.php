{{-- @extends('backend.layout')
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
             
               <form action="{{ route('dashboard.product.image.update') }}" method="post" enctype="multipart/form-data">
 
                    @csrf
                      @method('put')
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
                               <a  onclick="return confirm('Are you sure want to delete this image?')" href="{{  route('dashboard.product.image.delete', $data->id) }}" class="btn btn-danger btn-sm">Delete</a>

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


 


  --}}





  @extends('backend.layout')
@section('backend_content')
    @push('backend_css')
        <!-- Select2 -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <!-- Filepond -->
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <style>
            .form-label {
                color: #1b1b1b;
            }

            /* select2 */
            .select2-container {
                height: 76px;
            }

            .select2-container--default .select2-selection--single {
                background: #F7F9FC;
                border: 1px solid #e0e6f7;
                border-radius: 10px;
                padding: 7px 12px;
                font-size: 14px;
                transition: 0.2s ease-in-out;
                box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.08);
                height: 100%;
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                color: #5c5757;
                line-height: 60px;
                font-size: 18px;
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow b {
                top: 150%;
            }

            .image-card {
                border-radius: 14px;
                overflow: hidden;
                transition: all 0.2s ease;
            }

            .image-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 6px 18px rgba(0, 0, 0, 0.418);
            }

            .icon-btn {
                width: 50px;
                height: 36px;
                border-radius: 20%;
                border: none;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #f1f5f9;
                color: #d40000;
                transition: all 0.2s ease;
                font-size: 14px;
            }

            .delete-btn{
            display: inline-flex;
            line-height: 0;
            align-items: center;
        }
        </style>
    @endpush

    <div class="container-fluid mt-4">

        <!-- Page Title -->
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h3 class="fw-bold">Product Image Edit</h3>
            <a href="{{ route('dashboard.product.image.show') }}"><button class="btn btn-primary">Show All
                    Products</button></a>
        </div>

        <div class="container-fluid py-4">

            <!-- Product Form Card -->
            <div class="card shadow border-0 rounded-4 p-4">
                <form action="{{ route('dashboard.product.image.update', $findImages->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row ">
                        <div class="col-lg-6">
                            <label for="image" class="mb-2">Image Upload</label>
                            <input name="images[]" multiple type="file">
                            @error('images')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror

                            <div class="row g-3">
                                @forelse ($findImages->images as $data)
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card image-card shadow-sm border-0 h-100">

                                            <!-- Image -->
                                            <img src="{{ asset('storage/product/' . $data->image) }}"
                                                class="card-img-top img-fluid" style="height: 130px; object-fit: cover;"
                                                alt="Product Image">

                                           <!-- Delete -->
                                            <div class="card-body p-2">
                                                <div class="d-flex justify-content-center gap-3">
  
                                                    <a onclick="return confirm('Are you sure want to delete this image?')" href="{{ route('dashboard.product.image.delete',$data->id) }}" class="btn btn-outline-danger icon-btn delete-btn" title="Delete">
                                                      <iconify-icon icon="material-symbols:delete-outline" width="24" height="24"></iconify-icon>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted text-center">No images found.</p>
                                @endforelse
                            </div>

                        </div>

                        <div class="col-lg-6">
                            <label class="form-label custom-label">Category selection</label>
                            <select name="product_id" class="js-example-basic-single form-control form-input">
                                <option value="" selected disabled>--Select Image--</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" {{ $product->id == $findImages->id ? 'selected' : ''}}>{{ $product->title }}</option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror

                            <!-- Submit -->
                            <div class="mt-4 text-end">
                                <button type="submit" class="btn btn-success btn-lg w-25 px-4">
                                    <span class="up-btn">
                                        Update</span>
                                </button>
                            </div>

                        </div>
                    </div>






                </form>
            </div>
        </div>


    </div>
@endsection
@push('backend_js')
    <!-- iconify -->
    <script src="https://code.iconify.design/iconify-icon/3.0.0/iconify-icon.min.js"></script>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <!-- Filepond -->
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script>
        // Get a reference to the file input element
        const inputElement = document.querySelector('input[type="file"]');

        // Create a FilePond instance
        const pond = FilePond.create(inputElement, {
            storeAsFile: true,
            allowMultiple: true,
        });
    </script>
@endpush