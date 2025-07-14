{{-- resources/views/layouts/app.blade.php --}}
    <!DOCTYPE html>
<html lang="es" ng-app="FortunaApp">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Galleta de la Fortuna')</title>

    @vite('resources/css/app.css')

    <style>
        body {
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Instrument Sans', sans-serif;
        }
        .card {
            background: white;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 420px;
            text-align: center;
        }
        .card h1, .card h2 {
            color: #333;
            margin-bottom: 1.5rem;
        }
        .form-group {
            margin-bottom: 1rem;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: 500;
        }
        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
        }
        .btn {
            width: 100%;
            padding: 0.85rem;
            font-size: 1rem;
            background-color: #f6c90e;
            color: #333;
            font-weight: bold;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            margin-top: 1rem;
            transition: background-color 0.2s;
        }
        .btn:hover {
            background-color: #e0b60d;
        }
        .btn-logout {
            background-color: #e74c3c;
            color: white;
            margin-top: 2rem;
        }
        .btn-logout:hover {
            background-color: #c0392b;
        }
        .error-message {
            color: #e74c3c;
            margin-top: 1rem;
            font-weight: 500;
        }
        .link {
            margin-top: 1.5rem;
            display: block;
            color: #3498db;
            text-decoration: none;
        }
        .link:hover {
            text-decoration: underline;
        }
        #mensaje {
            margin-top: 2rem;
            font-size: 1.25rem;
            font-weight: bold;
            color: #2c3e50;
            min-height: 50px;
        }
    </style>
</head>
<body>

<div class="card">
    @yield('content')
</div>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
<script>
    // Определяем основной модуль Angular
    const app = angular.module('FortunaApp', []);

    app.config(['$httpProvider', function($httpProvider) {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $httpProvider.defaults.headers.common['X-CSRF-TOKEN'] = token;
    }]);
</script>
@yield('scripts')
</body>
</html>
