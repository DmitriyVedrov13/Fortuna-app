{{-- resources/views/login.blade.php --}}
@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
    <div ng-controller="LoginController">
        <h2>Iniciar sesión</h2>

        <form ng-submit="login()">
            <div class="form-group">
                <label for="email">Email:</label>
                <input id="email" type="email" ng-model="formData.email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input id="password" type="password" ng-model="formData.password" required>
            </div>

            <button type="submit" class="btn">Entrar</button>

            <p class="error-message" ng-if="error">@{{ error }}</p>
        </form>

        <a href="/register" class="link">¿No tienes cuenta? Crear cuenta</a>
    </div>
@endsection

@section('scripts')
    <script>
        app.controller('LoginController', function($scope, $http) {
            $scope.formData = {};
            $scope.error = '';

            $scope.login = function() {
                $scope.error = '';
                $http.post('/login', $scope.formData)
                    .then(function(response) {
                        window.location.href = '/galleta';
                    }, function(error) {
                        $scope.error = error.data.errors.email[0] || "Credenciales incorrectas.";
                    });
            };
        });
    </script>
@endsection
