@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header bg-success text-white">
        <h4 class="mb-0"><i class="fas fa-user-plus"></i> Add New Student</h4>
    </div>
    
    <div class="card-body">
        
        <!-- Validation Errors -->
        @if($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input:
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <!-- Form -->
        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            
            <div class="row">
                
                <!-- Name -->
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter student name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Email -->
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Enter email address" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Phone -->
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Enter phone number" required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Date of Birth -->
                <div class="col-md-6 mb-3">
                    <label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth') }}" required>
                    @error('date_of_birth')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Course -->
                <div class="col-md-6 mb-3">
                    <label for="course" class="form-label">Course <span class="text-danger">*</span></label>
                    <select name="course" id="course" class="form-control @error('course') is-invalid @enderror" required>
                        <option value="">-- Select Course --</option>
                        <option value="Computer Science" {{ old('course') == 'Computer Science' ? 'selected' : '' }}>Computer Science</option>
                        <option value="Information Technology" {{ old('course') == 'Information Technology' ? 'selected' : '' }}>Information Technology</option>
                        <option value="Electronics" {{ old('course') == 'Electronics' ? 'selected' : '' }}>Electronics</option>
                        <option value="Mechanical" {{ old('course') == 'Mechanical' ? 'selected' : '' }}>Mechanical</option>
                        <option value="Civil" {{ old('course') == 'Civil' ? 'selected' : '' }}>Civil</option>
                    </select>
                    @error('course')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Address -->
                <div class="col-md-12 mb-3">
                    <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                    <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror" placeholder="Enter full address" required>{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
            </div>
            
            <!-- Buttons -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Save Student
                </button>
            </div>
            
        </form>
        
    </div>
</div>

@endsection