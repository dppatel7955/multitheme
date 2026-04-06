<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ tenant()->data['name'] ?? tenant('id') }} | Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --brand-color: #0ea5e9; /* Light blue brand for tenants by default */
            --brand-hover: #0284c7;
            --surface: #ffffff;
            --background: #f8fafc;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background-color: var(--background);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Navigation */
        .navbar {
            background-color: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--brand-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .navbar-links a, .navbar-links button {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
            font-family: inherit;
        }

        .navbar-links a:hover, .navbar-links button:hover {
            color: var(--brand-color);
        }

        /* Container */
        .container {
            flex-grow: 1;
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
        }

        /* Cards */
        .card {
            background-color: var(--surface);
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            border: 1px solid var(--border);
            overflow: hidden;
            padding: 2rem;
        }

        /* Auth specific */
        .auth-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
            padding: 2rem;
        }

        .auth-card {
            width: 100%;
            max-width: 400px;
            background: var(--surface);
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-header h1 {
            font-size: 1.5rem;
            margin: 0 0 0.5rem 0;
            color: var(--text-dark);
        }

        .auth-header p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* Form elements */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-dark);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-family: inherit;
            font-size: 0.9rem;
            box-sizing: border-box;
            background-color: #f8fafc;
            transition: all 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--brand-color);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.2);
            background-color: var(--surface);
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 0.8rem;
            background-color: var(--brand-color);
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn:hover {
            background-color: var(--brand-hover);
        }

        /* Alerts */
        .alert-danger {
            background-color: #fef2f2;
            color: #991b1b;
            padding: 1rem;
            border-radius: 6px;
            border: 1px solid #fecaca;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>

    @auth
        <nav class="navbar">
            <div class="navbar-brand">
                <i class="fa-solid fa-building"></i>
                {{ tenant()->data['name'] ?? tenant('id') }}
            </div>
            <div class="navbar-links">
                <span>{{ auth()->user()->name }}</span>
                <form action="{{ route('tenant.logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
                </form>
            </div>
        </nav>
        
        <div class="container">
            @yield('content')
        </div>
    @else
        <div class="auth-wrapper">
            @yield('content')
        </div>
    @endauth

</body>
</html>
