<?php 
include_once 'core/init.php';


/*
# validate if meraki's variable are present in the query string
if( $_GET['base_grant_url'] && $_GET['node_mac'] && $_GET['client_mac'] ){
# Marek's data present in the query string, DISPLAY ACCESS/LOGIN FORM  

	# retrive meraki data from url query string
	$base_grant_url 			= urldecode($_GET['base_grant_url']);
	$user_continue_url 			= urldecode($_GET['user_continue_url']);
	$override_continue_url 		= 'https://es-es.facebook.com/JuventudPresidente';

	$grant_url 					= $base_grant_url . "?continue_url=" . urlencode($override_continue_url);

	$mac_ap 					= htmlspecialchars( urldecode($_GET['node_mac']) );
	$node_id 					= htmlspecialchars( urldecode($_GET['node_id']) );
	$gateway_id 				= htmlspecialchars( urldecode($_GET['gateway_id']) );
	$client_ip 					= htmlspecialchars( urldecode($_GET['client_ip']) );
	$client_mac					= htmlspecialchars( urldecode($_GET['client_mac']) );

	$mareki_data_array = 	array(
		'mac_ap'		=> $mac_ap,
		'node_id'		=> $node_id,
		'gateway_id'	=> $gateway_id,
		'client_ip'		=> $client_ip,
		'client_mac'	=> $client_mac
	);

	$mareki_data_serialize = serialize( $mareki_data_array );
*/

	# **************************************
	# START HTML
	# **************************************


	# **************************************
	# LOAD HEADER
	# **************************************
	require( 'tpl_header.php' );
	?>


		<div class="content login-warper-border">
			
			<!-- BEGIN LOGIN FORM -->
			<form class="login-form" action="" method="post">


				<?php  

					# check if form has been submited	
					if( Input::exists() ){
					# form has been submited process login	

						# chek if the token exist, securty measurement, this way, only the user will be able to post data in this page.
						if( Token::check(Input::get('token')) ){

							$validate 	= new Validate();
							
							# validation criteria for alow user to login
							$validation = $validate->check( $_POST, array(
								'user_name' 	=> array('required'	=> true),
								'password' 		=> array('required'	=> true) 

							));

							# check if validation passed
							if( $validation->passed()){
							# log user in

								# instance of user OBJ.
								$user =  new User();
								
								#remember me state
								$remember = ( Input::get('remember') === 'on' ) ? true : false;

								# store login vars
								$login = $user->login(Input::get('user_name'), Input::get('password'), $remember); 

								if( $login ){
									# display
									echo 'login successfull';
									Redirect::to('profile.php');


								}else{
								# login fail, display error msm
									?>	
										<div class="alert alert-danger">
											<button class="close" data-close="alert"></button>
											<span>
												Error al Iniciar Sesion, favor tratar nuevamente..
											</span>
										</div>
									
									<?php
								}

							}else{
								# get all erros to be store and display
								foreach($validation->errors() as $error ){
									 echo $error.'<br>';	
								}

							}

						}

					}

				?>


				<h3 class="form-title">Acceso a Parques <strong>WIFI</strong></h3>
			
				<div class="alert alert-danger display-hide">
					<button class="close" data-close="alert"></button>
					<span>
						Proporcionar Usuario y Contraseña.
					</span>
				</div>


				<!-- user-name -->
				<div class="form-group">
					<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
					<label class="control-label visible-ie8 visible-ie9">Usuario</label>
					<div class="input-icon">
						<i class="fa fa-user"></i>
						<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Nombre de Usuario" name="user_name" id="user_name" />
					</div>
				</div> <!-- END - user-name -->


				<!-- password -->
				<div class="form-group">
					<label class="control-label visible-ie8 visible-ie9">Contraseña</label>
					<div class="input-icon">
						<i class="fa fa-lock"></i>
						<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Contraseña" name="password" id="password"/>
					</div>
				</div><!-- END -  password -->


				<input type="hidden" id="token" name="token" value="<?php echo Token::generate(); ?>" >
				
				<!-- remember me && submit -->
				<div class="form-actions">
					<label class="checkbox">
						<input type="checkbox" value="1" name="remember" id="remember" checked /> 
						Recordarme 
					</label>

					
					<button type="submit" class="btn green pull-right">
						Iniciar sesion 
						<i class="m-icon-swapright m-icon-white"></i>
					</button>
				</div><!-- END - remember me && submit -->

				<!-- login-options	 -->
				<div class="login-options">
					<h4>Accesar Usando</h4>
					<ul class="social-icons">
						<li>
							<a class="facebook" data-original-title="facebook" href="#">
							</a>
						</li>
						<li>
							<a class="twitter" data-original-title="Twitter" href="#">
							</a>
						</li>
					</ul>
				</div><!-- END - login-options -->


				<!-- END - forgot psw -->
				<div class="forget-password">
					<h4>Olvidaste tu Contraseña ?</h4>
					<p>
						Has, click
						<a href="javascript:;" id="forget-password">
							Aqui
						</a>
						para recuperar tu Contraseña.
					</p>
				</div>
				
				<div class="create-account">
					<p>
						Aun No tienes Cuenta?&nbsp;
						<a href="register.php" id="register-btn">
							 Crear Usuario para Parques <strong>WIFI</strong>
						</a>
					</p>
				</div>
			</form><!-- END LOGIN FORM -->	



			<!-- BEGIN FORGOT PASSWORD FORM -->
			<form class="forget-form" action="" method="post">
				<h3>Olvidaste tu Contraseña ?</h3>
				<p>
					Direccion e-mail de Registro para enviar tu password.
				</p>
				<div class="form-group">
					<div class="input-icon">
						<i class="fa fa-envelope"></i>
						<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
					</div>
				</div>

				<p>Numero Cellular de Registro</p>
				<div class="form-group">
					<div class="input-icon">
						<i class="fa  fa-mobile"></i>
						<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Celular" name="celular"/>
					</div>
				</div>


				<div class="form-actions">
					<button type="button" id="back-btn" class="btn">
						<i class="m-icon-swapleft"></i> 
						Regresar 
					</button>

					<button type="submit" class="btn green pull-right">
						Recuperar 
						<i class="m-icon-swapright m-icon-white"></i>
					</button>
				</div>
			</form><!-- END FORGOT PASSWORD FORM -->


		</div>

	<?php

	# **************************************
	# LOAD FOOTER
	# **************************************
	require('tpl_footer.php');


/*}else{
# un Autorize Access redirecto to JP.	
	
	// die( Redirect::to('https://es-es.facebook.com/JuventudPresidente'));
	echo "redirect to JP";

}*/




?>