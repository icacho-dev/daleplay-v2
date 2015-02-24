<!-- content area -->
<div class="content_fullwidth less2" ng-controller="CategoriasController">
    
    <div class="container">
        <div class="one_half animate" data-anim-type="fadeInLeft">
            
            <div class="reg_form">
                <?php 
                      $attributes = array('class' => 'sky-form', 'id' => 'sky-form');
                      //echo form_open('admin/categorias_controller/save_categorias',$attributes); ?>
                <form method="post" 
                accept-charset="utf-8" class="sky-form ng-pristine ng-invalid ng-invalid-required" 
                id="sky-form"> 
                <header>Agregar categoria</header>
                                     
                <fieldset>                  
                    <section>
                        <label class="input">
                            <i class="icon-append {{ (categoria.Icono!='')?categoria.Icono :'fa-newspaper-o'}}"></i>
                            <?php echo form_input(array('id' => 'dNombre', 'name' => 'dNombre', 'placeholder'=>'Nombre', 'ng-model'=>'categoria.Nombre', 'required'=>'required')); ?>                    
                        </label><?php echo form_error('dNombre'); ?>
                    </section>
					
                    <section>
                    	<label class="select">
							<select name="dIcono" id="dIcono" ng-model="categoria.Icono">
							    <optgroup label="Web Application Icons">
							        <option value="fa-adjust">fa-adjust</option>
							        <option value="fa-asterisk">fa-asterisk</option>
							        <option value="fa-ban-circle">fa-ban-circle</option>
							        <option value="fa-bar-chart">fa-bar-chart</option>
							        <option value="fa-barcode">fa-barcode</option>
							        <option value="fa-beaker">fa-beaker</option>
							        <option value="fa-beer">fa-beer</option>
							        <option value="fa-bell">fa-bell</option>
							        <option value="fa-bell-alt">fa-bell-alt</option>
							        <option value="fa-bolt">fa-bolt</option>
							        <option value="fa-book">fa-book</option>
							        <option value="fa-bookmark">fa-bookmark</option>
							        <option value="fa-bookmark-empty">fa-bookmark-empty</option>
							        <option value="fa-briefcase">fa-briefcase</option>
							        <option value="fa-bullhorn">fa-bullhorn</option>
							        <option value="fa-calendar">fa-calendar</option>
							        <option value="fa-camera">fa-camera</option>
							        <option value="fa-camera-retro">fa-camera-retro</option>
							        <option value="fa-certificate">fa-certificate</option>
							        <option value="fa-check">fa-check</option>
							        <option value="fa-check-empty">fa-check-empty</option>
							        <option value="fa-circle">fa-circle</option>
							        <option value="fa-circle-blank">fa-circle-blank</option>
							        <option value="fa-cloud">fa-cloud</option>
							        <option value="fa-cloud-download">fa-cloud-download</option>
							        <option value="fa-cloud-upload">fa-cloud-upload</option>
							        <option value="fa-coffee">fa-coffee</option>
							        <option value="fa-cog">fa-cog</option>
							        <option value="fa-cogs">fa-cogs</option>
							        <option value="fa-comment">fa-comment</option>
							        <option value="fa-comment-alt">fa-comment-alt</option>
							        <option value="fa-comments">fa-comments</option>
							        <option value="fa-comments-alt">fa-comments-alt</option>
							        <option value="fa-credit-card">fa-credit-card</option>
							        <option value="fa-dashboard">fa-dashboard</option>
							        <option value="fa-desktop">fa-desktop</option>
							        <option value="fa-download">fa-download</option>
							        <option value="fa-download-alt">fa-download-alt</option>
							        <option value="fa-edit">fa-edit</option>
							        <option value="fa-envelope">fa-envelope</option>
							        <option value="fa-envelope-alt">fa-envelope-alt</option>
							        <option value="fa-exchange">fa-exchange</option>
							        <option value="fa-exclamation-sign">fa-exclamation-sign</option>
							        <option value="fa-external-link">fa-external-link</option>
							        <option value="fa-eye-close">fa-eye-close</option>
							        <option value="fa-eye-open">fa-eye-open</option>
							        <option value="fa-facetime-video">fa-facetime-video</option>
							        <option value="fa-fighter-jet">fa-fighter-jet</option>
							        <option value="fa-film">fa-film</option>
							        <option value="fa-filter">fa-filter</option>
							        <option value="fa-fire">fa-fire</option>
							        <option value="fa-flag">fa-flag</option>
							        <option value="fa-folder-close">fa-folder-close</option>
							        <option value="fa-folder-open">fa-folder-open</option>
							        <option value="fa-folder-close-alt">fa-folder-close-alt</option>
							        <option value="fa-folder-open-alt">fa-folder-open-alt</option>
							        <option value="fa-food">fa-food</option>
							        <option value="fa-gift">fa-gift</option>
							        <option value="fa-glass">fa-glass</option>
							        <option value="fa-globe">fa-globe</option>
							        <option value="fa-group">fa-group</option>
							        <option value="fa-hdd">fa-hdd</option>
							        <option value="fa-headphones">fa-headphones</option>
							        <option value="fa-heart">fa-heart</option>
							        <option value="fa-heart-empty">fa-heart-empty</option>
							        <option value="fa-home">fa-home</option>
							        <option value="fa-inbox">fa-inbox</option>
							        <option value="fa-info-sign">fa-info-sign</option>
							        <option value="fa-key">fa-key</option>
							        <option value="fa-leaf">fa-leaf</option>
							        <option value="fa-laptop">fa-laptop</option>
							        <option value="fa-legal">fa-legal</option>
							        <option value="fa-lemon">fa-lemon</option>
							        <option value="fa-lightbulb">fa-lightbulb</option>
							        <option value="fa-lock">fa-lock</option>
							        <option value="fa-unlock">fa-unlock</option>
							        <option value="fa-magic">fa-magic</option>
							        <option value="fa-magnet">fa-magnet</option>
							        <option value="fa-map-marker">fa-map-marker</option>
							        <option value="fa-minus">fa-minus</option>
							        <option value="fa-minus-sign">fa-minus-sign</option>
							        <option value="fa-mobile-phone">fa-mobile-phone</option>
							        <option value="fa-money">fa-money</option>
							        <option value="fa-move">fa-move</option>
							        <option value="fa-music">fa-music</option>
							        <option value="fa-off">fa-off</option>
							        <option value="fa-ok">fa-ok</option>
							        <option value="fa-ok-circle">fa-ok-circle</option>
							        <option value="fa-ok-sign">fa-ok-sign</option>
							        <option value="fa-pencil">fa-pencil</option>
							        <option value="fa-picture">fa-picture</option>
							        <option value="fa-plane">fa-plane</option>
							        <option value="fa-plus">fa-plus</option>
							        <option value="fa-plus-sign">fa-plus-sign</option>
							        <option value="fa-print">fa-print</option>
							        <option value="fa-pushpin">fa-pushpin</option>
							        <option value="fa-qrcode">fa-qrcode</option>
							        <option value="fa-question-sign">fa-question-sign</option>
							        <option value="fa-quote-left">fa-quote-left</option>
							        <option value="fa-quote-right">fa-quote-right</option>
							        <option value="fa-random">fa-random</option>
							        <option value="fa-refresh">fa-refresh</option>
							        <option value="fa-remove">fa-remove</option>
							        <option value="fa-remove-circle">fa-remove-circle</option>
							        <option value="fa-remove-sign">fa-remove-sign</option>
							        <option value="fa-reorder">fa-reorder</option>
							        <option value="fa-reply">fa-reply</option>
							        <option value="fa-resize-horizontal">fa-resize-horizontal</option>
							        <option value="fa-resize-vertical">fa-resize-vertical</option>
							        <option value="fa-retweet">fa-retweet</option>
							        <option value="fa-road">fa-road</option>
							        <option value="fa-rss">fa-rss</option>
							        <option value="fa-screenshot">fa-screenshot</option>
							        <option value="fa-search">fa-search</option>
							        <option value="fa-share">fa-share</option>
							        <option value="fa-share-alt">fa-share-alt</option>
							        <option value="fa-shopping-cart">fa-shopping-cart</option>
							        <option value="fa-signal">fa-signal</option>
							        <option value="fa-signin">fa-signin</option>
							        <option value="fa-signout">fa-signout</option>
							        <option value="fa-sitemap">fa-sitemap</option>
							        <option value="fa-sort">fa-sort</option>
							        <option value="fa-sort-down">fa-sort-down</option>
							        <option value="fa-sort-up">fa-sort-up</option>
							        <option value="fa-spinner">fa-spinner</option>
							        <option value="fa-star">fa-star</option>
							        <option value="fa-star-empty">fa-star-empty</option>
							        <option value="fa-star-half">fa-star-half</option>
							        <option value="fa-tablet">fa-tablet</option>
							        <option value="fa-tag">fa-tag</option>
							        <option value="fa-tags">fa-tags</option>
							        <option value="fa-tasks">fa-tasks</option>
							        <option value="fa-thumbs-down">fa-thumbs-down</option>
							        <option value="fa-thumbs-up">fa-thumbs-up</option>
							        <option value="fa-time">fa-time</option>
							        <option value="fa-tint">fa-tint</option>
							        <option value="fa-trash">fa-trash</option>
							        <option value="fa-trophy">fa-trophy</option>
							        <option value="fa-truck">fa-truck</option>
							        <option value="fa-umbrella">fa-umbrella</option>
							        <option value="fa-upload">fa-upload</option>
							        <option value="fa-upload-alt">fa-upload-alt</option>
							        <option value="fa-user">fa-user</option>
							        <option value="fa-user-md">fa-user-md</option>
							        <option value="fa-volume-off">fa-volume-off</option>
							        <option value="fa-volume-down">fa-volume-down</option>
							        <option value="fa-volume-up">fa-volume-up</option>
							        <option value="fa-warning-sign">fa-warning-sign</option>
							        <option value="fa-wrench">fa-wrench</option>
							        <option value="fa-zoom-in">fa-zoom-in</option>
							        <option value="fa-zoom-out">fa-zoom-out</option>
							    <optgroup label="Text Editor Icons">
							        <option value="fa-file">fa-file</option>
							        <option value="fa-file-alt">fa-file-alt</option>
							        <option value="fa-cut">fa-cut</option>
							        <option value="fa-copy">fa-copy</option>
							        <option value="fa-paste">fa-paste</option>
							        <option value="fa-save">fa-save</option>
							        <option value="fa-undo">fa-undo</option>
							        <option value="fa-repeat">fa-repeat</option>
							        <option value="fa-text-height">fa-text-height</option>
							        <option value="fa-text-width">fa-text-width</option>
							        <option value="fa-align-left">fa-align-left</option>
							        <option value="fa-align-center">fa-align-center</option>
							        <option value="fa-align-right">fa-align-right</option>
							        <option value="fa-align-justify">fa-align-justify</option>
							        <option value="fa-indent-left">fa-indent-left</option>
							        <option value="fa-indent-right">fa-indent-right</option>
							        <option value="fa-font">fa-font</option>
							        <option value="fa-bold">fa-bold</option>
							        <option value="fa-italic">fa-italic</option>
							        <option value="fa-strikethrough">fa-strikethrough</option>
							        <option value="fa-underline">fa-underline</option>
							        <option value="fa-link">fa-link</option>
							        <option value="fa-paper-clip">fa-paper-clip</option>
							        <option value="fa-columns">fa-columns</option>
							        <option value="fa-table">fa-table</option>
							        <option value="fa-th-large">fa-th-large</option>
							        <option value="fa-th">fa-th</option>
							        <option value="fa-th-list">fa-th-list</option>
							        <option value="fa-list">fa-list</option>
							        <option value="fa-list-ol">fa-list-ol</option>
							        <option value="fa-list-ul">fa-list-ul</option>
							        <option value="fa-list-alt">fa-list-alt</option>
							    <optgroup label="Directional Icons">
							        <option value="fa-angle-left">fa-angle-left</option>
							        <option value="fa-angle-right">fa-angle-right</option>
							        <option value="fa-angle-up">fa-angle-up</option>
							        <option value="fa-angle-down">fa-angle-down</option>
							        <option value="fa-arrow-down">fa-arrow-down</option>
							        <option value="fa-arrow-left">fa-arrow-left</option>
							        <option value="fa-arrow-right">fa-arrow-right</option>
							        <option value="fa-arrow-up">fa-arrow-up</option>
							        <option value="fa-caret-down">fa-caret-down</option>
							        <option value="fa-caret-left">fa-caret-left</option>
							        <option value="fa-caret-right">fa-caret-right</option>
							        <option value="fa-caret-up">fa-caret-up</option>
							        <option value="fa-chevron-down">fa-chevron-down</option>
							        <option value="fa-chevron-left">fa-chevron-left</option>
							        <option value="fa-chevron-right">fa-chevron-right</option>
							        <option value="fa-chevron-up">fa-chevron-up</option>
							        <option value="fa-circle-arrow-down">fa-circle-arrow-down</option>
							        <option value="fa-circle-arrow-left">fa-circle-arrow-left</option>
							        <option value="fa-circle-arrow-right">fa-circle-arrow-right</option>
							        <option value="fa-circle-arrow-up">fa-circle-arrow-up</option>
							        <option value="fa-double-angle-left">fa-double-angle-left</option>
							        <option value="fa-double-angle-right">fa-double-angle-right</option>
							        <option value="fa-double-angle-up">fa-double-angle-up</option>
							        <option value="fa-double-angle-down">fa-double-angle-down</option>
							        <option value="fa-hand-down">fa-hand-down</option>
							        <option value="fa-hand-left">fa-hand-left</option>
							        <option value="fa-hand-right">fa-hand-right</option>
							        <option value="fa-hand-up">fa-hand-up</option>
							        <option value="fa-circle">fa-circle</option>
							        <option value="fa-circle-blank">fa-circle-blank</option>
							    <optgroup label="Video Player Icons">
							        <option value="fa-play-circle">fa-play-circle</option>
							        <option value="fa-play">fa-play</option>
							        <option value="fa-pause">fa-pause</option>
							        <option value="fa-stop">fa-stop</option>
							        <option value="fa-step-backward">fa-step-backward</option>
							        <option value="fa-fast-backward">fa-fast-backward</option>
							        <option value="fa-backward">fa-backward</option>
							        <option value="fa-forward">fa-forward</option>
							        <option value="fa-fast-forward">fa-fast-forward</option>
							        <option value="fa-step-forward">fa-step-forward</option>
							        <option value="fa-eject">fa-eject</option>
							        <option value="fa-fullscreen">fa-fullscreen</option>
							        <option value="fa-resize-full">fa-resize-full</option>
							        <option value="fa-resize-small">fa-resize-small</option>
							    <optgroup label="Social Icons">
							        <option value="fa-phone">fa-phone</option>
							        <option value="fa-phone-sign">fa-phone-sign</option>
							        <option value="fa-facebook">fa-facebook</option>
							        <option value="fa-facebook-sign">fa-facebook-sign</option>
							        <option value="fa-twitter">fa-twitter</option>
							        <option value="fa-twitter-sign">fa-twitter-sign</option>
							        <option value="fa-github">fa-github</option>
							        <option value="fa-github-alt">fa-github-alt</option>
							        <option value="fa-github-sign">fa-github-sign</option>
							        <option value="fa-linkedin">fa-linkedin</option>
							        <option value="fa-linkedin-sign">fa-linkedin-sign</option>
							        <option value="fa-pinterest">fa-pinterest</option>
							        <option value="fa-pinterest-sign">fa-pinterest-sign</option>
							        <option value="fa-google-plus">fa-google-plus</option>
							        <option value="fa-google-plus-sign">fa-google-plus-sign</option>
							        <option value="fa-sign-blank">fa-sign-blank</option>
							    <optgroup label="Medical Icons">
							        <option value="fa-ambulance">fa-ambulance</option>
							        <option value="fa-beaker">fa-beaker</option>
							        <option value="fa-h-sign">fa-h-sign</option>
							        <option value="fa-hospital">fa-hospital</option>
							        <option value="fa-medkit">fa-medkit</option>
							        <option value="fa-plus-sign-alt">fa-plus-sign-alt</option>
							        <option value="fa-stethoscope">fa-stethoscope</option>
							        <option value="fa-user-md">fa-user-md</option>
							</select>
							<i></i>
						</label>
                        <!--
                    	<label class="input">
                            <i class="icon-append fa-star-o"></i>
                            <?php echo form_input(array('id' => 'dIcono', 'name' => 'dIcono', 'placeholder'=>'Icono', 'value'=>'fa-plus-square', 'ng-model'=>'categoria.dIcono', 'required'=>'required')); ?>       
                        </label>
                        <?php echo form_hidden(array('id' => 'dPK_IdCategoria', 'name' => 'dPK_IdCategoria', 'ng-model'=>'categoria.dPK_IdCategoria')); ?>
                        -->
                    </section>                    
                </fieldset>                
                <footer>
                    <button type="button" class="button" ng-click="save()">Guardar</button>
                    <button type="button" class="button" ng-click="refresh()">Cancelar</button>            
                </footer>
                <?php echo form_close(); ?>                
            </div>			
			
        </div>
        <div class="one_half last">
            <?php
            /*
            $tmpl = array (
                    'table_open'          => '<table border="0" cellpadding="4" cellspacing="0" class="table animate" data-anim-type="fadeInRight">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th>',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td class="alicent">',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td class="alicent">',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table>'
              ); 

			$this->table->set_template($tmpl); 
			$this->table->set_heading('Id', 'Nombre', 'Icono');
            echo $this->table->generate($categorias);
			*/ 
			
            ?>            
            <table border="0" cellpadding="4" cellspacing="0" class="table animate" data-anim-type="fadeInRight">
		        <thead>
		        	
		            <tr>
		                <th>ID</th>
		                <th>Nombre</th> 
		                <th>Icono</th>
		                <th>Action</th>
		            </tr> 
		        </thead>
		        <tbody>
		            <tr ng-repeat="categoria in categorias">
		                <td class="alicent">{{ categoria.PK_IdCategoria }}</td>
		                <td>{{ categoria.Nombre }}</td>
		                <td><i class="fa {{ categoria.Icono }}"></i> {{ categoria.Icono }}</td>
		                <td class="alicent"> <a href="javascript:void(0)" ng-click="edit(categoria)">edit</a> | <a href="javascript:void(0)" ng-click="delete(categoria)">delete</a>
		
		                </td>
		            </tr>
		        </tbody>
		    </table>
		    <pre>categoria:{{categoria}}</pre>
		    <pre>cat:{{categorias}}</pre>
        </div>
    	        

    </div>

</div><!-- ./content area -->
<div class="clearfix"></div>