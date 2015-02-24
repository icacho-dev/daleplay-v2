angular.module('App',[
	'ui.bootstrap',
	'ngRoute',
	'srph.timestamp-filter',
	'vesparny.fancyModal',
	'angularFileUpload',
	'Controllers'
	])
.config(['$routeProvider', '$locationProvider',
  function($routeProvider, $locationProvider) {
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
			/*
      .when('/ci22/usuario_controller', {
        templateUrl: '/ci22/usuario_controller',
        controller: 'UsuariosController'
      })*/
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
.service('IdiomasService', function ($location,$http,$q) {
	//SELECT ----------------------------------------------------------------- IDIOMAS
    var idiomas = {};

    this.getTable = function (){
		return $http.get( $location.path() + '/get_idiomas');
	};
	//SELECT ID
	this.getItem = function (id) {

		var result = {};

		$http.post( $location.path() + '/get_idioma',id)
			.then(function(response) {

		        console.log(response);
		        console.log(response.data);
		        return response.data;
		    },
		    function(response) { // optional
		        // failed
		        result = {
		        		insert:false
		        	}
		    });

    }
    //INSERT
    this.save = function (idioma) {
    	console.info(idioma);
        return $http.post( $location.path() + '/save_idiomas',idioma);
    };
    //DELETE
    this.delete = function (id)
    {
    	return $http.post( $location.path() + '/delete_idioma',id);
    }
})
.controller('IdiomasController',function($scope,$http,$location,$routeParams,IdiomasService){

	console.info('ini->IdiomasController');

	$scope.idioma = {};
	$scope.idiomas = {};

	$scope.$parent.$parent.titulo = $routeParams.titulo;
 	//REFRESH
	$scope.refresh = function(){
		IdiomasService.getTable().then(function(d) {
		    $scope.idiomas = d.data;

		    if($scope.skyform != undefined)
		    	$scope.skyform.$setPristine();

		});
		$scope.idioma = {};
	};

	//SELECT ID
	$scope.edit = function (idioma) {
		$scope.idioma = idioma;
    }

	//INSERT
	$scope.save = function () {
		IdiomasService.save($scope.idioma).then(function(response){
			console.info(response.data);
			if(response.data.op)
			{
				var result = response.data.result;
				var insert = true;
				for (i in $scope.idiomas) {
					if($scope.idiomas[i].PK_Idioma == result.PK_Idioma){
						$scope.idiomas[i] = result;
						insert = false;
					}
				}
				if(insert) $scope.idiomas.push(result)
				$scope.idioma = {};
				$scope.skyform.$setPristine();
			} else {
				// ver que pedo con los response.data.errors
			}
		});
	}
	//DELETE
	$scope.delete = function (idioma) {
        IdiomasService.delete(idioma.PK_Idioma).then(function(response){
	        if(response.data.op)
			{
				var result = response.data.result;
				for (i in $scope.idiomas) {
					if ($scope.idiomas[i].PK_Idioma == result.PK_Idioma) {
	                	$scope.idiomas.splice(i, 1);
	            	}
				}
			} else {
				// ver que pedo con los response.data.errors
			}
        });
    }
    // LOAD DATA
    $scope.refresh();

})
;
