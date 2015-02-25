angular.module('App',[
	'ui.bootstrap',
	'ui.router',
	'srph.timestamp-filter',
	'vesparny.fancyModal',
	'angularFileUpload',
	'Controllers'
	])
.config(['$routeProvider', '$locationProvider',
  function($routeProvider, $locationProvider) {
		console.info('config $routeProvider='+$routeProvider+' $locationProvider='+$locationProvider);
		$routeProvider
      .when('/ci22/categorias_controller', {
        templateUrl: '/ci22/categorias_controller',
        controller: 'Categoriasv2Controller'
      })
      .when('/ci22/idiomas_controller', {
        templateUrl: '/ci22/idiomas_controller',
        controller: 'IdiomasController'
      })
      .when('/ci22/contenidos_controller', {
        templateUrl: '/ci22/contenidos_controller',
        controller: 'ContenidosController'
      })
      .when('/ci22/usuario_controller', {
        templateUrl: '/ci22/usuario_controller',
        /*controller: 'UsuariosController'*/
      })
      .otherwise({
        templateUrl: '/ci22/adminpanel_controller/dashboard'
      });

      $locationProvider.html5Mode(true);
}])
.controller('DashboardController', ['$route', '$routeParams', '$location', '$scope',
  function($route, $routeParams, $location, $scope) {
    this.$route = $route;
    this.$location = $location;
    this.$routeParams = $routeParams;
    $scope.titulo = 'Dashboard';
    console.info('ini DashboardController');

    $scope.go = function(newtitulo,path) {
    	$scope.titulo = newtitulo;
    	console.info(path);
    	$location.path( path );
  	}
}])
;
