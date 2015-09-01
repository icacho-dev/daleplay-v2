<!-- content area -->
<div class="content_fullwidth less2">

  <div class="container">
    <div class="one_full">

      <div class="dp_form1" id="ContenidoNew">
        <form
        accept-charset="utf-8"
        class="sky-form" id="sky-form" name="skyform"
        ng-submit="save()">
        <header>Agregar <strong>Contenidos</strong></header>

        <fieldset>
          <!-- SELECT : CATEGORIA -->
          <div class="row">
            <section class="col col-6">
              <label class="label">Categoria</label>
              <label class="select">
                <select ng-model="selected_categoria" ng-options="item.list_idioma[0].Label for item in list_categoria track by item.PK_Categoria">
                  <option value="" disabled="true">- Categoria -</option>
                </select>
                <i></i>
              </label>
            </section>
            <section class="col col-6">

            </section>
          </div>
          <!-- TEXTAREAS : TRADUCCIÓN -->

          <tabset justified="true">
            <tab ng-repeat="idioma in selected_categoria.list_idioma track by idioma.FK_Idioma" heading="{{idioma.Nombre}}" ng-if="idioma.Label">
              <section>
                <label class="label">Titulo</label>
                <label class="input" > <i class="icon-append icon-tag"></i>
                  <input type="text" name="Titulo" id="Titulo"
                  ng-model="idioma.titulo"
                  placeholder="{{idioma.titulo || 'Titulo'}}"
                  >
                </label>
              </section>
              <section>
                <label class="label">Texto</label>
                <label class="textarea"> <i class="icon-append icon-comment"></i>
                  <textarea rows="15" ng-model="idioma.traduccion"></textarea>
                </label>
              </section>

            </tab>
          </tabset>
        </fieldset>

        <footer>
          <button type="button" class="button button-secondary" ng-click="refresh()">Cancelar</button>
          <input type="submit" class="button" value="Guardar"/>
        </footer>
      </form>
    </div>

  </div>

  <div class="margin_top1"></div>
  <!--/tabs -->

  <!-- table -->

  <!-- modal -->
  <script type="text/ng-template" id="traduccion.html">
  <div class="modal-header">
  <h3 class="modal-title">{{modal.Titulo}}</h3>
  </div>
  <div class="modal-body">
  <div class="stcode_title4">
  <h3>
  <span class="line"></span>
  <span class="text">
  <span></span>
  </span>
  </h3>

  </div>
  <p class="dp_preTxt">{{modal.Traduccion}}</p>
  </div>
  <div class="modal-footer">
  <!--<button class="btn btn-primary" ng-click="ok()">OK</button>
  <button class="btn btn-warning" ng-click="cancel()">Cancel</button>-->
  </div>
  </script>
  <!--/modal -->

  <div class="one_full">

    <div class="table">
      <table border="0" cellpadding="4" cellspacing="0" class="table">
        <thead>

          <tr>
            <th>Categoria</th>
            <th>Contenido</th>
            <th></th>
          </tr>
        </thead>
        <div class="row">
          <div class="col-xs-4">
            <h3>Página Actual: {{ currentPage }}</h3>
          </div>
          <div class="col-xs-4">
            <label for="search">Buscar:</label>
            <input ng-model="q" id="search" class="form-control" placeholder="Filter text">
          </div>
          <div class="col-xs-4">
            <label for="search">Contenidos por página:</label>
            <input type="number" min="1" max="100" class="form-control" ng-model="pageSize">
          </div>
        </div>
        <tbody dir-paginate="contenido in contenidos_traducciones | filter:q | itemsPerPage: pageSize" current-page="currentPage">
          <tr>
            <td>
              <p class="dp_infolabel ng-binding">
                {{contenido.Label}}
                <span class="dp_tinydetail ng-binding">CLAVE: {{contenido.ClaveCat}}</span>
              </p>
            </td>
            <td>
              <h5>{{contenido.Titulo}}</h5>
              <!--<p ng-style=" white-space: pre-line; ">{{ contenido.Traduccion | limitTo: 200 }}{{contenido.Traduccion.length > 200 ? '...' : ''}}</p>-->
              <p>{{ contenido.Traduccion | limitTo: 200 }}{{contenido.Traduccion.length > 200 ? '...' : ''}}</p>
              <span class="dp_tinydetail2 ">PUBLICADO: {{ contenido.CT_CreatedDate | timestamp | date: 'MMM d, yyyy HH:mm:ss' }}</span>
            </td>
            <td class="alicent dp_actions">
              <a href="javascript:void(0)" class="smlinks" ng-click="edit(contenido)"><i class="fa fa-edit"></i> Editar</a>
              <a href="javascript:void(0)" class="smlinks" ng-click="delete(contenido)"><i class="fa fa-trash-o"></i> Borrar</a>
              <a href="javascript:void(0)" class="smlinks" ng-click="modalAndCtrl(contenido)"><i class="fa fa-eye"></i> Ver</a>
              <a href="javascript:void(0)" class="smlinks" ng-click="detalle(contenido, $index)"><i class="fa fa-check-square-o"></i> Audio</a>
            </td>
          </tr>
          <!-- audios -->
          <tr ng-show="evaluate($index)" class="animate fadeIn" style="background:#FAFAFA">
            <td colspan="3">
              <form class="sky-form" name="sky-form">
                <div class="row">
                  <section class="col one_full" ng-if="selectedAudios.length > 0">
                    <div class="container" ng-repeat="audio in selectedAudios">
                      <div class="col one_full audio-col">
                        <audio controls style="float:left;"
                               preload="none">
                          <source ng-src="{{'http://swfideas.com/ci22/uploads/'+audio.Nombre}}" type="audio/mpeg">
                        Your browser does not support the audio element.
                        </audio>
                        <a href="javascript:void(0)" class="audio-delete"
                           ng-click="delete_archivo(audio)">
                          <i class="fa fa-trash-o"></i>
                        </a>
                        <a href="{{'http://swfideas.com/ci22/uploads/'+audio.Nombre}}" class="audio-download"
                           target="_self" download="{{audio.Nombre}}">
                          <i class="fa fa-download"></i>
                        </a>
                        <span class="audio-detalle">
                          <strong>Descripción:</strong>
                            {{audio.Descripcion}}
                        </span>
                      </div>
                    </div>
                  </section>
                  <section class="col one_full last">
                    <label class="label">Subir archivo(s) <strong>MP3</strong></label>
                    <div class="row">
                      <section class="col one_full">
                        <div class="button btn_action1"
                          ng-file-select
                          ng-multiple="true"
                          ng-model="files"
                          ng-accept="'audio/mp3'"
                          ><i class="fa fa-plus fa-lg"></i>&nbsp;Selecciona...</div>
                        <div class="button" ng-click="upload(files)"
                             ng-show="files.length > 0">Subir...</div>
                      </section>

                      <!-- <section class="col one_full">
                        <pre>files: {{files | json}}</pre>
                        <pre>selectedAudios: {{selectedAudios | json}}</pre>
                      </section> -->


                    </div>
                    <div class="body dp_uploader_filedesc dp_uploader_filedesc_bar"
                         ng-repeat="file in files">
                      <!-- titulo audio -->
                      <section>
                        <label class="label">Descripción</label>
                        <label class="input"> <i class="icon-append icon-tag"></i>
                          <input type="text" ng-model="file.descripcion" placeholder="Descripción"
                                 ng-maxlength="255"
                                 name="filedesc{{$index}}">
                          <span class="error">Máximo 255 caracteres.</span>
                        </label>
                      </section>
                      <!--/titulo audio -->
                      <i class="fa fa-music" style="color: #E54C4C;"></i>&nbsp;&nbsp;
                      <span class="dp_uploader_filedesc_alt">nombre: </span>{{ file.name }}&nbsp;
                      <span class="dp_uploader_filedesc_alt">tipo: </span>{{ file.type }}&nbsp;
                      <span class="dp_uploader_filedesc_alt">tamaño: </span>{{ file.size/1048576 | number:2 }} MB&nbsp;
                      <span class="dp_uploader_filedesc_alt">descripcion: </span>{{ file.descripcion }}&nbsp;
                      <span ng-show="file.progress > 0"><span class="dp_uploader_filedesc_alt">upload: </span>{{ file.progress}} %&nbsp;<i class="fa fa-check pull-right" style="color: #8CC544; font-size: 1.5em;" ng-show="file.progress == 100"></i></span>
                      <div class="ui-progress-bar ui-container animate fadeIn" ng-show="file.progress > 0 && file.progress < 100"><div class="ui-progress" style="width: {{file.progress}}%;"></div></div>
                    </div>
                  </section>
                  <!-- consola -->
                  <!--
                  <section class="col one_half">
                    <pre>progressArray: {{progressArray | json}}</pre>
                    <pre>uploadedSycArray: {{uploadedSycArray | json}}</pre>
                  </section>
                  <section class="col one_half last">
                    <pre>uploadedArray: {{uploadedArray | json}}</pre>
                    <p>selected_categoria: {{selected_categoria | json}}</p>
                  </section>
                  -->
                  <!-- <section class="col one_full">
                    selectedAudios: {{selectedAudios | json}}
                  </section> -->
                  <!-- /consola -->
                </div>
                <footer>
                  <!-- <input type="submit" class="button pull-right" value="Guardar"/> -->
                </footer>
              </form>
              <!-- <pre>categorias {{categorias  | json}}</pre> -->
            </td>
          </tr>
          <!--/audios -->
        </tbody>
      </table>
    </div>

  </div>
  <!--/table -->
  <div class="one_full">
      <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="js/Pagging/dirPagination.tpl.html"></dir-pagination-controls>
  </div>
  <div class="margin_top1"></div>
  <!--
  <div class="one_half">
  <pre>new_contenido : {{new_contenido | json}}</pre>
  <pre>selected_categoria : {{selected_categoria | json}}</pre>
  <pre>contenidos_traducciones : {{contenidos_traducciones | json}}</pre>
</div>

<div class="one_half last">
<pre>list_categoria : {{list_categoria  | json}}</pre>
</div>
-->
</div>

</div><!-- ./content area -->
<div class="clearfix"></div>
