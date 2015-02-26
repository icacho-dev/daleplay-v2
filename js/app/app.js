angular.module('App',[
	'ui.bootstrap',
	'ui.router',
	'srph.timestamp-filter',
	'vesparny.fancyModal',
	'angularFileUpload',
	'Controllers'
	])
	.config(function($stateProvider, $urlRouterProvider){


			$urlRouterProvider.otherwise('/Dashboard');
			$stateProvider

	        // HOME STATES AND NESTED VIEWS ========================================
	        .state('Dashboard', {
	            url: '/Dashboard',
							templateUrl: '/ci22/adminpanel_controller/dashboard'
	        })
					.state('Categorias', {
	            url: '/Categorias',
							templateUrl: '/ci22/categorias_controller',
							controller: 'Categoriasv2Controller'
	        })
					.state('Idiomas', {
	            url: '/Idiomas',
							templateUrl: '/ci22/idiomas_controller',
							controller: 'IdiomasController'
	        })
					.state('Contenidos', {
	            url: '/Contenidos',
							templateUrl: '/ci22/contenidos_controller',
							controller: 'ContenidosController'
	        })
					.state('Usuarios', {
	            url: '/Usuarios',
							templateUrl: '/ci22/usuario_controller',
							controller: 'UsuariosController'
	        })
					;
})
.controller('DashboardController',
  function($scope,$location) {

		console.info('ini DashboardController ');
		
		$scope.titulo = 'Dashboard';
		var path = $location.path();
		switch(path)
		{
			case '/Categorias': $scope.titulo = 'Categorias';break;
			case '/Idiomas': $scope.titulo = 'Idiomas';break;
			case '/Contenidos': $scope.titulo = 'Contenidos';break;
			case '/Usuarios': $scope.titulo = 'Usuarios';break;
		}

    $scope.go = function(newtitulo,path) {
    	$scope.titulo = newtitulo;
    	console.info(path);
			$location.path( path );
  	}
})
;
