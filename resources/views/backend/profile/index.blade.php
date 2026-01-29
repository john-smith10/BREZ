
@extends('backend.layout')
@section('backend_content')



<div class="card-header">
    <h3 class="card-title">Profile update</h3>
</div>

<div class="card-body px-5">
    <div class="row g-3">
        <!-- Basic Info Section -->
        <div class="col-lg-4 rounded">
            <form action="{{ route('dashboard.profile.store')  }}" method="POST">
                @csrf
                <div class="shadow p-4">
                    <p class="fw-bold">Basic Info</p>
                    <hr>
                    
                    <label for="name">Name:</label>
                    <input 
                        value="{{ old('name', $authenticateUserInfo->name) }}" 
                        type="text" 
                        name="name" 
                        id="name"
                        placeholder="Name" 
                        class="form-control p-3 mb-2 @error('name') is-invalid @enderror">
                    @error('name')
                        <p class="text-danger small mb-3">{{ $message }}</p>
                    @enderror

                    <label for="email" class="mt-2">Email:</label>
                    <input 
                        value="{{ old('email', $authenticateUserInfo->email) }}" 
                        type="email" 
                        name="email" 
                        id="email"
                        placeholder="Email" 
                        class="form-control p-3 mb-2 @error('email') is-invalid @enderror">
                    @error('email')
                        <p class="text-danger small mb-3">{{ $message }}</p>
                    @enderror

                    <button type="submit" class="btn btn-primary p-2 w-100 mt-3">Update Profile</button>
                </div>
            </form> 
        </div>

        <!-- Password Update Section -->
        <div class="col-lg-4 rounded">
            <form action="{{ route('dashboard.password.update') }}" method="POST">
                @csrf
                <div class="shadow p-4">
                    <p class="fw-bold">Password Update</p>
                    <hr>
                    
                    <label for="current_password">Current Password:</label>
                    <input 
                        type="password" 
                        name="current_password" 
                        id="current_password"
                        placeholder="Current Password" 
                        class="form-control p-3 mb-2 @error('current_password') is-invalid @enderror">
                    @error('current_password')
                        <p class="text-danger small mb-3">{{ $message }}</p>
                    @enderror

                    <label for="new_password" class="mt-2">New Password:</label>
                    <input 
                        type="password" 
                        name="new_password" 
                        id="new_password"
                        placeholder="New Password" 
                        class="form-control p-3 mb-2 @error('new_password') is-invalid @enderror">
                    @error('new_password')
                        <p class="text-danger small mb-3">{{ $message }}</p>
                    @enderror
                    
                    <label for="new_password_confirmation" class="mt-2">Confirm Password:</label>
                    <input 
                        type="password" 
                        name="new_password_confirmation" 
                        id="new_password_confirmation"
                        placeholder="Confirm Password" 
                        class="form-control p-3 mb-3">

                    <button type="submit" class="btn btn-primary p-2 w-100 mt-2">Update Password</button>
                </div>
            </form>
        </div>

        <!-- Profile Image Section -->
        <div class="col-lg-4 rounded">
            <form action="{{ route('dashboard.image.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="shadow p-4">
                    <p class="fw-bold">Profile Image Update</p>
                    <hr>
                    
                    <div class="text-center mb-3">
                        <label for="imgInp" style="cursor: pointer;">
                            <img
                                id="blah"
                                src="{{ Auth::user()->image 
                                    ? asset('storage/profile/' . Auth::user()->image) 
                                    : asset('assets/css/download (2).jpg') }}"
                                alt="Profile Image"
                                class="img-thumbnail"
                                style="width:150px; height:150px; object-fit:cover; border-radius:50%;">
                        </label>
                        <input 
                            name="image" 
                            type="file" 
                            id="imgInp" 
                            accept="image/*"
                            class="d-none @error('image') is-invalid @enderror">
                        <p class="text-muted small mt-2">Click image to upload</p>
                        @error('image')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary p-2 w-100">Update Image</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('backend_js')
<script>
    // Image preview functionality
    const imgInp = document.getElementById('imgInp');
    const blah = document.getElementById('blah');
    
    imgInp.addEventListener('change', function(evt) {
        const [file] = imgInp.files;
        if (file) {
            blah.src = URL.createObjectURL(file);
        }
    });

    // Auto-dismiss alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
</script>
@endpush