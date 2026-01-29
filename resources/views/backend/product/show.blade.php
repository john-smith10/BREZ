@extends('backend.layout')
@section('backend_content')


    <div class="content-wrapper">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title mb-0 mt-1">All product</h3>
                <a class="btn btn-primary" href="#">Add New One +</a>
            </div>

            <div class="card-body">
              <table class="table table-hover table-bordered table-striped">
                    <tr>
                        <th>#</th>
                        <th>title</th>
                        <th>price</th>
                        <th>Dis_price</th>
                        <th>Description</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    @forelse ($products as $key=>$product)
                        <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $product->title }}</td>
                         <td>{{ $product->price }}</td>
                          <td>{{ $product->dis_price }}</td>
                        <td>{{ $product->description }}</td>
                         <td><span class="badge bg-{{ $product->is_stock == 1 ? 'success' : 'danger' }}">{{ $product->is_stock == 1 ? 'in stock' : 'out of stock' }}</span></td>
                         <td><span class="badge bg-{{ $product->status == 1 ? 'success' : 'danger' }}">{{ $product->status == 1 ? 'Active' : 'Inactive' }}</span></td>

                         <td>
                            <a href="{{ route('dashboard.product.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                             <a href="{{ route('dashboard.product.delete', $product->id) }}" class="btn btn-danger btn-sm">Delete</a>
                         </td>

                    </tr>
                    @empty
                        <tr>
                         <td colspan="8">
                            <div class="alert alert-danger">No product found !</div>
                         </td>
                        </tr>
                    @endforelse
                    </table>
                   {{-- {{ $products->links() }} --}}
                </div>
            </div>

           

            </div>


        </div>
    </div>
@endsection

