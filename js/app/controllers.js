angular.module('Controllers', [])

.controller('Categoriasv2Controller', function($scope, $http, $location) {

  console.info('ini->Categoriasv2Controller');

  $scope.list_categoria = {};
  $scope.categoria = {};
  $scope.list_idioma = {};
  $scope.new_categoria = {};

  //GET
  $http.get('categorias_controller/get_categorias_list').then(function(response) {
    $scope.categoria = angular.copy(response.data.new_categoria);
    $scope.new_categoria = angular.copy(response.data.new_categoria);
    $scope.list_categoria = response.data.list_categoria;
    $scope.list_idioma = response.data.list_idioma;
  });

  //REFRESH
  $scope.refresh = function() {

    $http.get('categorias_controller/get_categorias_list').then(function(response) {
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

      $http.post('categorias_controller/save_categorias', $scope.categoria).then(function(response) {

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

      $http.post('categorias_controller/delete_categoria', categoria).then(function(response) {

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
    return $http.post('contenidos_controller/delete_contenido', id);
  }

  this.get_model = function() {

    console.info($location.path());

    return $http.get('contenidos_controller/get_model');
  };

  this.get_contenidos_traducciones = function() {
    return $http.get('contenidos_controller/get_contenidos_traducciones');
  };

  this.save = function(contenido) {
    console.info('ContenidosService:call->save');
    console.info(contenido);
    //return true;
    return $http.post('contenidos_controller/save_contenido', contenido);
  };

})
.controller('ContenidosController', function(
  $scope, $http, $location, $fancyModal, $log, ContenidosService, $upload) {

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
  $scope.uploadedArray = [];
  $scope.uploadedSycArray = [];


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

          var r = {
            FK_Contenido : $scope.selected_categoria.PK_Contenido,
            FK_Idioma : $scope.selected_categoria.list_idioma[0].FK_Idioma,
            Nombre : config.file.name
          };

          $scope.progress = 0;
          $scope.uploadedArray.push(data);
          $scope.uploadedSycArray.push(r);
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
.service('IdiomasService', function ($location,$http,$q) {
	//SELECT ----------------------------------------------------------------- IDIOMAS
    var idiomas = {};

    this.getTable = function (){
		return $http.get('idiomas_controller/get_idiomas');
	};
	//SELECT ID
	this.getItem = function (id) {

		var result = {};

		$http.post('idiomas_controller/get_idioma',id)
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
        return $http.post('idiomas_controller/save_idiomas',idioma);
    };
    //DELETE
    this.delete = function (id)
    {
    	return $http.post('idiomas_controller/idiomas_controller/delete_idioma',id);
    }
})
.controller('IdiomasController',function($scope,$http,$location,IdiomasService){

	console.info('ini->IdiomasController');

	$scope.idioma = {};
	$scope.idiomas = {};

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
.service('UsuariosService', function($location, $http, $q) {
  //SELECT ----------------------------------------------------------------- USUARIOS
  this.getTable = function() {
    return $http.get('usuario_controller/get_usuarios');
  };
  //INSERT
  this.save = function (usuario) {
    console.info(usuario);
      return $http.post('usuario_controller/save_usuario',usuario);
  };
  //DELETE
  this.delete = function (id)
  {
    return $http.post('usuario_controller/delete_usuario',id);
  };
  //DELETE
  this.categorias = function (id)
  {
    console.info(id);
    return $http.post('usuario_controller/get_categorias_usuario',id);
  };
  //INSERT CATEGORIAS
  this.savecats = function(categorias) {
    console.info('savecats');
    console.info('savecats'+categorias);
    return $http.post('usuario_controller/save_categoria_usuario', categorias);
  };
})
.controller('UsuariosController', function($scope, $http, $anchorScroll, $location, dialogs, UsuariosService) {

  console.info('ini->UsuariosController');

  $scope.usuario = {};
  $scope.usuarios = {};
  $scope.categorias = {};

  //REFRESH LOADS DG
  $scope.refresh = function() {

    $scope.clean();
    UsuariosService.getTable().then(function(d) {
      $scope.usuarios = d.data;
    });
  };
  //CLEAN PAGE
  $scope.clean = function(){

    $scope.usuario = {};
    $scope.categorias = {};

    $scope.usuario.UserName = "";
    $scope.usuario.Password = "";
    $scope.usuario.ConfirmaPassword = "";
    $scope.usuario.Email = "";
    $scope.usuario.Telefono = "";

    $scope.rowvisible = -1;

    $scope.iscreate = false;
    $scope.isedit = false;
    $scope.isadmin = false;

    if ($scope.skyform != undefined)
    {
      $scope.skyform.$setPristine(true);
      $scope.skyform.confirmapassword.$invalid=false;
      $scope.skyform.confirmapassword.$valid=true;
    }
  }
  $scope.gotoAnchor = function(x) {
    var newHash = 'User' + x;
    $location.hash('');
    if ($location.hash() !== newHash) {
      $location.hash('User' + x);
      $anchorScroll();
    } else {
      $anchorScroll();
    }
  };
  //DISPLAY A VALUE ADMIN/USER IN DG
	$scope.EsAdmin = function (b) {
    return b == 'true' ? 'ADMIN' :'USER'
  }
  //DISPLAY A VALUE ACTIVO/INACTIVO IN DG
	$scope.UsuarioActivo = function (b) {
    return b == 'true' ? 'ACTIVO' :'INACTIVO'
  }
  //INSERT USER
  $scope.save = function () {
    UsuariosService.save($scope.usuario).then(function(response){
      console.info('Saved '+response.data);
      if(response.data.op)
      {
        var result = response.data.result;
        var insert = true;
        for (i in $scope.usuarios) {
          if($scope.usuarios[i].PK_Usuario == result.PK_Usuario){
            $scope.usuarios[i] = result;
            insert = false;
          }
        }
        if(insert){
          $scope.usuarios.push(result);
          dialogs.notify('Información','Usuario Creado: '+result.UserName,{'windowClass':'center-modal'});
        }
        else dialogs.notify('Información','Usuario Actualizado: '+result.UserName,{'windowClass':'center-modal'});

        $scope.clean();

      } else {
        // ver que pedo con los response.data.errors
      }
    }, function (error)
    {
      console.info('Error ');
      dialogs.error('Error',error.data,{'windowClass':'center-modal'})
    });
  }
	//DELETE USER
	$scope.delete = function (usuario) {
    var dlg = dialogs.confirm('Por favor Confirme','¿Desea Eliminar al Usuario: '+usuario.UserName+'?',{'windowClass':'center-modal'});
    dlg.result.then(function(btn){
      UsuariosService.delete(usuario.PK_Usuario).then(function(response)
      {
        if(response.data.op)
        {
            var result = response.data.result;
            for (i in $scope.usuarios) {
              if ($scope.usuarios[i].PK_Usuario == result.PK_Usuario) {
                        $scope.usuarios.splice(i, 1);
                    }
            }
            dialogs.notify('Información','Usuario Eliminado: '+usuario.UserName,{'windowClass':'center-modal'});
        } else {
          dialogs.error('Error',response.data.errors,{'windowClass':'center-modal'});
        }
      }, function (error)
      {
        console.info('Error ');
        dialogs.error('Error',error.data,{'windowClass':'center-modal'})
      });
    }, function (btn)
    {

    });
  }
  $scope.new = function() {
    $scope.clean();
    $scope.iscreate = true;
    $scope.gotoAnchor('New');
  }
  //SELECT A ROW IN THE DG
  $scope.detalle = function(usuario, index) {
    $scope.rowvisible = $scope.rowvisible == index && $scope.isadmin ? -1 : index;
    if($scope.rowvisible >= 0)
    {
      $scope.usuario = usuario;
      $scope.iscreate = false;
      $scope.isedit = false;
      $scope.isadmin = true;
      $scope.gotoAnchor(usuario.PK_Usuario);

      $scope.selall = {'Selected' : true};
      UsuariosService.categorias(usuario.PK_Usuario).then(function(d) {
        $scope.categorias = d.data;
        $scope.selectedall();
      });
    }
    else
    {
      $scope.usuario = {};
      $scope.iscreate = false;
      $scope.isedit = false;
      $scope.isadmin = false;
    }
  };
	//SELECT ID
	$scope.edit = function(usuario, index) {
    $scope.rowvisible = $scope.rowvisible == index && $scope.isedit ? -1 : index;
    if($scope.rowvisible >= 0)
    {
      $scope.usuario = usuario;
      $scope.iscreate = false;
      $scope.isedit = true;
      $scope.isadmin = false;
      $scope.gotoAnchor(usuario.PK_Usuario);
    }
    else
    {
      $scope.usuario = {};
      $scope.iscreate = false;
      $scope.isedit = false;
      $scope.isadmin = false;
    }
  }
  //EVALUATE WHEN A CREATE IS VISIBLE
  $scope.evaluateCreate = function() {
    return $scope.iscreate;
  };
  //EVALUATE WHEN A ROW IS VISIBLE
  $scope.evaluateEdit = function(index) {
    return index == $scope.rowvisible && $scope.isedit;
  };
  //EVALUATE WHEN A ROW IS VISIBLE
  $scope.evaluateAdmin = function(index) {
    return index == $scope.rowvisible && $scope.isadmin;
  };
  //CHANGE ALL DETAIL CHECK BOXES - SINCE SELECT ALL CHECK
  $scope.changeall = function(){
    angular.forEach($scope.categorias, function(cat) {
      cat.Exist = $scope.selall.Selected ? "true" : "false";
    });
  };
  //CHECK AFTER LOAD CATS TO SET SELECT ALL CHECK
  $scope.selectedall = function(){
    angular.forEach($scope.categorias, function(cat) {
      if(cat.Exist == "false") $scope.selall.Selected = false;
    });
  };
  //TRIGGER BY CHECK DETAIL TO UNCHECK SELECT ALL CHECK
  $scope.unselectall = function(cat){
    if(!(cat.Exist=="true") && $scope.selall.Selected)
      $scope.selall.Selected = false;
  };
  //SAVE ALL CATS BY USER
  $scope.savecats = function(){
    $scope.arrcategorias = {'categorias_list':$scope.categorias,'PK_Usuario':$scope.usuario.PK_Usuario};
    UsuariosService.savecats($scope.arrcategorias).then(function(d) {
      $scope.rowvisible = -1;
      dialogs.notify('Información','Privilegios Actualizados: '+$scope.usuario.UserName,{'windowClass':'center-modal'});
    }, function (error)
    {
      console.info('Error ');
      dialogs.error('Error',error.data,{'windowClass':'center-modal'})
    });
  };

  // LOAD DATA
  $scope.refresh();
})
.directive("passwordVerify", function() {
   return {
      require: "ngModel",
      scope: {
        passwordVerify: '='
      },
      link: function(scope, element, attrs, ctrl) {
        scope.$watch(function() {
            var combined;

            if (scope.passwordVerify || ctrl.$viewValue) {
               combined = scope.passwordVerify + '_' + ctrl.$viewValue;
            }
            return combined;
        }, function(value) {
            if (value) {
                ctrl.$parsers.unshift(function(viewValue) {
                    var origin = scope.passwordVerify;
                    if (origin !== viewValue) {
                        ctrl.$setValidity("passwordVerify", false);
                        return undefined;
                    } else {
                        ctrl.$setValidity("passwordVerify", true);
                        return viewValue;
                    }
                });
            }
        });
     }
   }
 });
;
