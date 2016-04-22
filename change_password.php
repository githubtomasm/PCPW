<?php  
	require_once 'core/init.php';
	$user = new User();

	# check if user is NOT loggin
	if($user->is_logged_in()){


		$token_exists = Token::check(Input::get('token'));

		# check if the inputs exists, aand check token
		if( Input::exists()){
			# get the input token 
			if( $token_exists ){

				#validate current psw and new and repeat pasw new
				$validate =  new Validate();
				$validation = $validate->check( $_POST, array(
					'password_current' 		=> array(
						'required'		=> true,
					),
					'password_new' 			=> array(
						'required'		=> true,
						'min'			=> 4
					),
					'password_repeat' 	=> array(
						'matches'			=> 'password_new'
					),
				));

				# check if validation passes
				if( $validation->passed()){
					# change pass
					
					# check if input password matches the db stored psw
					# if the provided psw + hash is DIFRENT from store in db
					if( Hash::make( Input::get('password_current'), rawurldecode($user->data()->salt) ) === $user->data()->password  ){
					# provided psw matches db psw
					# update it
					
						# create a new salt
						$salt = Hash::salt(32);
						$salt_econded = rawurlencode( $salt ); 


						# update values
						$user->update(array(

							'password'		=> Hash::make( Input::get('password_new'), $salt ),
							'salt'			=> $salt_econded,
							'cell_hash'		=> Hash::make( $user->data()->cell_number, $salt )
						));

						Session::flash('password_change', 'Cambio de Contrase&ntilde;a Exitoso.');	
						Redirect::to('profile.php');
					}

				}else{
				# loop errors
					# errors will be display in the form
				}


			}
		}




		# **************************************
		# LOAD HEADER
		# **************************************
		require( 'tpl_header.php' );

		?>

			<input type="hidden" id="page_id" value="page_forgot_reset">

			<!--BEGIN FORGOT PASSWORD FORM -->
			<div class="content login-warper-border">
				<form class="login-form" action="" method="post">

					<?php  

						if( Input::exists() ){
						# Form has been submited
							
							if($token_exists){
							# token VERIFIED
							
								if( $validation->passed() ){
								# validateion PASS
								
									if( Hash::make( Input::get('password_current'), rawurldecode($user->data()->salt) ) !== $user->data()->password  ){
										?>
											<div class="alert alert-danger">
												<button class="close" data-close="alert"></button>
												<span><strong>Error</strong>, Contrase&ntilde;a Actual no coincide con registros.</span>
											</div>

										<?php
									
									}

								}else{
									?>
										<div class="alert alert-danger">
											<button class="close" data-close="alert"></button>
											<span>
												<?php  
													foreach ($validation->errors() as $error) {
														echo $error.'<br>';
													}
												?>	
											</span>
										</div>									
									<?php
								}	

							}	

						}
					?>


					<h3>Cambiar Contrase&ntilde;a.</h3>

					<div class="form-group">
						<div class="input-icon">
							<i class="fa fa-envelope"></i>
							<input class="form-control placeholder-no-fix" placeholder="Contrase&ntilde;a Actual" type="password" name="password_current" id="password_current" value="" autocomplete="off" >
						</div>
					</div>


					<div class="form-group">
						<div class="input-icon">
							<i class="fa fa-envelope"></i>
							<input class="form-control placeholder-no-fix" placeholder="Contrase&ntilde;a Nueva" type="password" name="password_new" id="password_new" value="" autocomplete="off" >
						</div>
					</div>


					<div class="form-group">
						<div class="input-icon">
							<i class="fa fa-envelope"></i>
							<input class="form-control placeholder-no-fix" placeholder="Repetir Contrase&ntilde;a Nueva" type="password" name="password_repeat" id="password_repeat" value="" autocomplete="off" >
						</div>
					</div>

					
					<div class="form-actions">
						<button type="button" id="back-btn" class="btn" onClick="parent.location='profile.php'">
							<i class="m-icon-swapleft"></i> 
							Regresar 
						</button>

						<button type="submit" class="btn green pull-right">
							 Cambiar Contrase&ntilde;a
							<i class="m-icon-swapright m-icon-white"></i>
						</button>
					</div>

					<input type="hidden" id="token" name="token" value="<?php echo Token::generate(); ?>" >	

				</form>
			</div><!--BEGIN FORGOT PASSWORD FORM -->			

		<?php


		# **************************************
		# LOAD FOOTER
		# **************************************
		require('tpl_footer.php');

	}else{
	# USER NOT LOG	
		Redirect::to('index.php');
	}


?>


