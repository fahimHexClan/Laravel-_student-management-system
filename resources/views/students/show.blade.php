@extends('layouts.app')

@section('content')

<div class="card border-0 shadow-sm">
    <div class="card-header bg-info text-white">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
            <h4 class="mb-0">
                <i class="fas fa-user"></i> 
                <span class="d-none d-sm-inline">Student Details</span>
                <span class="d-inline d-sm-none">Details</span>
            </h4>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> 
                    <span class="d-none d-sm-inline">Edit</span>
                </a>
                <a href="{{ route('students.index') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left"></i> 
                    <span class="d-none d-sm-inline">Back</span>
                </a>
            </div>
        </div>
    </div>
    
    <div class="card-body p-3 p-md-4">
        
        <div class="row g-4 d-none d-md-flex">
            
            <div class="col-md-6">
                
                <div class="mb-4">
                    <label class="text-muted small text-uppercase mb-1">Full Name</label>
                    <p class="h5 mb-0">{{ $student->name }}</p>
                </div>
                
                <div class="mb-4">
                    <label class="text-muted small text-uppercase mb-1">Email Address</label>
                    <p class="h6 mb-0">
                        <i class="fas fa-envelope text-primary"></i> 
                        <a href="mailto:{{ $student->email }}" class="text-decoration-none">{{ $student->email }}</a>
                    </p>
                </div>
                
                <div class="mb-4">
                    <label class="text-muted small text-uppercase mb-1">Phone Number</label>
                    <p class="h6 mb-0">
                        <i class="fas fa-phone text-success"></i> 
                        <a href="tel:{{ $student->phone }}" class="text-decoration-none">{{ $student->phone }}</a>
                    </p>
                </div>
                
            </div>
            
            <div class="col-md-6">
                
                <div class="mb-4">
                    <label class="text-muted small text-uppercase mb-1">Date of Birth</label>
                    <p class="h6 mb-0">
                        <i class="fas fa-calendar text-danger"></i> 
                        {{ date('d M Y', strtotime($student->date_of_birth)) }}
                        <small class="text-muted">({{ \Carbon\Carbon::parse($student->date_of_birth)->age }} years old)</small>
                    </p>
                </div>
                
                <div class="mb-4">
                    <label class="text-muted small text-uppercase mb-1">Course</label>
                    <p class="mb-0">
                        <span class="badge bg-info fs-6 px-3 py-2">
                            <i class="fas fa-book"></i> {{ $student->course }}
                        </span>
                    </p>
                </div>
                
                <div class="mb-4">
                    <label class="text-muted small text-uppercase mb-1">Address</label>
                    <p class="h6 mb-0">
                        <i class="fas fa-map-marker-alt text-warning"></i> 
                        {{ $student->address }}
                    </p>
                </div>
                
            </div>
            
        </div>
        
        <div class="d-md-none">
            
            <div class="mb-3 pb-3 border-bottom">
                <label class="text-muted small text-uppercase d-block mb-1">Full Name</label>
                <p class="h5 mb-0 fw-bold text-primary">{{ $student->name }}</p>
            </div>
            
            <div class="mb-3 pb-3 border-bottom">
                <label class="text-muted small text-uppercase d-block mb-1">Email Address</label>
                <p class="mb-0">
                    <i class="fas fa-envelope text-primary"></i> 
                    <a href="mailto:{{ $student->email }}" class="text-decoration-none">{{ $student->email }}</a>
                </p>
            </div>
            
            <div class="mb-3 pb-3 border-bottom">
                <label class="text-muted small text-uppercase d-block mb-1">Phone Number</label>
                <p class="mb-0">
                    <i class="fas fa-phone text-success"></i> 
                    <a href="tel:{{ $student->phone }}" class="text-decoration-none">{{ $student->phone }}</a>
                </p>
            </div>
            
            <div class="mb-3 pb-3 border-bottom">
                <label class="text-muted small text-uppercase d-block mb-1">Date of Birth</label>
                <p class="mb-0">
                    <i class="fas fa-calendar text-danger"></i> 
                    {{ date('d M Y', strtotime($student->date_of_birth)) }}
                </p>
                <small class="text-muted">{{ \Carbon\Carbon::parse($student->date_of_birth)->age }} years old</small>
            </div>
            
            <div class="mb-3 pb-3 border-bottom">
                <label class="text-muted small text-uppercase d-block mb-2">Course</label>
                <span class="badge bg-info fs-6 px-3 py-2">
                    <i class="fas fa-book"></i> {{ $student->course }}
                </span>
            </div>
            
            <div class="mb-3">
                <label class="text-muted small text-uppercase d-block mb-1">Address</label>
                <p class="mb-0">
                    <i class="fas fa-map-marker-alt text-warning"></i> 
                    {{ $student->address }}
                </p>
            </div>
            
        </div>
        
        <hr class="my-4">
        
        <div class="row g-2">
            <div class="col-12 col-sm-6">
                <small class="text-muted d-block">
                    <i class="fas fa-clock"></i> 
                    <strong>Created:</strong><br class="d-sm-none">
                    <span class="d-none d-sm-inline ms-1"></span>
                    {{ $student->created_at->format('d M Y, h:i A') }}
                </small>
            </div>
            <div class="col-12 col-sm-6 text-sm-end">
                <small class="text-muted d-block">
                    <i class="fas fa-edit"></i> 
                    <strong>Last Updated:</strong><br class="d-sm-none">
                    <span class="d-none d-sm-inline ms-1"></span>
                    {{ $student->updated_at->format('d M Y, h:i A') }}
                </small>
            </div>
        </div>
        
    </div>
    
    <div class="card-footer bg-light p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-between gap-2">
            <a href="{{ route('students.index') }}" class="btn btn-secondary flex-fill flex-sm-grow-0">
                <i class="fas fa-list"></i> All Students
            </a>
            
            <div class="d-flex gap-2 flex-fill flex-sm-grow-0">
                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning flex-fill">
                    <i class="fas fa-edit"></i> 
                    <span class="d-none d-sm-inline">Edit</span>
                </a>
                
                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="flex-fill" onsubmit="return confirm('Are you sure you want to delete this student?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="fas fa-trash"></i> 
                        <span class="d-none d-sm-inline">Delete</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
    
</div>

@endsection