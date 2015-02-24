<!-- content area -->
<div class="content_fullwidth less2" ng-controller="Categoriasv2Controller">
    
    <div class="features_sec13">
    	<div class="container">    		
	        <div class="one_half">
	            
	            <div class="dp_form1">
	                	                
	                <form  accept-charset="utf-8" 
	                class="sky-form" id="skyform" name="skyform" role="form"
	                ng-submit="save(categoria)"> 
	                <header>Agregar <strong>Categoria</strong></header> 
	                
	                <fieldset >
	                    <!-- CLAVE -->						
			            <section>
			              <label class="label">Clave</label>
			              <label class="input" > <i class="icon-append icon-tag"></i>
			                <input type="text" name="Clave" id="Clave"
			                ng-model="categoria.Clave"
			                placeholder="{{categoria.Clave || 'Clave'}}"
			                required >
			              </label>			              			              
			            </section>
			            
						<!--/CLAVE -->               
	                </fieldset> 				              
	                <header>Idiomas</header>                     
	                <fieldset >
						<!-- IDIOMA.LABEL -->						
			            <section ng-repeat="idioma in categoria.list_idioma" >
			              <label class="label">{{idioma.Nombre}}</label>
			              <label class="input"> <i class="icon-append icon-globe"></i>
			                <input type="text" name="subject" id="subject"
			                ng-model="idioma.Label"
			                placeholder="{{idioma.Nombre}}">
			              </label>
			            </section>
						<!--/IDIOMA.LABEL -->               
	                </fieldset>  
	                              
	                <footer>
	                	<button type="button" class="button button-secondary" ng-click="refresh()">Cancelar</button>
	                    <input type="submit" class="button" value="Guardar"/>                                
	                </footer>
	                </form>                
	            </div>			
				
	        </div>
	        <div class="one_half last">                      
	        	
	        	<div class="table">
	        		<table border="0" cellpadding="4" cellspacing="0" class="table">
				        <thead>
				        	
				            <tr>		                
				                <th>Clave</th> 
				                <th>Etiquetas</th>
				                <th></th>
				            </tr> 
				        </thead>
				        <tbody>
				            <tr ng-repeat="categoria in list_categoria">		                
				                <td>{{ categoria.Clave }}<span class="dp_tinydetail">ID: {{ categoria.PK_Categoria }}</span></td>
				                <td>
				                	<p ng-repeat="idioma in categoria.list_idioma" ng-show="idioma.Label" class="dp_infolabel">
				                	<span class="dp_tinydetail dp_txtcolor1">Idioma: {{ idioma.Nombre }}</span>{{idioma.Label}}</p>
			                	</td>
				                <td class="alicent dp_actions">
				                	<a href="javascript:void(0)" class="smlinks" ng-click="edit(categoria)"><i class="fa fa-edit"></i> Editar</a>
				                	<a href="javascript:void(0)" class="smlinks" ng-click="delete(categoria)"><i class="fa fa-trash-o"></i> Borrar</a>		
				                </td>
				            </tr>
				        </tbody>
				    </table>	
	        	</div>
	            
	        </div>
	        
	        <div class="clearfix margin_top5"></div>
	        <!--
	        <div class="one_full">   
	        	<pre>new_categoria: {{new_categoria}}</pre>
			    <div class="clearfix margin_top5"></div>
	            <pre>categoria:{{categoria}}</pre>
			    <div class="clearfix margin_top5"></div>
			    <pre>list_categoria:{{list_categoria}}</pre>
			    <div class="clearfix margin_top5"></div>
			    <pre>list_idioma:{{list_idioma}}</pre>
	        </div>
    		-->
    	</div>
    </div>

</div><!-- ./content area -->
<div class="clearfix"></div>