var app = angular
  .module('myapp', [
    'ngRoute'
  ]);

//var urlDatabase = "http://localhost/ecoleo/api/";
var urlDatabase = "https://ecooleo.6te.net/api/";

// Definindo Rotas
app.config(function ($routeProvider, $qProvider, $locationProvider) {
  $qProvider.errorOnUnhandledRejections(false);

  $routeProvider
    .when('/', {
      templateUrl: 'app/pages/home.html',
      controller: 'HomeController'
    })

    .when('/estatistica', {
      templateUrl: 'app/pages/estatistica.html',
      controller: 'EstatisticaController'
    })
    .when('/links', {
      templateUrl: 'app/pages/links.html',
    })

    .otherwise({
      redirectTo: '/'
    });


});