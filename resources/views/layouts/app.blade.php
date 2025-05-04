<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background: #343a40;
            color: white;
        }
        .main-content {
            padding: 20px;
        }
        .card {
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .pagination {
            justify-content: center;
            margin-top: 2rem;
        }
        .page-item.active .page-link {
            background-color: #343a40;
            border-color: #343a40;
        }
        .page-link {
            color: #343a40;
        }
        .pagination-info {
            text-align: center;
            margin: 1rem 0;
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .sidebar .nav-link {
            padding: 0.75rem 1rem;
            border-radius: 0.25rem;
            margin-bottom: 0.25rem;
        }
        .sidebar .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
        }
        .sidebar .nav-link.active {
            background-color: rgba(255,255,255,0.2);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 sidebar p-4">
            <h2 class="text-center mb-4">Student Portal</h2>
<ul class="nav flex-column">
    <li class="nav-item mb-3">
        @include('components.home-button')
    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('students.*') ? 'active' : '' }}" 
                           href="{{ route('students.index') }}">
                            <i class="bi bi-people-fill me-2"></i> Students
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('courses.*') ? 'active' : '' }}" 
                           href="{{ route('courses.index') }}">
                            <i class="bi bi-book-fill me-2"></i> Courses
                        </a>
                    </li>
                    <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('teachers.*') ? 'active' : '' }}" 
           href="{{ route('teachers.index') }}">
           <i class="bi bi-person-badge-fill me-2"></i> Teachers
        </a>
    </li>
                </ul>
            </div>
            <div class="col-md-9 main-content">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                
                @yield('content')
                
                @hasSection('pagination')
                    <div class="mt-4">
                        @yield('pagination')
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });
    </script>
</body>
</html>