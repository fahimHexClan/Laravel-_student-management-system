@extends('layouts.app')

@section('content')

<div class="card border-0 shadow-sm">
    <div class="card-header bg-primary text-white">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
            <h4 class="mb-0">
                <i class="fas fa-users"></i> 
                <span class="d-none d-sm-inline">All Students</span>
                <span class="d-inline d-sm-none">Students</span>
            </h4>
            <a href="{{ route('students.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-plus"></i> 
                <span class="d-none d-sm-inline">Add New Student</span>
                <span class="d-inline d-sm-none">Add</span>
            </a>
        </div>
    </div>
    
    <!-- Search Form -->
    <div class="card-body bg-light border-bottom">
        <form action="{{ route('students.index') }}" method="GET">
            <div class="row g-2 search-container">
                <div class="col-12 col-md-10">
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="fas fa-search text-primary"></i>
                        </span>
                        <input 
                            type="text" 
                            name="search" 
                            class="form-control" 
                            placeholder="Search students..." 
                            value="{{ $search ?? '' }}"
                        >
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> 
                        <span class="d-none d-sm-inline">Search</span>
                    </button>
                </div>
            </div>
            
            @if($search)
            <div class="mt-2">
                <span class="badge bg-secondary">
                    <i class="fas fa-filter"></i> "{{ $search }}"
                    <a href="{{ route('students.index') }}" class="text-white text-decoration-none ms-1">
                        <i class="fas fa-times"></i>
                    </a>
                </span>
            </div>
            @endif
        </form>
    </div>
    
    <div class="card-body p-0 p-md-3">
        
        @if($students->count() > 0)
        
        <!-- Desktop Table View -->
        <div class="table-responsive d-none d-lg-block">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 20%;">Name</th>
                        <th style="width: 25%;">Email</th>
                        <th style="width: 15%;">Phone</th>
                        <th style="width: 15%;">Course</th>
                        <th style="width: 20%;" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->phone }}</td>
                        <td><span class="badge bg-info">{{ $student->course }}</span></td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('students.show', $student->id) }}" class="btn btn-sm btn-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this student?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Mobile/Tablet Card View -->
        <div class="d-lg-none">
            @foreach($students as $student)
            <div class="card mb-2 border">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h6 class="mb-1 fw-bold text-primary">{{ $student->name }}</h6>
                            <span class="badge bg-info">{{ $student->course }}</span>
                        </div>
                        <span class="badge bg-secondary">#{{ $loop->iteration }}</span>
                    </div>
                    
                    <div class="small text-muted mb-2">
                        <div class="mb-1">
                            <i class="fas fa-envelope text-primary"></i> {{ $student->email }}
                        </div>
                        <div>
                            <i class="fas fa-phone text-success"></i> {{ $student->phone }}
                        </div>
                    </div>
                    
                    <div class="d-flex gap-1 flex-wrap">
                        <a href="{{ route('students.show', $student->id) }}" class="btn btn-sm btn-info flex-fill">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-warning flex-fill">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="flex-fill" onsubmit="return confirm('Delete?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger w-100">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        @else
        
        <div class="alert alert-warning text-center m-3">
            @if($search)
                <i class="fas fa-search"></i> No results for "{{ $search }}". 
                <a href="{{ route('students.index') }}" class="alert-link">Clear</a>
            @else
                <i class="fas fa-exclamation-triangle"></i> No students yet. 
                <a href="{{ route('students.create') }}" class="alert-link">Add first student</a>
            @endif
        </div>
        
        @endif
        
    </div>
</div>

@endsection