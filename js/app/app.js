angular.module('App',[	'ui.bootstrap',	'dialogs.main',	'ui.router',	'srph.timestamp-filter',	'vesparny.fancyModal',	'angularFileUpload',	'Controllers',	'angularUUID2'	])
	.config(function($stateProvider, $urlRouterProvider){
			$urlRouterProvider.otherwise('/Login');
			$stateProvider
	        // HOME STATES AND NESTED VIEWS ========================================					.state('Login', {
	            url: '/Login',
							templateUrl: '/ci22/adminpanel_controller/login',
							controller: 'LoginController',
      				authenticate: false,
							Title : 'Login',
							cache: false
					})
	        .state('Dashboard', {	            url: '/Dashboard',							templateUrl: '/ci22/adminpanel_controller/dashboard',      				authenticate: true,							Title : 'Dashboard',							cache: false	        })					.state('Categorias', {	            url: '/Categorias',							templateUrl: '/ci22/categorias_controller',							controller: 'Categoriasv2Controller',      				authenticate: true,							Title : 'Categorias',							cache: false	        })					.state('Idiomas', {	            url: '/Idiomas',							templateUrl: '/ci22/idiomas_controller',							controller: 'IdiomasController',      				authenticate: true,							Title : 'Idiomas',							cache: false	        })					.state('Contenidos', {	            url: '/Contenidos',							templateUrl: '/ci22/contenidos_controller',							controller: 'ContenidosController',      				authenticate: true,							Title : 'Contenidos',							cache: false	        })					.state('Usuarios', {	            url: '/Usuarios',							templateUrl: '/ci22/usuario_controller',							controller: 'UsuariosController',      				authenticate: true,							Title : 'Usuarios',							cache: false	        })					.state('DashboardUser', {	            url: '/DashboardUser',							templateUrl: '/ci22/adminpanel_controller/dashboarduser',      				authenticate: true,							Title : 'Dashboard',							cache: false	        })					.state('ContenidosUser', {	            url: '/ContenidosUser',							templateUrl: '/ci22/adminpanel_controller/dashboarduser',      				authenticate: true,							Title : 'Contenidos',							cache: false	        })					.state('MyPrep', {	            url: '/MyPrep',							templateUrl: '/ci22/adminpanel_controller/dashboarduser',      				authenticate: true,							Title : 'MyPrep',							cache: false	        })					;}).factory('TitleMenuService', function($rootScope) {    var sharedService = {};    sharedService.titulo = '';    sharedService.prepForBroadcast = function(newtitulo) {        this.titulo = newtitulo;        this.broadcastItem();    };    sharedService.broadcastItem = function() {        $rootScope.$broadcast('handleTitleBroadcast');    };    return sharedService;}).run(function ($rootScope, $state, AuthService, TitleMenuService) {  $rootScope.$on("$stateChangeStart", function(event, toState, toParams, fromState, fromParams){		TitleMenuService.prepForBroadcast(toState.Title);		if(toState.url == '/Login')		{			$rootScope.uuid = null;		}		else if (toState.authenticate && !AuthService.isAuthenticated())		{      $state.transitionTo("Login");      event.preventDefault();    }	});}).controller('DashboardController',
  function($scope, $rootScope, $location, AuthService, TitleMenuService) {		console.info('ini DashboardController ');		$scope.titulo = 'Login';		var path = $location.path();		$rootScope.uuid = null;
		if(AuthService.isAuthenticated())
		{
			switch(path)
			{
				case '/Categorias': $scope.titulo = 'Categorias';break;
				case '/Idiomas': $scope.titulo = 'Idiomas';break;
				case '/Contenidos': $scope.titulo = 'Contenidos';break;
				case '/Usuarios': $scope.titulo = 'Usuarios';break;
			}
		}
		$location.hash('');    $scope.go = function(newtitulo,path) {			if(AuthService.isAuthenticated()) $scope.titulo = newtitulo;    	console.info(path);			$location.path( path );			$location.hash('');  	}		$scope.$on('handleTitleBroadcast', function() {			if(AuthService.isAuthenticated()) $scope.titulo = TitleMenuService.titulo;    })		$scope.isAdmin = function() {    	return AuthService.isAuthenticated() && $rootScope.TypeUser == true;  	};		$scope.isUser = function() {    	return AuthService.isAuthenticated() && $rootScope.TypeUser == false;  	};}).service('AuthService', function($rootScope) {  this.isAuthenticated = function() {    return $rootScope.uuid !== null;  };	this.isAuthenticated = function() {    return $rootScope.uuid !== null;  };});