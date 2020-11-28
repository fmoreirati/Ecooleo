app.controller('EstatisticaController', function ($scope, $http) {

  $scope.acessos = "Conectando...";
  $scope.dados = [];

  $http.get(urlDatabase + "acessos")
    .then(function (response) {
      //console.log(response);
      $scope.acessos = response.data[0].Acessos;
    });

  $http.get(urlDatabase + "totais")
    .then(function (response) {
      //console.log(response);
      $scope.dados = response.data;
    });

});