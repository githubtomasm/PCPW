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

	$user = new User;

	# validate if user has cookie, and hash from REMEMBER ME input
	if($user->is_logged_in()){
	# user has session active via HASH and cookie
		# redirect to profile are	
		
		# *****************************************************
		# redirecto to PROFILE
		# *****************************************************	
		// Redirect::to('profile.php');
		
		echo "<br>";
		echo 'Logged In';
		
		?>
			<a href="profile.php?user=<?php echo escape( $user->data()->user_name ) ?>"><?php echo escape( $user->data()->user_name ); ?></a>
			<ul>
				<li><a href="logout.php">logout</a></li>
				<li><a href="update_profile.php">Update</a></li>
				<li><a href="change_password.php">Change your password</a></li>
				<li><a href="profile.php">Profile</a></li>
			</ul>
		<?php


	}else{
	# no session founded
		
		# validate if user's DIVICE MAC is already register in the db
		# true, display access form
		# false, display register form
		# *****************************************************
		# redirect to REGISTER.PHP and pass the marekis vars
		# *****************************************************	





		# display form access / register form	
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
									
									#remember me state, if remember is checked = true
									$remember = ( Input::get('remember') === '1' ) ? true : false;

									# store login vars
									$login = $user->login(Input::get('user_name'), Input::get('password'), $remember); 

									if( $login ){
										# display
										echo 'login successfull';
										// Redirect::to('profile.php');


									}else{
									# login fail, display error msm
										?>	
											<div class="alert alert-danger">
												<button class="close" data-close="alert"></button>
												<span>
													Error al Iniciar Sesion, Favor tratar nuevamente..
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
							<input type="checkbox" value="1" name="remember" id="remember" checked="checked" /> 
							Recordarme 
						</label>

						
						<button type="submit" class="btn green pull-right">
							Iniciar sesion 
							<i class="m-icon-swapright m-icon-white"></i>
						</button>
					</div><!-- END - remember me && submit -->


					<!-- END - forgot psw -->
					<div class="forget-password">
						<h4>Olvidaste tu Contraseña ?</h4>
						<p>

							Has, click
							<a href="javascript:;" id="forget-password">Aqui</a>
							para recuperar tu Contraseña.
						</p>
					</div>
					
					<div class="create-account">
						<p>
							Aun No tienes Cuenta de Acceso para los Parques <strong>WIFI</strong>?&nbsp;
							<br>
							<a href="register.php" id="register-btn" class="btn blue">
								Crear Usuario
								<i class="m-icon-swapright m-icon-white"></i>
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

	} // end session validation











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