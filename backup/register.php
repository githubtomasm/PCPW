<?php  
include_once 'core/init.php';

$user =  new User();

# validate if user has cookie, and hash from REMEMBER ME input
if($user->is_logged_in()){
# user has session active via HASH and cookie

	echo 'User is currently Logged In, redirecto to PROFILE';
	# check if log user is Admin
	if( $user->has_permission('admin') ){
		# user is admin
		# do not redirect	
		echo "<h3>You are admin, will not be redirected</h3>";
	
	}else{
	# user is subscriber, redirect to profile	
		// Redirect::to('profile.php');
	}	

}else{
# no Session founded display REGISTER FORM

	# *****************************************************
	# VALIDATE MAREKI'S VARS, if not present rediret to JP
	# *****************************************************	




	# Form has been submited
	if( Input::exists()){

		# VALIDATE IF the token matches, user session TOKEN and form TOKEN, help to avoid Cross-Site Request Forgery 
		if( Token::check(Input::get('token')) ){
		# tokens does match, continue validation


			
			# validation Class instance	
			$validate = new Validate();
			# validation rule set
			$validation =  $validate->check( $_POST, array(
				# to validate fields  key:fields => value:rules			
				/*'user_name'		=>	array(
					'field_name'	=> 'User Name',
					'required'		=> true,
					'min'			=> 2,
					'max'			=> 20,
					'unique'		=> 'users' # unique for users table
				),

				'password'		=>	array(
					'field_name'	=> 'Password',
					'required'		=> true,
					'min'			=> 4
				),	
			
				'password-repeat'=>	array(
					'field_name'	=> 'Password Repeat',
					'required'		=> true,
					'matches'		=> 'password' # match value from password field
				),	

				'name'			=>	array(
					'field_name'	=> 'Nombre Completo',				
					'required'		=> true,
					'min'			=> 2,
					'max'			=> 50
				)*/	

			));

			# validation state
			if( $validation->passed()){
			# validation has pass

				# instance the user object, will give access to db 
				$user = new User();

				# salt security layer  to be added to the psw and db
				$salt = Hash::salt(32);

				try{

					# register user
					# save to DB 
					$user->create(array(
						'user_name' 		=> Input::get('user_name'),
						'password' 			=> Hash::make(Input::get('password'), $salt),
						'salt' 				=> $salt,
						'name' 				=> Input::get('name'),
						'date_register' 	=> date('Y-m-d H:i:s'),
						'group' 			=> 1
					));


					# add Success Message to the user session
					Session::flash('success', 'You Register successfuelly' );
					#redirect
					// header('Location: index.php');	
					Redirect::to('index.php');


				}catch( Exception $e ){
				# catch the error from the class exeption
					die( $e->getMessage());
					
				}

			}else{
				# display error
				foreach( $validation->errors() as $error ){
					echo $error."<br>";
				}
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
					<h3>Crear Cuenta de Acceso</h3>

					<p>Datos Personales:</p>
					
						<!-- full name -->
						<div class="form-group">
							<label class="control-label visible-ie8 visible-ie9">Nombre Completo *</label>
							<div class="input-icon">
								<i class="fa fa-font"></i>
								<input class="form-control placeholder-no-fix" type="text" placeholder="Nombre Completo *" name="name" id="name" />
							</div>
						</div><!-- END - full name -->
						
						<!-- age -->
						<div class="form-group">
							<label class="control-label visible-ie8 visible-ie9">Edad</label>
							<div class="input-icon">
								<i class="fa fa-calendar"></i>
								<input class="form-control placeholder-no-fix" type="text" placeholder="Edad *" name="age" id="age"/>
							</div>
						</div><!-- END - age -->
					
						<!-- sex -->
						<div class="form-group">
							<label class="control-label visible-ie8 visible-ie9">Sexo</label>
							<select class="form-control" name="sex" id="sex">
								<option value="">Sexo *</option>
								<option value="male">Masculino</option>
								<option value="female">Femenino</option>
							</select>
						</div> <!-- END - sex -->



					<p>Datos para Crear su Cuenta:</p>
					
						<!-- email - user -->
						<div class="form-group">
							<label class="control-label visible-ie8 visible-ie9">Correo Electronico</label>
							<div class="input-icon">
								<i class="fa fa-envelope"></i>
								<input class="form-control placeholder-no-fix" type="text" placeholder="Correo Electronico" name="email" id="email" />
							</div>
						</div><!-- END / email - user -->					

						<!-- psw	 -->
						<div class="form-group">
							<label class="control-label visible-ie8 visible-ie9">Contraseña *</label>
							<div class="input-icon">
								<i class="fa fa-lock"></i>
								<input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Contraseña *" name="password" id="register_password"/>
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
								<input class="form-control placeholder-no-fix" type="text" placeholder="Numero Celular" name="cell_number" id="cell_number"/>
							</div>
						</div>
						
					<div class="form-actions">

						<button id="" type="button" class="btn" onClick="parent.location='index.php'">
							<i class="m-icon-swapleft"></i> 
							Regresar 
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

}	


?>					