<?php  
include_once 'core/init.php';
$user = new User;

if($user->is_logged_in()){
# USER LOG
	Redirect::to('profile.php');


}else{
# USER NOT LOG

	if(  Session::exists('mareki_data')  ){
	# comes FROM mareki's console
	# display form


		# validate if form has been posted
		if( Input::exists() ){

			# chek if the token exist, securty measurement, this way, only the user will be able to post data in this page.
			if( Token::check(Input::get('token')) ){

				$validate 	= new Validate();
				
				# validation criteria for alow user to login
				$validation = $validate->check( $_POST, array(
					'email' 			=> array('required'	=> true),
					'cell_number' 		=> array('required'	=> true) 
				));


				if ($validation->passed()) {
				# validation PASS
					# Check if CREDENTIALS are valid  	

					$login = $user->login( Input::get('email'), Input::get('cell_number'), false, true );	
					
					if( $login ){
					# Login SUSCESSFULL

						Session::flash('success_login_forgot_psw');
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
			<input type="hidden" id="page_id" value="page_forgot_pasw">

			<!--BEGIN FORGOT PASSWORD FORM -->
			<div class="content login-warper-border">
				<form class="login-form" action="" method="post">

					<?php 

						if( Session::exists('error_login_forgot') ){
							?>
								<div class="alert alert-danger">
									<button class="close" data-close="alert"></button>
									<span>
										<?php  
											echo Session::flash('error_login_forgot');	
										?>	
									</span>
								</div>
							<?

						}
					?>


					<h3>Olvidaste tu Contraseña ?</h3>
					<p>
						Direccion e-mail de Registro.
					</p>
					<div class="form-group">
						<div class="input-icon">
							<i class="fa fa-envelope"></i>
							<input class="form-control placeholder-no-fix" type="text" autocomplete="on" placeholder="Email" name="email" id="email" value="<?php echo escape(Input::get('email')) ?>" />
						</div>
					</div>

					<p>Numero Celular de Registro</p>
					<div class="form-group">
						<div class="input-icon">
							<i class="fa  fa-mobile"></i>
							<input class="form-control placeholder-no-fix" type="text" autocomplete="on" placeholder="Celular" name="cell_number" id="cell_number" value="<?php echo escape(Input::get('cell_number')) ?>"/>
						</div>
					</div>
					

					<div class="form-actions">
						<button type="button" id="back-btn" class="btn" onClick="parent.location='index.php'">
							<i class="m-icon-swapleft"></i> 
							Login 
						</button>

						<button type="submit" class="btn green pull-right">
							Iniciar Sesion 
							<i class="m-icon-swapright m-icon-white"></i>
						</button>
					</div>

					<input type="hidden" id="" name="token" value="<?php echo Token::generate(); ?>" >

				</form>
			</div><!--END FORGOT PASSWORD FORM -->

		<?php  

		# **************************************
		# LOAD FOOTER
		# **************************************
		require('tpl_footer.php');
		
	}else{
	# un autorize access
	# rdirect to index
		Redirect::to('index.php');
	}

}




?>