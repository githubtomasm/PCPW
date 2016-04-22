<?php
# check if is form is coming from REGISTER to INDEX
# make $user_divice_mac == 1 to be sure it will pass to the REGISTER FORM
if( Session::exists('back_to_index') ){

	$user_divice_mac_count = 1;

}else{

	$user_divice_mac = DB::getInstance()->get( 'users', array('divice_mac', '=', $client_mac ), 'id' );
	$user_divice_mac_count = $user_divice_mac->count();
	
}


# validate if user's DIVICE MAC is already register in the db
# true, display access form
# false, display register form
if(  $user_divice_mac_count === 0 ){
	# USER'S divice mac NOT FOUNDED, 
	# display Register FORM					

	Redirect::to('register.php');

}else{
# USER'S divice MAC found, display LOGIN FORM		
	# display form access / register form	
	

	# check if form has been submited	
	if( Input::exists() ){
	# form has been submited process login	


		# chek if the token exist, securty measurement, this way, only the user will be able to post data in this page.
		if( Token::check(Input::get('token')) ){


			$validate 	= new Validate();
			
			# validation criteria for alow user to login
			$validation = $validate->check( $_POST, array(
				'email' 		=> array('required'	=> true),
				'password' 		=> array('required'	=> true) 
			));


			# check if validation passed
			if( $validation->passed()){
			# log user in

				#remember me state, if remember is checked = true
				$remember = ( Input::get('remember') === '1' ) ? true : false;

				# store login vars
				$login = $user->login(Input::get('email'), Input::get('password'), $remember); 


				if( $login ){
				# Login Successfull, redirecto to profile
					Redirect::to('profile.php');
				}

			}else{
				# get all erros to be store and display
				foreach($validation->errors() as $error ){
					 echo $error.'<br>';	
				}

			}

		}

	}




	# **************************************
	# LOAD HEADER
	# **************************************
	require( 'tpl_header.php' );

	?>

		<input type="hidden" id="page_id" value="page_login">

		<div class="content login-warper-border">
			
			<!-- BEGIN LOGIN FORM -->
			<form class="login-form" action="" method="post">
				
				<?php 

					if( Session::exists('error_login') ){
						?>
							<div class="alert alert-danger">
								<button class="close" data-close="alert"></button>
								<span>
									<?php  
										echo Session::flash('error_login');
										echo Session::flash('error_register')	
									?>	
								</span>
							</div>
						<?

					}
				?>


				<h3 class="form-title text-align-center">
					Acceso a Parque WIFI
					<br>
					<strong><?php echo Session::get('parks_name'); ?></strong>
				</h3>
				
				<div class="alert alert-danger display-hide">
					<button class="close" data-close="alert"></button>
					<span>
						Proporcionar Usuario y Contrase&ntilde;a.
					</span>
				</div>


				<!-- user-name -->
				<div class="form-group">
					<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
					<label class="control-label visible-ie8 visible-ie9">Correo Electronico</label>
					<div class="input-icon">
						<i class="fa fa-envelope"></i>
						<input class="form-control placeholder-no-fix" type="text" autocomplete="on" placeholder="Direccion de Correo Electronico" name="email" id="email" value="<?php echo escape(Input::get('email')); ?>" />
					</div>
				</div> <!-- END - user-name -->


				<!-- password -->
				<div class="form-group">
					<label class="control-label visible-ie8 visible-ie9">Contrase&ntilde;a</label>
					<div class="input-icon">
						<i class="fa fa-lock"></i>
						<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Contrase&ntilde;a" name="password" id="password"/>
					</div>
				</div><!-- END -  password -->

			
				<!-- remember me && submit -->
				<div class="form-actions">
					<label class="checkbox">
						<input type="checkbox" value="1" name="remember" id="remember" checked="checked" /> 
						Recordarme 
					</label>

					
					<button type="submit" class="btn green pull-right">
						Iniciar sesion 
						<i class="m-icon-swapright m-icon-white"></i>
					</button>
				</div><!-- END - remember me && submit -->

				
				<?php 
				# validate FACEBOOK session present
				if( !isset($_SESSION['facebook'])): 
				# no FACEBOOK session founded display access link 	
				?>

					<div class="separator_dotted"></div>
					<div class="login-options clearfix">
						<h4 class="l-display-inline-block l-float-l">
							Accesar con Facebook
						</h4>

						<ul class="social-icons l-display-inline-block l-float-l">
							<li>
							<a href="<?php echo $facebook->getLoginUrl(array('email', 'user_birthday')); ?>" class="facebook" data-original-title="facebook"></a>
							</li>
						</ul>
					</div><!-- / login with facebook -->
				
				<?php endif; ?>	

				<div class="separator_dotted"></div>


				<div class="forget-password">
					<h4>Olvidaste tu Contrase&ntilde;a ?</h4>
					<p>
						<a href="forgot_password.php" id="forget-password" class="btn green btn-sm">Recuperar Contrase&ntilde;a</a>
					</p>
				</div>
				<!-- END - forgot psw -->
				
				<div class="create-account">
					<p>
						Aun No tienes Cuenta?
						<br>
						<a href="register.php" id="register-btn" class="btn blue">
							Crear Usuario
							<i class="m-icon-swapright m-icon-white"></i>
						</a>
					</p>
				</div>

				<input type="hidden" id="token" name="token" value="<?php echo Token::generate(); ?>" >

			</form><!-- END LOGIN FORM -->	

		</div>

	<?php

}


# **************************************
# LOAD FOOTER
# **************************************
require('tpl_footer.php');



?>