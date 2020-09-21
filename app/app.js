var app = angular
  .module('myapp', [
    'ngRoute'
  ]);

// Definindo Rotas
app.config(function ($routeProvider) {
  $routeProvider
    .when('/', {
      templateUrl: 'app/pages/home.html',
      controller: 'HomeController'
    })

    .when('/info', {
      templateUrl: 'app/pages/info.html',
      controller: 'InfoController'
    })

    .otherwise({
      redirectTo: '/'
    });
});