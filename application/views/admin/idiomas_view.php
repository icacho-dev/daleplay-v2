<!-- content area -->
<div class="content_fullwidth less2" ng-controller="IdiomasController">

    <div class="container">
        <div class="one_half" >

            <div class="dp_form1">
                <form
                accept-charset="utf-8"
                class="sky-form" id="sky-form" name="skyform"
                ng-submit="save()">
                <header>Agregar <strong>Idiomas</strong></header>

                <fieldset>
                    <section>
                        <label class="input">
                            <i class="icon-append fa-globe"></i>
                            <?php echo form_input(array('id' => 'dNombre', 'name' => 'dNombre', 'placeholder'=>'Nombre', 'ng-model'=>'idioma.Nombre', 'required'=>'required')); ?>
                        </label><?php echo form_error('dNombre'); ?>
                    </section>

                    <section>
                    	<label class="input">
                    		<i class="icon-append fa-key "></i>
							<?php echo form_input(array('id' => 'dClave', 'name' => 'dClave', 'placeholder'=>'Clave', 'ng-model'=>'idioma.Clave', 'required'=>'required')); ?>

							<i></i>
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
		                <th>Nombre</th>
		                <th>Clave</th>
		                <th></th>
		            </tr>
		        </thead>
		        <tbody>
		            <tr ng-repeat="idioma in idiomas">
		                <td>{{ idioma.Nombre }}<span class="dp_tinydetail">ID: {{ idioma.PK_Idioma }}</span></td>
		                <td><p class="dp_infolabel">{{ idioma.Clave }}</p></td>
		                <td class="alicent dp_actions">
		                	<a href="javascript:void(0)" class="smlinks" ng-click="edit(idioma)"><i class="fa fa-edit"></i> Editar</a>
		                	<a href="javascript:void(0)" class="smlinks" ng-click="delete(idioma)"><i class="fa fa-trash-o"></i> Borrar</a>
		                </td>
		            </tr>
		        </tbody>
		    </table>



        </div>


    </div>

</div><!-- ./content area -->
<div class="clearfix"></div>
