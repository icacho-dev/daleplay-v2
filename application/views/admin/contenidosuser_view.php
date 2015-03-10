<!-- content area -->
<div class="content_fullwidth less2">

  <div class="container">
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
    <h3>
      <strong>Filtros</strong>
    </h3>
    <ul class="list_empty">
      <li ng-repeat="filter in ListFilters">
        <a ng-click="removeFilter(filter)" class="but_remove_2"><i class="fa fa-times fa-lg"></i>&nbsp;{{filter.Categoria}}</a>
      </li>
    </ul>
  </div>
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
        <tbody ng-repeat="contenido in contenidos_traducciones">
          <tr>
            <td>
              <p class="dp_infolabel ng-binding">
                {{contenido.Label}}
                <span class="dp_tinydetail ng-binding">CLAVE: {{contenido.ClaveCat}}</span>
              </p>
            </td>
            <td>
              <h5>{{contenido.Titulo}}</h5>
              <p>{{ contenido.Traduccion | limitTo: 200 }}{{contenido.Traduccion.length > 200 ? '...' : ''}}</p>
              <span class="dp_tinydetail2 ">PUBLICADO: {{ contenido.CT_CreatedDate | timestamp | date: 'MMM d, yyyy HH:mm:ss' }}</span>
            </td>
            <td class="alicent dp_actions">
              <a href="javascript:void(0)" class="smlinks" ng-click="myprep(contenido)"><i class="fa fa-star"></i> Favoritos</a>
              <a href="javascript:void(0)" class="smlinks" ng-click="modalAndCtrl(contenido)"><i class="fa fa-eye"></i> Ver</a>
              <a href="javascript:void(0)" class="smlinks" ng-click="detalle(contenido, $index)"><i class="fa fa-file-sound-o"></i> Audio</a>
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
                        <audio controls style="float:left;">
                          <source ng-src="{{'http://swfideas.com/ci22/uploads/'+audio.Nombre}}" type="audio/mpeg">
                        Your browser does not support the audio element.
                        </audio>
                        <span class="audio-detalle">
                          <strong>Descripción:</strong>
                            {{audio.Descripcion}}
                        </span>

                      </div>
                    </div>
                  </section>
                </div>
                <footer>
                </footer>
              </form>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
  <!--/table -->
  <div class="margin_top1"></div>
</div>

</div><!-- ./content area -->
<div class="clearfix"></div>
