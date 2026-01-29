@extends('backend.layout')
@section('backend_content')


    <div class="content-wrapper">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title mb-0 mt-1">product Add +</h3>
                <a class="btn btn-primary" href="#">Show All</a>
            </div>

            <div class="card-body">
               <table class="table table-bordered">
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Action</th>
                   </tr>  

                   @foreach ($images as $key => $image )
                       <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $image->title }}</td>
                        <td>
                            @if ($image->images)
                            @forelse ($image->images as $child)
                               
                                <img width="80px" src="{{ asset('storage/product/' . $child->image) }}"
                                                    alt="">
                            @empty
                                <p>No image found</p>
                            @endforelse
                                
                            @endif
                        </td>
                         <td>
                      <a href="{{ route('dashboard.product.image.edit', $image->id ) }}" class="btn btn-primary btn-sm">Edit</a>
                             <a href="#" class="btn btn-danger btn-sm">Delete</a>
                         </td>
                       </tr>
                   @endforeach

                </table>
            </div>

            
            


        </div>
    </div>
@endsection

