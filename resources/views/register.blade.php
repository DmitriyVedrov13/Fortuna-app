{{-- resources/views/register.blade.php --}}
@extends('layouts.app')

@section('title', 'Registro')

@section('content')
    <div ng-controller="RegisterController">
        <h2>Crear cuenta</h2>

        <form ng-submit="register()">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input id="name" type="text" ng-model="formData.name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input id="email" type="email" ng-model="formData.email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input id="password" type="password" ng-model="formData.password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Repetir contraseña:</label>
                <input id="password_confirmation" type="password" ng-model="formData.password_confirmation" required>
            </div>

            <button type="submit" class="btn">Registrarme</button>

            <p class="error-message" ng-if="error">@{{ error }}</p>
        </form>

        <a href="/login" class="link">¿Ya tienes cuenta? Inicia sesión</a>
    </div>
@endsection

@section('scripts')
    <script>
        app.controller('RegisterController', function($scope, $http) {
            $scope.formData = {};
            $scope.error = '';

            $scope.register = function() {
                $scope.error = '';
                $http.post('/register', $scope.formData)
                    .then(function(response) {
                        window.location.href = '/galleta';
                    }, function(error) {
                        if (error.data.errors) {
                            $scope.error = Object.values(error.data.errors)[0][0];
                        } else {
                            $scope.error = error.data.message || "Ocurrió un error. Inténtalo de nuevo.";
                        }
                    });
            };
        });
    </script>
@endsection
