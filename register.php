<?php  
include_once 'core/init.php';

$user =  new User();

# validate if user has cookie, and hash from REMEMBER ME input
if($user->is_logged_in()){
# user has session active via HASH and cookie, USER IS CURRENTLY LOGIN

	// echo 'User is currently Logged In, redirecto to PROFILE';
	# check if log user is Admin
	if( $user->has_permission('admin') ){
		# user is admin
		# do not redirect	
		echo "<h3>You are admin, will not be redirected</h3>";

	}else{
	# user is subscriber, redirect to profile	
		# *****************************************************
		# REDIRECTO TO PROFILE.PHP
		# *****************************************************	
		Redirect::to('profile.php');
	}	

}else{
# no Session founded display REGISTER FORM

	# *****************************************************
	# VALIDATE MAREKI'S VARS, if not present rediret to JP
	# *****************************************************	
	if( Session::exists('mareki_data') ){
	# mareki data present, continue display	form
		
		# get mareki data from SESSION
		$mareki_data_serialize = Session::get('mareki_data');

		#extract user's divice mac, to be added indiviualy to db
		$mareki_array = unserialize($mareki_data_serialize);

		# get the current users aps tags
		// $current_ap_tag_array->first()->tags;		
		$current_ap_tag_array = DB::getInstance()->get('mareki_aps', array('mac', '=', $mareki_array['mac_ap']), 'tags');		 
		$current_ap_tag = ( $current_ap_tag_array ) ? $current_ap_tag_array->first()->tags : "" ;

		# write to session user_divice_mac founded.
		# snerio, user with divice mac NOT register in db, but user has an acount creat it   
		# use when CLICK on the BACK TO LOGIN and if mac is not present on the DB, it will create a loop redirectin from index to register, not allowing user to login
		Session::put('back_to_index', 'true' );

		# validate if token is submited in the form match the token in session
		$token_check = Token::check(Input::get('token'));

		# Form has been submited
		if( Input::exists()){

			# VALIDATE IF the token matches, user session TOKEN and form TOKEN, help to avoid Cross-Site Request Forgery 
			if( $token_check ){
			# tokens does match, continue validation

		
				# validation Class instance	
				$validate = new Validate();
				# validation rule set
				
				$validation =  $validate->check( $_POST, array(
					# to validate fields  key:fields => value:rules			
					'email'			=>	array(
						'required'		=> true,
						'unique'		=> 'users'
					)

				));

				# validation state
				if( $validation->passed()){
				# validation has pass

					# instance the user object, will give access to db 
					# $user = new User();

					# salt security layer  to be added to the psw and db
					$salt = Hash::salt(32);
					# compativily to store salt in db
					# PSW HASH will be generate it with the RAW output $salt var
					$salt_econded = rawurlencode( $salt ); 

					try{

						# register user
						# save to DB 
						$user->create(array(
							'email'				=> Input::get('email'),	
							'password' 			=> Hash::make(Input::get('password'), $salt),
							'salt' 				=> $salt_econded,
							'name' 				=> Input::get('name'),
							'last_name'			=> Input::get('last_name'),
							'age' 				=> Input::get('age'),
							'sex' 				=> Input::get('sex'),
							'cell_number'		=> Input::get('cell_number'),
							'cell_hash'			=> Hash::make(Input::get('cell_number'), $salt),
							'date_register' 	=> date('Y-m-d H:i:s'),
							'mareki_meta'		=> $mareki_data_serialize,
							'divice_mac'		=> $mareki_array['client_mac'],
							'group' 			=> 1,
							'parks_tags'		=> $current_ap_tag
						));

						# login user after INSERTIN info to DB	
						$login = $user->login(Input::get('email'), Input::get('password'), 1); 
						

						if( $login ){
							# LOGIN Succesfull
							Session::flash('success_register', 'Se ha Registrado Exitosamente.' );
							Redirect::to('profile.php');
							// echo 'login Succesfull REDIRECT TO PROFILE';
						
						}else{
							Session::flash('error_login', 'Error al Iniciar Sesion, Favor tratar nuevamente.' );
							Redirect::to('index.php');
							// echo 'login fail REDIRECT TO INDEX';
						}

					}catch( Exception $e ){
					# catch the error from the class exeption
						Session::flash('error_login', $e->getMessage());
						// die( $e->getMessage());
						Redirect::to('index.php');
						// echo ' register fail, REDIRECT TO INDEX';						
						
					}


				}else{
				# VALIDATION FAIL (email)
					# Display error
					# validate via ajax -> add fn later

				}
				
			}		

		}


		# **************************************
		# LOAD HEADER
		# **************************************
		require( 'tpl_header.php' );
		

		?>
				
			<input type="hidden" id="page_id" value="page_register">

			<div class="content login-warper-border">
		
				<!-- BEGIN REGISTRATION FORM -->
				<form class="login-form" action="" method="post">

					<?php
						if( Input::exists() ){
						# form submited

							if( $token_check ){
							# token founded

								if (!$validation->passed()) {
								# VALIDATION FAIL
								# DISPLAY ERROR
									foreach( $validation->errors() as $error ){
										?>	
											<div class="alert alert-danger">
												<button class="close" data-close="alert"></button>
												<span><?php echo $error."<br>"; ?></span>
											</div>
										<?php
									}
								}
								
							}


						}
					?>
	



					<h3>Crear Cuenta de Acceso</h3>

					<p>Datos Personales:</p>
					
						<!-- full name -->
						<div class="form-group">
							<label class="control-label visible-ie8 visible-ie9">Nombre Completo *</label>
							<div class="input-icon">
								<i class="fa fa-font"></i>
								<input class="form-control placeholder-no-fix" type="text" placeholder="Nombre Completo *" name="name" id="name" value="<?php echo escape( Input::get('name') ); ?>"/>
							</div>
						</div><!-- END - full name -->
						


						<!-- last_name -->
						<div class="form-group">
							<label class="control-label visible-ie8 visible-ie9">Apellidos *</label>
							<div class="input-icon">
								<i class="fa fa-font"></i>
								<input class="form-control placeholder-no-fix" type="text" placeholder="Apellidos *" name="last_name" id="last_name" value="<?php echo escape( Input::get('last_name') ); ?>"/>
							</div>
						</div><!-- END - last_name -->




						<!-- age -->
						<div class="form-group">
							<label class="control-label visible-ie8 visible-ie9">Edad</label>
							<div class="input-icon">
								<i class="fa fa-calendar"></i>
								<input class="form-control placeholder-no-fix" type="text" placeholder="Edad *" name="age" id="age" value="<?php echo escape(Input::get('age')); ?>"/>
							</div>
						</div><!-- END - age -->
					
						<!-- sex -->
						<div class="form-group">
							<label class="control-label visible-ie8 visible-ie9">Sexo</label>
							<select class="form-control" name="sex" id="sex" value="<?php echo escape(Input::get('sex')); ?>">
								<option value="">Sexo *</option>
								<option value="hombre">Masculino</option>
								<option value="mujer">Femenino</option>
							</select>
						</div> <!-- END - sex -->


					<p>Datos para Crear su Cuenta:</p>
					
						<!-- email - user -->
						<div class="form-group">
							<label class="control-label visible-ie8 visible-ie9">Correo Electronico</label>
							<div class="input-icon">
								<i class="fa fa-envelope"></i>
								<input class="form-control placeholder-no-fix" type="text" placeholder="Correo Electronico" name="email" id="email" value="<?php echo escape(Input::get('email')); ?>"/>
							</div>
						</div><!-- END / email - user -->					

						<!-- psw	 -->
						<div class="form-group">
							<label class="control-label visible-ie8 visible-ie9">Contraseña *</label>
							<div class="input-icon">
								<i class="fa fa-lock"></i>
								<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Contraseña *" name="password" id="password"/>
							</div>
						</div><!-- END - psw	 -->
						

						<!-- psw repeat -->
						<div class="form-group">
							<label class="control-label visible-ie8 visible-ie9">Repetir Contraseña *</label>
							<div class="controls">
								<div class="input-icon">
									<i class="fa fa-check"></i>
									<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Repetir Contraseña *" name="rpassword" id="rpassword" />
								</div>
							</div>
						</div><!-- END - psw repeat	 -->


					<p>Opcional para recuperacion de cuenta:</p>

						<div class="form-group">
							<label class="control-label visible-ie8 visible-ie9">Numero Celular</label>
							<div class="input-icon">
								<i class="fa fa-mobile"></i>
								<input class="form-control placeholder-no-fix" type="text" placeholder="Numero Celular" name="cell_number" id="cell_number" value="<?php echo escape(Input::get('cell_number')); ?>"/>
							</div>
						</div>
						
					<div class="form-actions">

						<button id="" type="button" class="btn" onClick="parent.location='index.php'">
							<i class="m-icon-swapleft"></i> 
							Login 
						</button>
						
						<button type="submit" id="register-submit-btn" class="btn green pull-right">
							Registrar 
							<i class="m-icon-swapright m-icon-white"></i>
						</button>
					</div>

					<input type="hidden" id="token" name="token" value="<?php echo Token::generate(); ?>" >

				</form>
				<!-- END REGISTRATION FORM -->

			</div>	

		<?php


		# **************************************
		# LOAD FOOTER
		# **************************************
		require('tpl_footer.php');
	


	}else{
	# NO mareki data FOUND, redirect to index
		
		Redirect::to('index.php');	

	}



}	


?>					