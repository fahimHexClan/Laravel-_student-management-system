@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="fas fa-users"></i> All Students</h4>
        <a href="{{ route('students.create') }}" class="btn btn-light">
            <i class="fas fa-plus"></i> Add New Student
        </a>
    </div>

     <div class="card-body bg-light border-bottom">
        <form action="{{ route('students.index') }}" method="GET">
            <div class="row g-3">
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input 
                            type="text" 
                            name="search" 
                            class="form-control" 
                            placeholder="Search by name, email, phone or course..." 
                            value="{{ $search ?? '' }}"
                        >
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </div>
            
            @if($search)
            <div class="mt-2">
                <span class="badge bg-secondary">
                    Searching for: "{{ $search }}"
                    <a href="{{ route('students.index') }}" class="text-white text-decoration-none ms-1">
                        <i class="fas fa-times"></i>
                    </a>
                </span>
            </div>
            @endif
        </form>
    </div>
    
    <div class="card-body">
        
        @if($students->count() > 0)
        
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Course</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->phone }}</td>
                        <td><span class="badge bg-info">{{ $student->course }}</span></td>
                        <td>
                            <!-- View Button -->
                            <a href="{{ route('students.show', $student->id) }}" class="btn btn-sm btn-info" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            
                            <!-- Edit Button -->
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <!-- Delete Button -->
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this student?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @else
        
        <div class="alert alert-warning text-center">
            <i class="fas fa-exclamation-triangle"></i> No students found. 
            <a href="{{ route('students.create') }}" class="alert-link">Add your first student</a>
        </div>
        
        @endif
        
    </div>
</div>

@endsection