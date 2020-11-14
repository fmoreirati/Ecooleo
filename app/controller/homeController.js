app.controller('HomeController', function ($scope) {
  // Vamos imaginar que a URL acessada foi /users/rafaell

  var litrosConsumoMes = parseFloat($scope.litrosConsumoMes);
  var valorSabaoLiquido = parseFloat($scope.valorSabaoLiquido);

  $scope.totalGanho = 0;
  $scope.ganhoProducao = 0;
  $scope.lucroMedio = 0;

  $scope.calculoValores = function () {
    $scope.totalGanho = ((litrosConsumoMes * 15) * valorSabaoLiquido);

  };
});