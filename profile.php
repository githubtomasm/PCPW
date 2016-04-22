<?php  
require_once 'core/init.php';
$user =  new User();


# validate if user has login 
if($user->is_logged_in()){
# user is LOG, diplay link to acess internet

	$mareki_data_serialize 	= Session::get('mareki_data');
	$mareki_data_array		= unserialize( $mareki_data_serialize );	

	# **************************************
	# LOAD HEADER
	# **************************************
	require( 'tpl_header.php' );


	?>
		<input type="hidden" id="page_id" value="page_profile">
		
		<div class="content login-warper-border ">
			<?php 
				
				if( Session::exists('password_change') ){
					?>
						<div class="alert alert-success">
							<button class="close" data-close="alert"></button>
							<span>
								<?php  echo Session::flash('password_change'); ?>	
							</span>
						</div>
					<?
				}
				/*
				Session::exists('sucess_login')
				Session::exists('success_register')
				*/				
			?>

			<div class="row l-padding-20">
				
				<div class="intro-text">
					<span class="name">Bienvenido <em><?php echo $user->data()->name;  ?></em></span>
					<hr>
					<span class="sub-name">Parques WIFI</span>
					<br>
					<strong><?php echo Session::get('parks_name'); ?> </strong>					
				</div>		


				
				<!-- facebook likes -->
				<div class="fb-like" data-send="true" data-width="450" data-show-faces="true"></div>

			
	
				
				<div id="btn_wraper" class="l-margin-top-20px">
					
					<!-- internet access -->
					<div class="col-xs-12">
						<div class="dashboard-stat blue">
							<div class="visual">
								<i class="fa fa-globe"></i>
							</div>
							<div class="details">
								<div class="number">
									Click Aqui
								</div>
								<div class="desc">
									Accesar a Internet
								</div>
							</div>
							<a class="more" href="<?php echo escape($mareki_data_array['grant_url']);  ?>">
								Acceso a Internet <i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div><!-- END - internet access -->





					

					<!-- internet change pasw -->
					<div class="col-xs-12">
						<div class="dashboard-stat purple">
							<div class="visual">
								<i class="fa  fa-lock"></i>
							</div>
							<div class="details">
								<div class="number">
									Click Aqui
								</div>
								<div class="desc">
									Cambiar Contraseña
								</div>
							</div>
							<a class="more" href="change_password.php">
								Cambiar tu Contraseña <i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div><!-- END - logout -->



					<!-- internet logout -->
					<div class="col-xs-12">
						<div class="dashboard-stat green">
							<div class="visual">
								<i class="fa  fa-ban"></i>
							</div>
							<div class="details">
								<div class="number">
									Click Aqui
								</div>
								<div class="desc">
									Log OUT
								</div>
							</div>
							<a class="more" href="logout.php">
								Salir de RED WIFI <i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div><!-- END - logout -->



					<?php  
						# check if current user is ADMIN
						if( $user->has_permission('admin') ){
							?>

								<div class="intro-text">
									<span class="name">Admin Tools</span>
									<hr>						
								</div>
									
										
								<div class="col-xs-12">
									<div class="dashboard-stat yellow">
										<div class="visual">
											<i class="fa fa-bar-chart-o"></i>
										</div>
										<div class="details">
											<div class="number">
												Reportes
											</div>
											<div class="desc">
												Actividad
											</div>
										</div>
										<a class="more" href="reports.php">
											Ver Reportes <i class="m-icon-swapright m-icon-white"></i>
										</a>
									</div>
								</div>

							
							<?php
						}	

					?>
					
				</div> <!-- END - btn_wraper -->	

			</div>
		</div>	

	<?php

	# **************************************
	# LOAD FOOTER
	# **************************************
	require('tpl_footer.php');

}else{
# user NO LOG

	// echo "<a>You Need to <a href='login.php'>log in</a> or <a href='register.php'>regiter</a>";
	Redirect::to('index.php');
}

?>		