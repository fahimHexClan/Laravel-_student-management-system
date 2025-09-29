<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .welcome-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .icon-box {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
            margin: 0 auto 1.5rem;
        }
        @media (max-width: 576px) {
            .icon-box {
                width: 60px;
                height: 60px;
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container px-3">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6">
                <div class="welcome-card p-4 p-md-5">
                    <div class="icon-box">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    
                    <h1 class="text-center mb-3 fw-bold">
                        <span class="d-none d-sm-inline">Student Management System</span>
                        <span class="d-inline d-sm-none">Student Management</span>
                    </h1>
                    
                    <p class="text-center text-muted mb-4">
                        Manage student records efficiently and effectively
                    </p>
                    
                    <div class="d-grid gap-3">
                        <a href="{{ route('students.index') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-users"></i> View All Students
                        </a>
                        <a href="{{ route('students.create') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-plus"></i> Add New Student
                        </a>
                    </div>
                    
                    <div class="text-center mt-4">
                        <small class="text-muted">
                            <i class="fas fa-code"></i> Built with Laravel & Bootstrap
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>