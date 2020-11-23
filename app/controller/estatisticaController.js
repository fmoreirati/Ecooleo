app.controller('EstatisticaController', function ($scope, $http) {

  $scope.acessos = "Conectando...";

  $http.get(urlDatabase + "cont")
    .then(function (response) {
      $scope.acessos = response.data[0].Acessos;
    });
});