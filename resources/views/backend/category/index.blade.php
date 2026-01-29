@extends('backend.layout')
@push('backend_css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container{
        box-sizing: border-box;
        display: inline-block;
        margin: 0;
        position: relative;
        vertical-align: middle;
        height: 56px;
    }
   
    .select2-container--default .select2-selection--single {
        height: 100% !important;
        padding: 12px 0; 
        display: flex !important;
        align-items: center;
        color: #fff;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow{
        height: 26px !important;
        position: absolute !important;
        top: 13px !important;
        right: 18px !important;
        width: 20px !important;
    }
</style>
@endpush

@section('backend_content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title mb-0 mt-1">Category Add +</h3>
        <a class="btn btn-primary" href="{{ route('dashboard.category.show') }}">Show All</a>
    </div>
    
    <div class="card-body">
        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        {{-- <form action="{{ route('dashboard.category-store') }}" method="post" enctype="multipart/form-data"> --}}
          <form action="{{ route('dashboard.category.store') }}" method="post" enctype="multipart/form-data">

 
            @csrf

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control p-3" 
                           placeholder="Enter the category title" value="{{ old('title') }}">
                    @error('title')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-lg-6 mb-3">
                    <label for="state">Parent Category</label>
                    <select class="js-example-basic-single form-control" name="state">
                        <option value="">--Select Parent Category--</option>
                        @foreach ($allCategory as $category)
                            <option value="{{ $category->id }}" {{ old('state') == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-4 mb-3">
                    <label>Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control p-3">
                        <option value="">--Select status--</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Active</option>
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-lg-4 mb-3">
                    <label for="meta_des">Meta Description</label>
                    <input type="text" name="meta_des" id="meta_des" class="form-control p-3" 
                           placeholder="meta description" value="{{ old('meta_des') }}">
                </div>

                <div class="col-lg-4 mb-3">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" class="form-control p-3" 
                           placeholder="meta title" value="{{ old('meta_title') }}">
                </div>

                <div class="col-lg-6 mb-3">
                    <label for="meta_image">Meta Image</label>
                    <input type="file" class="form-control p-3" name="meta_image" accept="image/*">
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="d-block">&nbsp;</label>
                    <button type="submit" class="btn btn-primary w-100 p-3">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('backend_js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
@endpush