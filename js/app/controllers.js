angular.module('Controllers', [])

.controller('Categoriasv2Controller', function($scope, $http, $location, $routeParams) {

  console.info('ini->Categoriasv2Controller');

  $scope.list_categoria = {};
  $scope.categoria = {};
  $scope.list_idioma = {};
  $scope.new_categoria = {};

  //GET
  $http.get('http://swfideas.com/ci22/categorias_controller/get_categorias_list').then(function(response) {
    $scope.categoria = angular.copy(response.data.new_categoria);
    $scope.new_categoria = angular.copy(response.data.new_categoria);
    $scope.list_categoria = response.data.list_categoria;
    $scope.list_idioma = response.data.list_idioma;
  });

  //REFRESH
  $scope.refresh = function() {

    $http.get('http://swfideas.com/ci22/categorias_controller/get_categorias_list').then(function(response) {
      $scope.categoria = angular.copy(response.data.new_categoria);
      $scope.new_categoria = angular.copy(response.data.new_categoria);
      $scope.list_categoria = response.data.list_categoria;
      $scope.list_idioma = response.data.list_idioma;

      if ($scope.skyform != undefined)
        $scope.skyform.$setPristine();
    });

  };

  //SELECT ID
  $scope.edit = function(categoria) {
      $scope.categoria = categoria;
    }
    //SAVE||UPDATE
  $scope.save = function() {

      $http.post('http://swfideas.com/ci22/categorias_controller/save_categorias', $scope.categoria).then(function(response) {

        if (response.data.op) {
          var result = response.data.categoria;
          var insert = true;

          for (i in $scope.list_categoria) {
            if ($scope.list_categoria[i].PK_Categoria == result.PK_Categoria) {
              $scope.list_categoria[i] = result;
              insert = false;
            }
          }
          if (insert) {
            $scope.list_categoria.push(result);
          }
          $scope.categoria = angular.copy($scope.new_categoria);
          $scope.skyform.$setPristine();
          console.info("save->" + response.data.op);
        } else {
          // ver que pedo con los response.data.errors
        }

      });
    }
    //DELETE
  $scope.delete = function(categoria) {

      $http.post('http://swfideas.com/ci22/categorias_controller/delete_categoria', categoria).then(function(response) {

        console.log(response);

        if (response.data.op) {
          var result = response.data.result;
          for (i in $scope.list_categoria) {
            if ($scope.list_categoria[i].PK_Categoria == result.PK_Categoria) {
              $scope.list_categoria.splice(i, 1);
            }
          }
        } else {
          console.error(response.data);
          // ver que pedo con los response.data.errors
        }

      });
    }
    // LOAD DATA
  $scope.refresh();

})
.service('ContenidosService', function($location, $http, $q) {

  this.delete = function(id) {
    return $http.post($location.path() + '/delete_contenido', id);
  }

  this.get_model = function() {

    console.info($location.path());

    return $http.get($location.path() + '/get_model');
  };

  this.get_contenidos_traducciones = function() {
    return $http.get($location.path() + '/get_contenidos_traducciones');
  };

  this.save = function(contenido) {
    console.info('ContenidosService:call->save');
    console.info(contenido);
    //return true;
    return $http.post($location.path() + '/save_contenido', contenido);
  };

})
.controller('ContenidosController', function(
  $scope, $http, $location, $routeParams, $fancyModal, $log, ContenidosService, $upload) {

  $scope.list_categoria = {};
  $scope.selected_categoria = {};
  $scope.contenidos_traducciones = {};
  $scope.new_contenido = {};

  //SELECT ID
  $scope.edit = function(c) {
      //var cat_id = $scope.list_categoria.map(function (element) {return element.PK_Categoria;}).indexOf('78');
      $scope.selected_categoria = {
        "PK_Contenido": c.PK_Contenido,
        "PK_Categoria": c.PK_Categoria,
        "Clave": c.ClaveCat,
        "list_idioma": [{
          "FK_Idioma": c.PK_Idioma,
          "Label": c.Label,
          "Nombre": c.Nombre,
          "titulo": c.Titulo,
          "traduccion": c.Traduccion
        }]
      };

      //$scope.selected_categoria = categoria;
    }
    //SAVE
  $scope.save = function() {

      console.info('ContenidosController:call->save');
      ContenidosService.save($scope.selected_categoria).then(function(response) {

        console.info('response.data->ini');
        if (response.data.op) {
          var result = response.data.Traduccion;
          var insert = true;

          for (i in $scope.contenidos_traducciones) {
            if ($scope.contenidos_traducciones[i].PK_Contenido == result[0].PK_Contenido &&
              $scope.contenidos_traducciones[i].PK_Idioma == result[0].PK_Idioma) {
              $scope.contenidos_traducciones[i] = result[0];
              insert = false;
            }
          }
          if (insert) {
            for (t in result) {
              $scope.contenidos_traducciones.push(result[t]);
            }
          }
          //$scope.categoria = angular.copy($scope.new_categoria);
          $scope.selected_categoria = {}; //?que pedo si o no?
          $scope.skyform.$setPristine();
          console.info("save->" + response.data.op);
        } else {
          // ver que pedo con los response.data.errors
        }
      });

    }
    //DELETE
  $scope.delete = function(c) {
      ContenidosService.delete(c.PK_Contenido).then(function(response) {
        if (response.data.op) {
          var result = response.data.result;
          for (i in $scope.contenidos_traducciones) {
            if ($scope.contenidos_traducciones[i].PK_Contenido == result.PK_Contenido) {
              $scope.contenidos_traducciones.splice(i, 1);
            }
          }
        } else {
          // ver que pedo con los response.data.errors
        }
      });
    }
    //REFRESH
  $scope.refresh = function() {

    ContenidosService.get_model().then(function(d) {

      $scope.list_categoria = angular.copy(d.data.list_categoria);
      $scope.new_contenido = angular.copy(d.data.new_contenido);
      $scope.selected_categoria = {};

      if ($scope.skyform != undefined)
        $scope.skyform.$setPristine();

    });

    ContenidosService.get_contenidos_traducciones().then(function(d) {
      $scope.contenidos_traducciones = d.data;
    });

    $scope.idioma = {};
  };

  // LOAD DATA
  $scope.refresh();
  // ------------------- MODAL
  $scope.items = ['item1', 'item2', 'item3'];

  $scope.modalAndCtrl = function(contenido) {

    $fancyModal.open({
      templateUrl: 'traduccion.html',
      controller: ['$scope', function($scope) {
        $scope.modal = contenido;
      }]
    });
  };
  // ------------------- UPLOAD FILE
  $scope.files = [];
  $scope.progress = 0;
  $scope.progressArray = [];

  $scope.upload = function(files) {

    if (files && files.length) {

      for (var i = 0; i < files.length; i++) {
        var file = files[i];
        file.progress = 0;
        $scope.progressArray.push(file);

        $upload.upload({
          url: 'contenidos_controller/upload',
          fields: {
            'FK_Contenido': $scope.selected_categoria.PK_Contenido,
						'FK_Idioma': $scope.selected_categoria.list_idioma[0].FK_Idioma
          },
          file: file
        }).progress(function(evt) {
          var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
          console.log('i:' + $scope.progressArray.indexOf(evt.config.file) + ' / progress: ' + progressPercentage + '% ' + evt.config.file.name);
          $scope.progress = progressPercentage;
          //$scope.progressArray[i].progress = progressPercentage;
          $scope.progressArray[$scope.progressArray.indexOf(evt.config.file)].progress = progressPercentage;
        }).success(function(data, status, headers, config) {
					//regreso respuesta sobre upload, aun no confirmamos si subio
          console.log('i:' + i + ' / file ' + config.file.name);
					console.log('i:' + i + ' / uploaded. Response: ' + data);
          $scope.progress = 0;
          //$scope.selected_categoria.file = 'hola';
        });
      }

    }
  };

})

