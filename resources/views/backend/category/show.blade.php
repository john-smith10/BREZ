@extends('backend.layout')

@section('backend_content')
@push('backend_css')
    <style>
.action-icon{
    display:inline-flex;
    line-height: 0
    align-items: center
}
    </style>
@endpush
    <div class="card p<h1>C-3">
     <div class="card-header d-flex justify-content-between align-items-center">
        <h5 mb-0>Categories</h5>
        <a href="{{ route('dashboard.category-index') }}" class="btn btn-primary">Add new categoey</a>
     </div>
     <div class="card-body table-responsive  ">
        <table class="table table-hover table-bordered table-striped">
            <tr>
                <th>
                    #
                </th>
                <th>Title</th>
                <th>Image</th>
                <th>status</th>
                <th>Meta Title</th>
                <th>Meta Des</th>
                <th>Action</th>
             </tr >
          @forelse ($categories as $key => $category)
            <tr class="text-center">
                <td>{{ ++$key }}</td>
                <td>{{ $category->title }}</td>
               <td>
            @if ($category->meta_image)
                 <img style="width: 60px"
             src="{{ asset('storage/category/' . $category->meta_image) }}"
             alt="{{ $category->title }}">
            @else
                <p class="badge text-bg-danger bg-danger">not Found</p>
            @endif
               </td>
             <td>
                @if ($category->status == 1)
                <span class="badge text-bg-success bg-success">Active</span>
                @else
                    <span class="badge text-bg-danger bg-danger">Inactive</span>
                @endif
             </td>

             <td>
                {{ $category->meta_title ? $category->meta_title: '--' }}
             </td>

              <td>
                {{ $category->meta_description ? $category->meta_description: '--' }}
             </td>

             <td>
                <a href="{{ route('dashboard.category.edit', $category->id) }}" class="btn btn-primary btn-sm action-icon"><iconify-icon icon="mynaui:edit-one" width="24" height="24"></iconify-icon></a>
                <a href="{{ route('dashboard.category.delete', $category->id) }}" class="btn btn-danger btn-sm action-iconp"><iconify-icon icon="icon-park-outline:delete" width="24" height="24"></iconify-icon></a>
             </td>
    
    
            </tr>
              
            @empty
                  <tr>
                    <td colspan="7" class="w-100 text-center">
                        <span class="alert alert-danger d-block">No category found !</span>
                    </td>
                </tr>
            @endforelse
        </table>
     </div>
    </div>
@endsection

@push('backend_js')
    <iconify-icon icon="mynaui:edit-one" width="24" height="24"></iconify-icon>
@endpush
