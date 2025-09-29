@extends('layouts.app')

@section('content')

<div class="card border-0 shadow-sm">
    <div class="card-header bg-success text-white">
        <h4 class="mb-0">
            <i class="fas fa-user-plus"></i> 
            <span class="d-none d-sm-inline">Add New Student</span>
            <span class="d-inline d-sm-none">Add Student</span>
        </h4>
    </div>
    
    <div class="card-body p-3 p-md-4">
        
        @if($errors->any())
        <div class="alert alert-danger">
            <strong><i class="fas fa-exclamation-triangle"></i> Errors:</strong>
            <ul class="mb-0 mt-2 small">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            
            <div class="row g-3">
                
                <div class="col-12 col-md-6">
                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Full name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12 col-md-6">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="email@example.com" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12 col-md-6">
                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Phone number" required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12 col-md-6">
                    <label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth') }}" required>
                    @error('date_of_birth')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12">
                    <label for="course" class="form-label">Course <span class="text-danger">*</span></label>
                    <select name="course" id="course" class="form-select @error('course') is-invalid @enderror" required>
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
                
                <div class="col-12">
                    <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                    <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror" placeholder="Full address" required>{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
            </div>
            
            <div class="d-flex flex-column flex-sm-row gap-2 mt-4">
                <a href="{{ route('students.index') }}" class="btn btn-secondary flex-fill flex-sm-grow-0">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
                <button type="submit" class="btn btn-success flex-fill flex-sm-grow-0 ms-sm-auto">
                    <i class="fas fa-save"></i> Save Student
                </button>
            </div>
            
        </form>
        
    </div>
</div>

@endsection