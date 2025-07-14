{{-- resources/views/galleta.blade.php --}}
@extends('layouts.app')

@section('title', 'Galleta de la Fortuna')

@section('content')
    <div ng-controller="FortunaController">
        <h1>Galleta de la Fortuna</h1>
        <p>Haz clic para descubrir tu suerte de hoy.</p>

        <button class="btn" ng-click="abrirGalleta()">ABRE TU GALLETA</button>

        <div id="mensaje" ng-if="mensaje">
            @{{ mensaje }}
        </div>

        <button class="btn btn-logout" ng-click="logout()">Cerrar sesión</button>
    </div>
@endsection

@section('scripts')
    <script>
        app.controller('FortunaController', function($scope, $http) {
            $scope.mensaje = 'Presiona el botón para ver tu fortuna.';

            $scope.abrirGalleta = function() {
                $scope.mensaje = 'Buscando tu fortuna...';
                $http.get('/api/fortuna')
                    .then(function(response) {
                        $scope.mensaje = response.data.mensaje;
                    }, function(error) {
                        $scope.mensaje = "No se pudo obtener el mensaje. Inténtalo de nuevo.";
                    });
            };

            $scope.logout = function() {
                $http.post('/logout').then(function() {
                    window.location.href = '/login';
                });
            };
        });
    </script>
@endsection
