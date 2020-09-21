app.controller('HomeController', function ($scope) {
  // Vamos imaginar que a URL acessada foi /users/rafaell

  var litrosConsumoMes = parseFloat($scope.litrosConsumoMes);
  var valorSabaoLiquido = parseFloat($scope.valorSabaoLiquido);
  var litros = 15;
  var total = 0;

  $scope.totalGanho = function () {
    total =  ((litrosConsumoMes * litros) * valorSabaoLiquido);
    console.log(total);
    return total;
  };

});