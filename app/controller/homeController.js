app.controller('HomeController', function ($scope, $http) {

  $http.get(urlDatabase + "acesso").then()

  $scope.litrosConsumoMes;
  $scope.valorSabaoLiquido;
  $scope.totalGanho = 0;
  $scope.gastoProducao = 0;
  $scope.lucroMedio = 0;

  $scope.calcularValores = function (percente = 15) {
    let totalLitros = parseFloat(($scope.litrosConsumoMes) * 15);
    let valorSabao = parseFloat($scope.valorSabaoLiquido);

    $scope.totalGanho = totalLitros * valorSabao;
    $scope.gastoProducao = totalLitros * (percente / 100);
    $scope.lucroMedio = $scope.totalGanho - $scope.gastoProducao;
  }

});

