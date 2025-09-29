<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Responsive CSS -->
    <style>
        /* Mobile First Approach */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .container {
            flex: 1;
        }
        
        /* Navbar Improvements */
        .navbar-brand {
            font-size: 1.2rem;
            font-weight: bold;
        }
        
        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1rem;
            }
            .navbar-brand i {
                display: none;
            }
        }
        
        /* Card Responsive */
        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
            margin-bottom: 2rem;
        }
        
        .card-header h4 {
            font-size: 1.25rem;
        }
        
        @media (max-width: 768px) {
            .card-header h4 {
                font-size: 1rem;
            }
            .card-header .btn {
                font-size: 0.875rem;
                padding: 0.375rem 0.75rem;
            }
        }
        
        /* Table Responsive Improvements */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        @media (max-width: 768px) {
            .table {
                font-size: 0.875rem;
            }
            .table td, .table th {
                padding: 0.5rem;
                white-space: nowrap;
            }
            .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
            }
        }
        
        /* Form Improvements */
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        @media (max-width: 576px) {
            .form-label {
                font-size: 0.9rem;
            }
        }
        
        /* Button Groups - Stack on Mobile */
        .btn-group-mobile {
            display: flex;
            gap: 0.5rem;
        }
        
        @media (max-width: 576px) {
            .btn-group-mobile {
                flex-direction: column;
            }
            .btn-group-mobile .btn {
                width: 100%;
            }
        }
        
        /* Alert Responsive */
        .alert {
            font-size: 0.95rem;
        }
        
        @media (max-width: 576px) {
            .alert {
                font-size: 0.875rem;
                padding: 0.75rem;
            }
        }
        
        /* Footer */
        footer {
            margin-top: auto;
            background: #f8f9fa;
            padding: 1.5rem 0;
        }
        
        @media (max-width: 576px) {
            footer p {
                font-size: 0.875rem;
            }
        }
        
        /* Action Buttons - Better spacing on mobile */
        .action-buttons {
            display: flex;
            gap: 0.25rem;
            flex-wrap: wrap;
        }
        
        @media (max-width: 576px) {
            .action-buttons {
                gap: 0.15rem;
            }
        }
        
        /* Search Box Improvements */
        @media (max-width: 576px) {
            .search-container .col-md-10,
            .search-container .col-md-2 {
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }
        
        /* Badge Responsive */
        .badge {
            font-size: 0.85rem;
            padding: 0.35em 0.65em;
        }
        
        @media (max-width: 576px) {
            .badge {
                font-size: 0.75rem;
                padding: 0.25em 0.5em;
            }
        }
    </style>
</head>
<body>
    
    <!-- Navigation Bar - Fully Responsive -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container-fluid px-3 px-md-4">
            <a class="navbar-brand" href="{{ route('students.index') }}">
                <i class="fas fa-graduation-cap d-none d-sm-inline"></i> 
                <span class="d-inline d-sm-none">SMS</span>
                <span class="d-none d-sm-inline">Student Management</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('students.index') ? 'active' : '' }}" href="{{ route('students.index') }}">
                            <i class="fas fa-list"></i> 
                            <span class="d-lg-inline">All Students</span>
                            <span class="d-none d-sm-inline d-lg-none">Students</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('students.create') ? 'active' : '' }}" href="{{ route('students.create') }}">
                            <i class="fas fa-plus"></i> 
                            <span class="d-lg-inline">Add Student</span>
                            <span class="d-none d-sm-inline d-lg-none">Add</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="container-fluid px-3 px-md-4 py-3 py-md-4">
        
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> 
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> 
                <span>{{ session('error') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Page Content -->
        @yield('content')
        
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-auto border-top">
        <div class="container-fluid px-3">
            <p class="mb-0 text-muted">
                <small>&copy; 2024 Student Management System. All rights reserved.</small>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Search Auto Submit (Optional) -->
    <script>
        const searchInput = document.querySelector('input[name="search"]');
        if(searchInput) {
            let timeout = null;
            searchInput.addEventListener('input', function() {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    this.form.submit();
                }, 500);
            });
        }
    </script>
    
</body>
</html>