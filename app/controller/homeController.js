app.controller('HomeController', function ($scope, $http) {

  $http.get(urlDatabase + "cont").then()
  $headers = { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' }

  $scope.litrosDescarteMes;
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

    $scope.dadosEntrada = "myData= " + JSON.stringify({
      quantLitrosColetados: $scope.litrosConsumoMes,
      quantAguaPoluida: ($scope.litrosDescarteMes * 20),
      quantSabaoLiquido: ($scope.litrosConsumoMes * 15),
      receitaTotal: $scope.totalGanho,
      gastoTotal: $scope.gastoProducao,
      lucro: $scope.lucroMedio
    });

    $http({
      url: urlDatabase + "add",
      method: "POST",
      data: $scope.dadosEntrada,
      headers: $headers,
    })
      .then(function (response) {
        console.log(response);
      });

  }

});

