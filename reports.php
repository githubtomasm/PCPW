<?php  
include_once 'core/init.php';
$user = new User;



if($user->is_logged_in()){
# USER LOG
# check if is admin

	if( $user->has_permission('admin') ){
	# USER IS ADMIN display tables	


		if(Input::exists()){
		# form has been submited	

			# retrive data to report create query
			$report_name 				= Input::get('report_name');
			$report_type 				= Input::get('report_type');
			$report_park_region			= Input::get('park_region');
			$report_age_range			= Input::get('age_range');
			$report_park_managua 		= Input::get('managua_parks');
			$report_date_from			= date( 'Y-m-d H:i:s', strtotime( Input::get('from')));
			$report_date_to				= date( 'Y-m-d H:i:s', strtotime( Input::get('to')));


			$report_query_array = array();		

			# FILTER INFO 4 QUERY
			
			# define the table for query
			if( $report_type === 'users' ){

				# query to USERS TABLE
				$report_query_array['table'] = $report_type;

				# **************** 
				# WHERE LIKE
				# **************** 
				
				if( $report_park_region !== '' ){

					switch ($report_park_region) {

						case 'all_users':
							$report_query_array['and'] 			= '';
							$report_query_array['where_like'] 	= '';
							$report_query_array['where_colum']	= '';
							$report_query_array['like']	 		= '';
							$report_query_array['like_val']		= '';
						break;

						
						case 'managua':

							if( $report_park_managua !== '' ){

								switch ($report_park_managua) {
									
									case 'managua_park_all':
										# all users register in MANAGUA PARKS
										$report_query_array['and'] 			= 'AND';
										$report_query_array['where_like'] 	= '';
										$report_query_array['where_colum']	= 'parks_tags';
										$report_query_array['like']	 		= 'LIKE';
										$report_query_array['like_val']		= "'" . "%managua%" ."'";									 
									break;
									
									default:
										# single park
										$report_query_array['and'] 			= 'AND';
										$report_query_array['where_like'] 	= '';
										$report_query_array['where_colum']	= 'parks_tags';
										$report_query_array['like']	 		= 'LIKE';
										$report_query_array['like_val']		= "'" . "%" . $report_park_managua. "%" ."'";								
									break;
								}

							}else{
								// output ERROR
								$report_query_array['error'] = 'error_managua';
							}
						break;

						default:
							$report_query_array['and'] 			= 'AND';
							$report_query_array['where_like'] 	= '';
							$report_query_array['where_colum']	= 'parks_tags';
							$report_query_array['like']	 		= 'LIKE';
							$report_query_array['like_val']		= "'" . "%" . $report_park_region . "%" ."'";
						break;
					}

				}else{
					# generate error
					$report_query_array['error'] = 'error_region';
					
				}
			

				# **************** 
				# WHERE BETWEEN AGES
				# ****************
				$report_age_range_query_string = "";

				if( $report_age_range !== "" ){

					$age_range_val = explode("_", $report_age_range); 

					$report_age_range_query_string = " ";					
					$report_age_range_query_string .= "AND age BETWEEN";					
					$report_age_range_query_string .= " ";					
					$report_age_range_query_string .= intval($age_range_val[0]);					
					$report_age_range_query_string .= " ";					
					$report_age_range_query_string .= "AND";
					$report_age_range_query_string .= " ";					
					$report_age_range_query_string .= intval($age_range_val[1]);					
					$report_age_range_query_string .= " ";					


				}


			}else{
				# query to APs table
				$report_query_array['table'] = 'mareki_aps';
			}

			
			# CREATE REPORTS QUERY from imputs
			$report_query =  "SELECT * FROM " . $report_query_array['table'] . " WHERE date_register BETWEEN " . "'" . $report_date_from . "'". " AND " . "'" . $report_date_to . "'" . " " . $report_query_array['and']. " " .$report_query_array['where_like']." ".$report_query_array['where_colum']." ".$report_query_array['like']." ".$report_query_array['like_val']." ".$report_age_range_query_string;  
			// echo "query = ".$report_query;

			$users = DB::getInstance()->query($report_query);

			// $users = DB::getInstance()->query("SELECT id, email, name,age,sex,cell_number,date_register,mareki_meta,parks_tags FROM users ORDER BY date_register ASC");
			$users_array = $users->results();
			$users_num = $users->count();
		}	
			

		# GENERATE REPORT FORM QUERYS


		# get all the AP locations tag
		$aps_all_locations_array = DB::getInstance()->query("SELECT DISTINCT tags FROM mareki_aps ORDER BY tags ASC");
		$aps_all_locations = $aps_all_locations_array->results();
		# Aps with multiple tag in managua	
		$managua_string = 'managua';
		
		# store the tag string array
		$ap_tags_array = array();
		$ap_tags_managua = array();
		

		# get all department tags 	
		foreach( $aps_all_locations as $ap ){

			# convert to lower case
			$ap_tag = strtolower($ap->tags);

			# get all managua instance as one 	
			# check if the word managua exist in the string
			if( strpos( $ap_tag , $managua_string ) ){
				# found managua, 
				array_push($ap_tags_array,$managua_string);
			}else{
				array_push($ap_tags_array,$ap_tag);
			}

		}

		# get all managuas parks
		foreach ($aps_all_locations as $park ) {

			$park_tag = strtolower( $park->tags );
			
			if( strpos( $park_tag , $managua_string ) ){
			# managua founded in the string
				
				# remove managua from park tags
				$managua_parks = str_replace($managua_string, '', $park_tag);
				# store the tags for all managua parks
				array_push($ap_tags_managua, str_replace(' ', '', $managua_parks));
			}
		
		}



		# **************************************
		# LOAD HEADER
		# **************************************
		require( 'tpl_header.php' );

		?>

			<input type="hidden" id="page_id" value="page_reports">
		

			<div class="container" style="background:white">
				
				<div class="row">
				
					<div class="col-md-6 col-md-offset-3">
						<h3>Reportes Parques Alma</h3>
					</div>


					<!-- REPORTS BUILD -->
					<div class="col-md-12">

						<div class="portlet box blue ">
							
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-reorder"></i>
									Generar Reporte
								</div>

							</div>
							

							<div class="portlet-body form">

								<!-- BEGIN FORM-->
								<form class="form-horizontal form-bordered form-label-stripped" action="" method="post" id="form_generate_report">
									<div class="form-body">
										
										<!-- validation error  -->
										<div class="alert alert-danger display-hide">
											<button class="close" data-close="alert"></button>
											Falta Informacion Requerida. Favor Intentarlo nuevamente. 
										</div><!-- END - validation error  -->

										<!-- validation success -->
										<div class="alert alert-success display-hide">
											<button class="close" data-close="alert"></button>
											Your form validation is successful!
										</div><!-- END - validation success -->



										
										<!-- report name -->
										<div class="form-group">
											<label class="control-label col-md-3">Nombre de Reporte</label>
											<div class="col-md-9">
												<input type="text" placeholder="Nombre" class="form-control" id="report_name" name="report_name" />
											</div>
										</div><!-- END -  report name -->

										
										<!-- report type -->
										<div class="form-group">
											<label class="control-label col-md-3">
												Tipo de Reporte
												<span class="required">*</span>
											</label>

											<div class="col-md-9">
												
												<select class="form-control" id="report_type" name="report_type" >
													<option value="">Seleccionar Reporte</option>
													<option value="users">Usuarios</option>
													<!-- <option value="marekis_ap">Accesss Points</option> -->
												</select>
												
												<span class="help-block">
													Seleccionar que tipo de reporte desea generar.
												</span>
											</div>
										</div><!-- END - report type -->


										<!-- park_region -->
										<div class="form-group">
											<label class="control-label col-md-3">Region</label>
											<div class="col-md-9">
												<select class="form-control select2_category" name="park_region" id="park_region" disabled >
													<option value="">Seleccionar una Categoria</option>
													<option value="all_users">Todos Los Usuarios</option>
													<?php  
														# populate the option field with each DEPARTMENT TAGS
														foreach( array_unique( $ap_tags_array ) as $tag ){
															echo "<option value='".str_replace(' ', '', $tag)."'>".ucfirst(str_replace(' ', '', $tag))."</option>"; 
														}

													?>
												</select>
												<span class="help-block">
													Seleccionar Zona.
												</span>										
											</div>
										</div><!-- END - park_region -->


										<!-- parks_managua -->
										<div class="form-group">
											<label class="control-label col-md-3">Parques de Managua</label>
											<div class="col-md-9">
												
												<select class="form-control" id="managua_parks" name="managua_parks" disabled >
													<option value="">Seleccionar Parque</option>
													<option value="managua_park_all">Todos los parques Managua</option>
													<?php  
														foreach ( array_unique($ap_tags_managua) as $tag ) {
															echo "<option value='". $tag ."'>". ucfirst($tag) ."</option>"; 
														}
													?>
												</select>
												
												<span class="help-block">
													Parques Managua.
												</span>
											</div>
										</div><!-- END - parks_managua -->

		
										<!-- date range	 -->
										<div class="form-group last">
											<label class="control-label col-md-3">Rango de Fecha</label>
											<div class="col-md-4">
												<div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
													<input type="text" class="form-control" name="from" id="from">
													<span class="input-group-addon">
														Hasta
													</span>
													<input type="text" class="form-control" name="to" id="to">
												</div>
												<!-- /input-group -->
												<span class="help-block">
													Rango de Fecha de Reporte
												</span>
											</div>
										</div><!-- END date range	 -->




										<!-- age range	 -->
										<div class="form-group">
											<label class="control-label col-md-3">Rango de Edad</label>
											<div class="col-md-9">
												<select class="form-control select2_category" name="age_range" id="age_range"  >
													<option value="">Seleccionar una Opcion</option>
													<option value="0_10">0 a 10 años</option>
													<option value="11_15">11 a 15 años</option>
													<option value="16_20">16 a 20 años</option>
													<option value="21_30">21 a 30 años</option>
													<option value="31_40">31 a 40 años</option>
													<option value="41_100">41 a mas años</option>

												</select>
												<span class="help-block">
													Seleccionar Rango de Edad.
												</span>										
											</div>
										</div>
										<!-- END age range	 -->										


										
						
									</div>

									<div class="form-actions fluid">
										<div class="row">
											<div class="col-md-12">
												<div class="col-md-offset-3 col-md-9">
													<button type="submit" class="btn green"><i class="fa fa-check"></i> Generar Reporte</button>
													<!-- <button type="button" class="btn default">Cancel</button> -->
												</div>
											</div>
										</div>
									</div>
									


								</form><!-- END FORM-->
							</div>
						</div>					
					</div><!-- END - REPORTS BUILD -->




					<?php  

						if( Input::exists() ){

							?>

								<div class="col-md-12">

									<!-- BEGIN EXAMPLE TABLE PORTLET-->
									<div class="portlet box blue">
										
										<div class="portlet-title">
										
											<div class="caption">
												<i class="fa fa-users"></i>
												<span class="caption_name">
													<?php 

														if( $report_name ){	
															//+ " " + $report_date_from + "-" + $report_date_to
															echo $report_name;
														}else{
															echo $report_name = 'Usuarios Registrados';
														}

													?>
												</span>
												<strong>( <?php echo $users_num; ?> )</strong> 								
											</div>
										
											<div class="actions">
												<div class="btn-group">
													<a class="btn green" href="#" data-toggle="dropdown">
														<i class="fa fa-cogs"></i> Acciones <i class="fa fa-angle-down"></i>
													</a>
													<ul class="dropdown-menu pull-right">
														<!-- <li> 
															<a href="#">Convertir PDF</a>
														</li>-->
														
														<li>
															<a id="exportCsv" href="#">Convertir CSV</a>
														</li>
													</ul>
												</div>
											</div>
										</div>

										<div class="portlet-body">
											<table class="table table-striped table-bordered table-hover" id="sample_2">
												
												<thead>
													<tr>
														<th style="width1:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes"/></th>
														<th>ID</th>
														<th>Email</th>
														<th>Nombre</th>
														<th>Apellido</th>
														<th>Edad</th>
														<th>Sexo</th>
														<th>Celular</th>
														<th>Parque</th>
														<th>Registro</th>
														<th>user MAC</th>
													</tr>
												</thead>
											

												<tbody>

													<?php  
														foreach ($users_array as $user_obj) {
															
															$mareki_data_array = unserialize($user_obj->mareki_meta );
															// $ap_mac = $mareki_data_array['mac_ap'];
															$user_divice_mac = $mareki_data_array['client_mac'];		

															// $register_location = DB::getInstance()->get('mareki_aps', array('mac', '=', $ap_mac), 'parque');
															// $park = $register_location->first()->parque;	

															?>
																<tr class="odd gradeX">
																	<td><input type="checkbox" class="checkboxes" value="1"/></td>
																	<td><?php echo 'uid-'.escape( $user_obj->id ); ?></td>
																	<td><?php echo escape( $user_obj->email ); ?></td>
																	<td><?php echo escape( $user_obj->name ); ?></td>
																	<td><?php echo escape( $user_obj->last_name ); ?></td>
																	<td><?php echo "age-".escape( $user_obj->age ); ?></td>
																	<td><?php echo escape( $user_obj->sex ); ?></td>
																	<td><?php echo escape( $user_obj->cell_number ); ?></td>
																	<td><?php echo escape( $user_obj->parks_tags ); ?></td>
																	<td><?php echo escape( $user_obj->date_register ); ?></td>
																	<td><?php echo escape($user_divice_mac); ?></td>
																</tr>
															<?php
														}
													?>
												</tbody>
											
											</table>
										</div>
									</div><!-- END EXAMPLE TABLE PORTLET-->
								</div>

							<?php

						}


					?>	


				</div> <!-- END  / row -->
			</div> <!-- END  / page-content -->	


		<?php
		# **************************************
		# LOAD FOOTER
		# **************************************
		require('tpl_footer.php');



	}else{
	# no Admin	
		Redirect::to('index.php');
	}



}else{
# user NOTLOG
	Redirect::to('index.php');
}



?>