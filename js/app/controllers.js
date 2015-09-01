angular.module('Controllers', [])

.controller('Categoriasv2Controller', function($scope, $http, $location, dialogs) {

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
            dialogs.notify('Información','Categoría Creada: '+result.Clave,{'windowClass':'center-modal'});
          }
          else dialogs.notify('Información','Categoría Actualizada: '+result.Clave,{'windowClass':'center-modal'});

          $scope.categoria = angular.copy($scope.new_categoria);
          $scope.skyform.$setPristine();
          console.info("save->" + response.data.op);
        } else {
          // ver que pedo con los response.data.errors
        }

      }, function (error)
      {
        console.info('Error ');
        dialogs.error('Error',error.data,{'windowClass':'center-modal'})
      });
    }
    //DELETE
  $scope.delete = function(categoria) {
    console.info(categoria.Clave);
    var dlg = dialogs.confirm('Por favor Confirme','¿Desea Eliminar la Categoría: '+categoria.Clave+'?',{'windowClass':'center-modal'});
    dlg.result.then(function(btn){
      $http.post('categorias_controller/delete_categoria', categoria).then(function(response) {

        console.log(response);

        if (response.data.op) {
          var result = response.data.result;
          for (i in $scope.list_categoria) {
            if ($scope.list_categoria[i].PK_Categoria == result.PK_Categoria) {
              $scope.list_categoria.splice(i, 1);
            }
          }
          dialogs.notify('Información','Categoría Eliminada: '+categoria.Clave,{'windowClass':'center-modal'});
        } else {
          console.error(response.data);
          // ver que pedo con los response.data.errors
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

  // LOAD DATA
  $scope.refresh();

})
.service('ContenidosService', function($location, $http, $q){

  this.delete = function(id) {
    return $http.post('contenidos_controller/delete_contenido', id);
  };

  this.delete_archivo = function(archivo) {
    return $http.post('contenidos_controller/delete_archivo', archivo);
  };

  this.get_model = function() {

    console.info($location.path());

    return $http.get('contenidos_controller/get_model');
  };

  this.get_contenidos_traducciones = function(filter) {
    return $http.post('contenidos_controller/get_contenidos_traducciones', filter);
  };

  this.save = function(contenido) {
    console.info('ContenidosService:call->save');
    console.info(contenido);
    //return true;
    return $http.post('contenidos_controller/save_contenido', contenido);
  };

  this.audiosById  = function(categoria) {
    console.info('ContenidosService:call->audiosById');
    console.info(categoria);
    return $http.post('contenidos_controller/get_archivosById', categoria);
  };

  this.favorito = function(contenido)
  {
    return $http.post('contenidos_controller/favorito', contenido);
  }

})
.controller('ContenidosController', function(
  $scope, $rootScope, $http, $location, $fancyModal, $log, ContenidosService, $upload, $anchorScroll, dialogs, AuthService) {

  $scope.list_categoria = {};
  $scope.selected_categoria = {};
  $scope.contenidos_traducciones = {};
  $scope.new_contenido = {};
  //-- upload vars
  $scope.selected_categoria_files = [];
  $scope.progress = 0;
  $scope.progressArray = [];
  $scope.uploadedArray = [];
  $scope.uploadedSycArray = [];
  $scope.rowvisible = -1;
  $scope.selectedAudios = [];
  //--/upload vars
  $scope.currentPage = 1;
  $scope.pageSize = 5;

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

      $scope.gotoAnchor('New');
    };
    //SAVE
  $scope.save = function() {

      console.info('ContenidosController:call->save');
      ContenidosService.save($scope.selected_categoria).then(function(response) {

        console.info('response.data->ini');
        if (response.data.op) {
          var result = response.data.Traduccion;
          var insert = true;

          for (var i in $scope.contenidos_traducciones) {
            if ($scope.contenidos_traducciones[i].PK_Contenido === result[0].PK_Contenido &&
              $scope.contenidos_traducciones[i].PK_Idioma === result[0].PK_Idioma) {
              $scope.contenidos_traducciones[i] = result[0];
              insert = false;
            }
          }
          if(insert){
            for (var t in result) {
              $scope.contenidos_traducciones.push(result[t]);
            }
            dialogs.notify('Información','Contenido Creado: '+$scope.selected_categoria.list_idioma[0].titulo,{'windowClass':'center-modal'});
          }
          else dialogs.notify('Información','Contenido Actualizado: '+$scope.selected_categoria.list_idioma[0].titulo,{'windowClass':'center-modal'});
          //$scope.categoria = angular.copy($scope.new_categoria);
          $scope.selected_categoria = {}; //?que pedo si o no?
          $scope.skyform.$setPristine();
          console.info("save->" + response.data.op);
        } else {
          // ver que pedo con los response.data.errors
        }
      }, function (error)
      {
        console.info('Error ');
        dialogs.error('Error',error.data,{'windowClass':'center-modal'})
      });

    }
    //DELETE
  $scope.delete = function(c) {
    var dlg = dialogs.confirm('Por favor Confirme','¿Desea Eliminar el Contenido: '+c.Titulo+'?',{'windowClass':'center-modal'});
    dlg.result.then(function(btn){
      ContenidosService.delete(c.PK_Contenido).then(function(response) {
        if (response.data.op) {
          var result = response.data.result;
          for (var i in $scope.contenidos_traducciones) {
            if ($scope.contenidos_traducciones[i].PK_Contenido == result.PK_Contenido) {
              $scope.contenidos_traducciones.splice(i, 1);
            }
          }
          dialogs.notify('Información','Contenido Eliminado: '+c.Titulo,{'windowClass':'center-modal'});
        } else {
          // ver que pedo con los response.data.errors
        }
      }, function (error)
      {
        console.info('Error ');
        dialogs.error('Error',error.data,{'windowClass':'center-modal'})
      });
    }, function (btn)
    {

    });
  };

  $scope.delete_archivo = function(c) {
    var dlg = dialogs.confirm('Por favor Confirme','¿Desea Eliminar el Archivo: '+c.Descripcion+'?',{'windowClass':'center-modal'});
    dlg.result.then(function(btn){
      ContenidosService.delete_archivo(c).then(function(response) {
        if (response.data.op) {
          var result = response.data.result;
          for (var i in $scope.selectedAudios) {
            if ($scope.selectedAudios[i].PK_Archivo == result.PK_Archivo) {
              $scope.selectedAudios.splice(i, 1);
            }
          }
          dialogs.notify('Información','Archivo Eliminado: '+c.Descripcion,{'windowClass':'center-modal'});
        } else {
          // ver que pedo con los response.data.errors
        }
      }, function (error)
      {
        console.info('Error ');
        dialogs.error('Error',error.data,{'windowClass':'center-modal'})
      });
    }, function (btn)
    {

    });
  };
    //REFRESH
  $scope.refresh = function() {

    ContenidosService.get_model().then(function(d) {

      $scope.list_categoria = angular.copy(d.data.list_categoria);
      $scope.new_contenido = angular.copy(d.data.new_contenido);
      $scope.selected_categoria = {};

      if ($scope.skyform != undefined)
        $scope.skyform.$setPristine();

    });
    var $params = {};
    $params['IsAdmin'] = AuthService.isAuthAdmin();
    $params['ListFilters'] = $rootScope.ListFilters;
    $params['PK_Usuario'] = $rootScope.PK_Usuario;
    $params['IsFavoritos'] = $rootScope.IsFavoritos;
    ContenidosService.get_contenidos_traducciones($params).then(function(d) {
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


  $scope.$on('clear' , function(e , file)
  {
    console.info('$scope.files' , $scope.files);
    console.info('clear' , file);
    $scope.files.splice($scope.files.indexOf(file), 1);
  });

  $scope.$watch('files' , function() {

    console.info('watch');

  }, true);

  $scope.upload = function(files) {

    console.info('$scope.files' , $scope.files);
    $scope.files = files;
    if (files.length > 0) {

      for (var i = 0; i < files.length; i++) {
        var file = files[i];
        file.progress = 0;
        $scope.progressArray.push(file);

        $upload.upload({
          url: 'contenidos_controller/upload',
          fields: {
            'FK_Contenido': $scope.selected_categoria_files.PK_Contenido,
						'FK_Idioma': $scope.selected_categoria_files.list_idioma[0].FK_Idioma,
            'Descripcion': file.descripcion
          },
          file: file
        }).progress(function(evt) {
          var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
          console.log('i:' + $scope.progressArray.indexOf(evt.config.file) + ' / progress: ' + progressPercentage + '% ' + evt.config.file.name);
          $scope.progress = progressPercentage;
          $scope.progressArray[$scope.progressArray.indexOf(evt.config.file)].progress = progressPercentage;
        }).success(function(data, status, headers, config) {
					// regreso respuesta sobre upload, aun no confirmamos si subio
					// console.log('i:' + i );
          // console.log(config.file.name);
          // console.log('data->');
          // console.log(data);

          var r = {
            PK_Archivo: data.op,
            Nombre : data.File_Name,
            Descripcion: data.Descripcion,
            FK_Idioma : data.FK_Idioma,
            FK_Contenido : data.PK_Contenido,
          };

          $scope.progress = 0;
          $scope.uploadedArray.push(data);
          $scope.uploadedSycArray.push(r);
          $scope.selectedAudios.push(r);

          $scope.$emit('clear' , config.file);

        });
      }

    }
    //vaciamos files



  };

  //-------------- ROW CONTROLLER
  $scope.detalle = function(c, index) {

    this.clearArrays();

    $scope.selected_categoria_files = {
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

    $scope.rowvisible = $scope.rowvisible === index ? -1 : index;

    if($scope.rowvisible !== -1){
      ContenidosService.audiosById(c).then(function(d) {
        console.log("ContenidosService.audiosById->");
        //console.log(d);
        $scope.selectedAudios = d.data.result;
      });
    }
    //$scope.usuariosel = usuario.PK_Usuario;
  };

  $scope.evaluate = function(index) {
    return index === $scope.rowvisible;
  };

  $scope.clearArrays = function(){
    $scope.progressArray = [];
    $scope.selectedAudios = [];
    $scope.selected_categoria = [];
    $scope.selected_categoria_files = [];
    $scope.uploadedArray = [];
    $scope.uploadedSycArray = [];
    console.log('clearArrays->done');
  };
  $scope.removeFilter = function(filter) {
      $rootScope.ListFilters.splice($rootScope.ListFilters.indexOf(filter), 1);
  };
  $rootScope.$watchCollection('ListFilters', function(newVal) {
       $scope.refresh();
   });

  $scope.myprep = function(contenido){
    console.info('Favoritos '+contenido.PK_Contenido);
    var params = {'FK_Contenido':contenido.PK_Contenido,'FK_Usuario':$rootScope.PK_Usuario};
    ContenidosService.favorito(params).then(function(response) {
      contenido.FK_Contenido = response.data['op'];

    }, function (error)
    {
      console.info('Error ');
      dialogs.error('Error',error.data,{'windowClass':'center-modal'})
    });
  }

  $scope.pageChangeHandler = function(num) {
      console.log('Contenidos page changed to ' + num);
  };

  $scope.gotoAnchor = function(x) {
    var newHash = 'Contenidos' + x;
    $location.hash('');
    if ($location.hash() !== newHash) {
      $location.hash('Contenidos' + x);
      $anchorScroll();
    } else {
      $anchorScroll();
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
.service('IdiomasService', function ($location,$http,$q, dialogs) {
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
.controller('IdiomasController',function($scope,$http,$location,IdiomasService, dialogs){

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
				if(insert)
        {
          $scope.idiomas.push(result);
          dialogs.notify('Información','Idioma Creado: '+result.Nombre,{'windowClass':'center-modal'});
        }
        else dialogs.notify('Información','Idioma Actualizado: '+result.Nombre,{'windowClass':'center-modal'});
				$scope.idioma = {};
				$scope.skyform.$setPristine();
			} else {
				// ver que pedo con los response.data.errors
			}
		}
    , function (error)
    {
      console.info('Error ');
      dialogs.error('Error',error.data,{'windowClass':'center-modal'})
    });
	}
	//DELETE
	$scope.delete = function (idioma) {
    var dlg = dialogs.confirm('Por favor Confirme','¿Desea Eliminar el Idioma: '+idioma.Nombre+'?',{'windowClass':'center-modal'});
    dlg.result.then(function(btn){
      IdiomasService.delete(idioma.PK_Idioma).then(function(response){
        if(response.data.op)
        {
          var result = response.data.result;
          for (i in $scope.idiomas) {
            if ($scope.idiomas[i].PK_Idioma == result.PK_Idioma) {
                      $scope.idiomas.splice(i, 1);
                  }
          }
          dialogs.notify('Información','Idioma Eliminado: '+usuario.Nombre,{'windowClass':'center-modal'});
        } else {
          // ver que pedo con los response.data.errors
        }
      }
      , function (error)
      {
        console.info('Error ');
        dialogs.error('Error',error.data,{'windowClass':'center-modal'})
      });
	  }, function (btn)
    {

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
      console.info('Saved ',response.data);
      var result = response.data.result;
      if(response.data.op)
      {
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
        dialogs.notify('Información','Nombre de Usuario ya existente.',{'windowClass':'center-modal'});
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
    var arrcategorias = {'categorias_list':$scope.categorias,'PK_Usuario':$scope.usuario.PK_Usuario};
    UsuariosService.savecats(arrcategorias).then(function(d) {
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
.service('LoginService', function($location, $http, $q) {
  //SELECT ----------------------------------------------------------------- USUARIOS
  this.validaUsuario = function(params) {
    return $http.post('adminpanel_controller/valida_usuarios', params);
  };
})
.controller('LoginController', function($rootScope, $scope, $location, $http, $anchorScroll, $location, dialogs, LoginService, uuid2, MegaMenuService) {

  console.info('ini->LoginController');

  $scope.validauser = function(){
    $scope.userarr = {'user':$scope.usuario.user,'pass':$scope.usuario.pass};
    LoginService.validaUsuario($scope.userarr).then(function(response) {
      $rootScope.uuid = null;
      if(response.data.op['op'] == 0)
      {
        $rootScope.uuid = uuid2.newuuid();
        $rootScope.TypeUser = response.data.op['EsAdmin'];
        $rootScope.PK_Usuario = response.data.op['PK_Usuario'];
        if($rootScope.TypeUser) $location.path('Dashboard');
        else $location.path('ContenidosUs');

        MegaMenuService.prepForBroadcast(response.data.op['menu']);
      }
      else if(response.data.op['op'] == 1) dialogs.notify('Información','Usuario o Contraseña Invalida: '+$scope.usuario.user,{'windowClass':'center-modal'});if(response.data == 0) dialogs.notify('Información','Usuario Valido: '+$scope.usuario.user,{'windowClass':'center-modal'});
      else if(response.data.op['op'] == 2) dialogs.notify('Información','Usuario Inactivo: '+$scope.usuario.user,{'windowClass':'center-modal'});if(response.data == 0) dialogs.notify('Información','Usuario Valido: '+$scope.usuario.user,{'windowClass':'center-modal'});

    }, function (error)
    {
      console.info('Error ');
      dialogs.error('Error',error.data,{'windowClass':'center-modal'})
    });
  }

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
   };
 });