.controller('ModalInstanceCtrl', function($scope, $modalInstance, items) {

  $scope.items = items;
  $scope.selected = {
    item: $scope.items[0]
  };

  $scope.ok = function() {
    $modalInstance.close($scope.selected.item);
  };

  $scope.cancel = function() {
    $modalInstance.dismiss('cancel');
  };
})
.factory('alertService', function($rootScope) {
  var alertService = {};

  // create an array of alerts available globally
  $rootScope.alerts = [];

  alertService.add = function(type, msg) {
    $rootScope.alerts.push({
      'type': type,
      'msg': msg
    });
  };

  alertService.closeAlert = function(index) {
    $rootScope.alerts.splice(index, 1);
  };

  return alertService;
})
.service('UsuariosService', function($location, $http, $q) {
  //SELECT ----------------------------------------------------------------- USUARIOS
  var usuarios = {};

  this.getTable = function() {
    return $http.get($location.path() + '/get_usuarios');
  };
})
.controller('UsuariosController', function($scope, $http, $location, $routeParams, UsuariosService) {

  console.info('ini->UsuariosController');

  $scope.usuario = {};
  $scope.usuarios = {};

  $scope.$parent.$parent.titulo = $routeParams.titulo;
  //REFRESH
  $scope.refresh = function() {
    UsuariosService.getTable().then(function(d) {
      $scope.usuarios = d.data;

      if ($scope.skyform != undefined)
        $scope.skyform.$setPristine();

    });
    $scope.usuario = {};
  };
  // LOAD DATA
  $scope.refresh();

});
