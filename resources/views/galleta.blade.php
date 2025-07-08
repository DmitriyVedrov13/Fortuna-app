<!DOCTYPE html>
<html lang="es" ng-app="FortunaApp">
<head>
    <meta charset="UTF-8">
    <title>Galleta de la Fortuna</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            margin-top: 100px;
        }
        button {
            padding: 15px 30px;
            font-size: 18px;
            background-color: #f6c90e;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            margin: 10px;
        }
        #mensaje {
            margin-top: 40px;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body ng-controller="FortunaController">

    <h1>Bienvenido a la Galleta de la Fortuna</h1>

    <button ng-click="abrirGalleta()">ABRE TU GALLETA</button>

    <div id="mensaje" ng-if="mensaje">
        @{{ mensaje }}
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>

    <script>
        angular.module('FortunaApp', [])
            .controller('FortunaController', function($scope, $http) {
                $scope.mensaje = '';

                $scope.abrirGalleta = function() {
                    $http.get('/api/fortuna')
                        .then(function(response) {
                            $scope.mensaje = response.data.mensaje;
                        }, function(error) {
                            alert("Error al obtener el mensaje.");
                        });
                };
            });
    </script>
</body>
</html>
