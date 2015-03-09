<div class="content_fullwidth less2" ng-controller="LoginController">

<div class="container">



	<div class="login_form">

        <form id="sky-form" class="sky-form"
              ng-submit="validauser()">

				<header>Login</header>

				<fieldset>

					<section>
            <div class="row">
              <label class="label col col-4">Usuario</label>
              <div class="col col-8">
                <label class="input">
                  <i class="icon-append icon-user"></i>
                  <input type="text" name="Usuario" placeholder="Usuario" required ng-model="usuario.user">
                </label>
              </div>
            </div>
					</section>

  				<section>
            <div class="row">
              <label class="label col col-4">Password</label>
              <div class="col col-8">
      					<label class="input">
      						<i class="icon-append icon-lock"></i>
      						<input type="password" name="Password" placeholder="Password" required ng-model="usuario.pass">
      					</label>
              </div>
            </div>
  				</section>

				</fieldset>

				<footer>
          <div class="fright">
            <button type="submit" class="button" value="Validar">Log in</button>
          </div>
				</footer>

			</form>

		</div>
</div>

</div><!-- end content area -->
