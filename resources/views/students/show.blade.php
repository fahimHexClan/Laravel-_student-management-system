@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="fas fa-user"></i> Student Details</h4>
        <div>
            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('students.index') }}" class="btn btn-light btn-sm">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
    
    <div class="card-body">
        
        <div class="row">
            
            <!-- Left Column -->
            <div class="col-md-6">
                
                <div class="mb-3">
                    <label class="text-muted small">Full Name</label>
                    <p class="h5">{{ $student->name }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="text-muted small">Email Address</label>
                    <p class="h6">
                        <i class="fas fa-envelope text-primary"></i> 
                        <a href="mailto:{{ $student->email }}">{{ $student->email }}</a>
                    </p>
                </div>
                
                <div class="mb-3">
                    <label class="text-muted small">Phone Number</label>
                    <p class="h6">
                        <i class="fas fa-phone text-success"></i> 
                        <a href="tel:{{ $student->phone }}">{{ $student->phone }}</a>
                    </p>
                </div>
                
            </div>
            
            <!-- Right Column -->
            <div class="col-md-6">
                
                <div class="mb-3">
                    <label class="text-muted small">Date of Birth</label>
                    <p class="h6">
                        <i class="fas fa-calendar text-danger"></i> 
                        {{ date('d M Y', strtotime($student->date_of_birth)) }}
                    </p>
                </div>
                
                <div class="mb-3">
                    <label class="text-muted small">Course</label>
                    <p class="h6">
                        <span class="badge bg-info fs-6">{{ $student->course }}</span>
                    </p>
                </div>
                
                <div class="mb-3">
                    <label class="text-muted small">Address</label>
                    <p class="h6">
                        <i class="fas fa-map-marker-alt text-warning"></i> 
                        {{ $student->address }}
                    </p>
                </div>
                
            </div>
            
        </div>
        
        <hr class="my-4">
        
        <!-- Additional Info -->
        <div class="row">
            <div class="col-md-6">
                <small class="text-muted">
                    <i class="fas fa-clock"></i> 
                    Created: {{ $student->created_at->format('d M Y, h:i A') }}
                </small>
            </div>
            <div class="col-md-6 text-end">
                <small class="text-muted">
                    <i class="fas fa-edit"></i> 
                    Last Updated: {{ $student->updated_at->format('d M Y, h:i A') }}
                </small>
            </div>
        </div>
        
    </div>
    
    <div class="card-footer bg-light">
        <div class="d-flex justify-content-between">
            <a href="{{ route('students.index') }}" class="btn btn-secondary">
                <i class="fas fa-list"></i> All Students
            </a>
            
            <div>
                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit Student
                </a>
                
                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this student?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Delete Student
                    </button>
                </form>
            </div>
        </div>
    </div>
    
</div>

@endsection