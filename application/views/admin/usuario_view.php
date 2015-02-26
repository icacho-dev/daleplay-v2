<!-- content area -->
<div class="content_fullwidth less2" ng-controller="UsuariosController">

    <div class="container">
        <div class="one_half" >

            <div class="dp_form1">
                <form
                accept-charset="utf-8"
                class="sky-form" id="sky-form" name="skyform"
                ng-submit="save()">
                <header>Agregar <strong>Usuario</strong></header>

                <fieldset>
                    <section>
                        <label class="input">
                            <i class="icon-append fa-key"></i>
                            <?php echo form_input(array('id' => 'dUsuario', 'name' => 'dUsuario', 'placeholder'=>'Usuario', 'ng-model'=>'usuario.UserName', 'required'=>'required')); ?>
                        </label><?php echo form_error('dUsuario'); ?>
                    </section>

                    <section>
                        <label class="input">
                            <i class="icon-append fa-globe"></i>
                            <?php echo form_input(array('id' => 'dPassword', 'name' => 'dPassword', 'placeholder'=>'Password', 'ng-model'=>'usuario.Password', 'required'=>'required')); ?>
                        </label><?php echo form_error('dUsuario'); ?>
                    </section>

                    <section>
                    	<label class="input">
                    		<i class="icon-append fa-globe"></i>
							                 <?php echo form_input(array('id' => 'dEmail', 'name' => 'dEmail', 'placeholder'=>'Email', 'ng-model'=>'usuario.Email', 'required'=>'required')); ?>

          							<i></i>
          						</label>
                    </section>

                    <section>
                    	<label class="input">
                    		<i class="icon-append fa-globe"></i>
							                 <?php echo form_input(array('id' => 'dTelefono', 'name' => 'dTelefono', 'placeholder'=>'Teléfono', 'ng-model'=>'usuario.Telefono')); ?>

          							<i></i>
          						</label>
                    </section>

                    <section>
                    	<label class="checkbox">
                    		<i class=""></i>
							                 <?php echo form_checkbox(array('id' => 'EsAdmin'
                                                            , 'name' => 'EsAdmin'
                                                            , 'ng-model'=>'usuario.EsAdmin'
                                                            , 'ng-true-value'=>'true'
                                                            , 'ng-false-value'=>'false')); ?>

          							<i></i>
                        Es Administrador
          						</label>
                    </section>

                </fieldset>
                <footer>
                    <button type="button" class="button button-secondary" ng-click="refresh()">Cancelar</button>
                    <input type="submit" class="button" value="Guardar"/>
                </footer>
                </form>
            </div>

        </div>
        <div class="one_half last">

            <table border="0" cellpadding="4" cellspacing="0" class="table " >
		        <thead>

		            <tr>
		                <th>Usuario</th>
		                <th>Email</th>
		                <th>Teléfono</th>
		                <th>Tipo de Usuario</th>
		                <th></th>
		            </tr>
		        </thead>
		        <tbody>
		            <tr ng-repeat="usuario in usuarios">
		                <td>{{ usuario.UserName }}<span class="dp_tinydetail">ID: {{ usuario.PK_Usuario }}</span></td>
		                <td>{{ usuario.Email }}</td>
                    <td>{{ usuario.Telefono }}</td>
                    <td><p class="dp_infolabel">{{ EsAdmin(usuario.EsAdmin) }}</p></td>
		                <td class="alicent dp_actions">
		                	<a href="javascript:void(0)" class="smlinks" ng-click="edit(usuario)"><i class="fa fa-edit"></i> Editar</a>
		                	<a href="javascript:void(0)" class="smlinks" ng-click="delete(usuario)"><i class="fa fa-trash-o"></i> Borrar</a>
		                </td>
		            </tr>
		        </tbody>
		    </table>



        </div>


    </div>

</div><!-- ./content area -->
<div class="clearfix"></div>
