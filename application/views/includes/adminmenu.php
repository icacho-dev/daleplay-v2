<div class="site_wrapper" ng-controller="DashboardController" >

<div class="clearfix"></div>

<header class="header innerpages">

    <div class="container">

    <!-- Logo -->
    <div class="logo"><a href="index.html" id="logo"></a></div>

        <!-- Navigation Menu -->

        <nav class="menu_main"  ng-if="isAdmin()">

          <div class="navbar yamm navbar-default">



      	    <div class="container">



      	      <div class="navbar-header">

      	        <div class="navbar-toggle .navbar-collapse .pull-right " data-toggle="collapse" data-target="#navbar-collapse-1"  > <span>Menu</span>

      	          <button type="button" > <i class="fa fa-bars"></i></button>

      	        </div>

      	      </div>



      	      <div id="navbar-collapse-1" class="navbar-collapse collapse pull-right">



                <ul class="nav navbar-nav">

      		        <li><a ng-click="go('Dashboard','/Dashboard')" title="Home" class="">Dashboard</a><li>

      		        <li><a ng-click="go('Categorias','/Categorias')" title="Categorias" class="">Categorias</a><li>

      		        <li><a ng-click="go('Idiomas','/Idiomas')" title="Idiomas" class="">Idiomas</a><li>

      		        <li><a ng-click="go('Contenidos','/Contenidos')" title="Contenidos" class="">Contenidos</a><li>

                  <li><a ng-click="go('Usuarios','/Usuarios')" title="Usuarios" class="">Usuarios</a><li>

      	        </ul>



      	      </div>

      	  	</div>
   	</div>
    </nav><!-- end Navigation Menu -->


    <!-- Navigation Menu -->

    <nav class="menu_main"  ng-if="isUser()">

        <div class="navbar yamm navbar-default">

  	    <div class="container">

	      <div class="navbar-header">

          <div class="navbar-toggle .navbar-collapse .pull-right " data-toggle="collapse" data-target="#navbar-collapse-1"  > <span>Menu</span>

	          <button type="button" > <i class="fa fa-bars"></i></button>

          </div>

        </div>

	      <div id="navbar-collapse-1" class="navbar-collapse collapse pull-right">

            <ul class="nav navbar-nav">

  		        <li><a ng-click="go('Dashboard','/DashboardUser')" title="Home" class="">Dashboard</a></li>

  		        <li class="dropdown yamm-fw">
                <a ng-click="goFiltered('ContenidosUs','/ContenidosUs',-1,'')" title="ContenidosUs" data-toggle="dropdown" class="dropdown-toggle">Contenidos</a>
                <ul class="dropdown-menu">
                  <li>
                    <div class="yamm-content">
                      <div class="row">
                        <ul class="col-sm-6 col-md-4 list-unstyled two" ng-repeat="menu in megamenu">
                          <li><a ng-click="goFiltered('ContenidosUs','/ContenidosUs',menu.FK_Categoria,menu.Categoria)" title="ContenidosUs" class=""><i class="fa fa-plus-square"></i>{{menu.Categoria}}</a></li>
                        </ul>
                      </div>
                    </div>
                  </li>
                </ul>
              </li>

              <li><a ng-click="go('MiShow','/MiShow')" title="MiShow" class="">MiShow</a></li>

  	        </ul>

  	      </div>

  	  	</div>
   	</div>
    </nav><!-- end Navigation Menu -->


  <div class="menu_right"><a href="/ci22/adminpanel_controller" class="buynow" ng-if="isAdmin() || isUser()">Cerrar Sesión</a></div>

  </div>

</header>

<div class="clearfix"></div>

<!-- <div class="menu_shadow">dhf</div> -->

<div class="clearfix margin_top10"></div>

<div class="page_title2">
<div class="container">
    <h1>{{this.titulo}}</h1>
    <div class="pagenation">&nbsp;<a href="/ci22/adminpanel_controller#/Dashboard">Admin Dashboard</a> <i>/</i> <a href="#/{{this.titulo}}">{{this.titulo}}</a></div>

</div>
</div>
<!-- end page title -->
<div class="clearfix"></div>