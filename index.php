<?php

/*
http://beta.skyviewestimator.com/index.php?base_grant_url=test&node_mac=00:18:0a:xx:xx:xx&client_mac=xx:xx:xx:xx:xx:xx
22937672
facebook
app id
1490778374534531
app secret
2f4ff20a2e937de3c7b4988693aff66a
*/

include_once 'core/init.php';
$user = new User;


# first validation 2 DISPLAY FORM
# validate if user has cookie, and hash from REMEMBER ME input
if($user->is_logged_in()){
# user has session active via HASH and cookie


	// echo 'redirect to profile-> user is currently log in LOGIN.PHP';	
	# redirect to profile are	
	Redirect::to('profile.php');


}elseif( isset($_SESSION['facebook']) ){
# USER IS LOGIN VIA FACEBOOK,  
# facebook session exist


	# get user data from facebook api
	# create request, execute request and get user data
	# add user info to DB if already added log in the user 	

	// session wich is the token generate by facebook api
	$fb_session = new Facebook\FacebookSession($_SESSION['facebook']);
	
	// request retrive info about user
	// $fb_session = token been validated, GET = method, /me = user details
	$fb_request = new Facebook\FacebookRequest($fb_session, 'GET', '/me');

	// execute the request
	$fb_request = $fb_request->execute();

	# get user data
	$fb_user_info =  $fb_request->getGraphObject()->asArray();

	#######################################
	# LOGIN / CREATE USER FROM FACEBOOK API
	#######################################

	#calculate the FB_USER_AGE
	$fb_user_age = date_diff(date_create($fb_user_info['birthday']), date_create('today'))->y;	

	$fb_user_info_array = array(
		'email'						=>	$fb_user_info['email'],	
		'name' 						=>	$fb_user_info['first_name'],
		'last_name'					=>	$fb_user_info['last_name'],
		'age' 						=>	$fb_user_age,
		'sex' 						=>	$fb_user_info['gender'],
		'facebook_register'			=>	$fb_user_info['id']
	);


	if( Session::exists('mareki_data')){
	# marki's data exist in the session, retrive array	
		$mareki = Session::get('mareki_data');

	}

	# LOGIN/CRETE user
	$login = $user->login_facebook( $fb_user_info['email'], $fb_user_info_array, $mareki );

	if( $login ){
	# login / register user SUCCESSFULL
		Redirect::to('profile.php');	

	}else{
	# login / register user FAIL
		Redirect::to('index.php');	

	}


}else{
# no session founded, user is NOT LOGIN YET
# either a new SUBSCRIBER or an already existing USER

	# validate if meraki's variable are present in the query string
	if( $_GET['base_grant_url'] && $_GET['node_mac'] && $_GET['client_mac'] ){
	# Mareki's data present in the query string, 
	#DISPLAY ACCESS/LOGIN FORM 


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
			'client_mac'	=> $client_mac,
			'grant_url'		=> $grant_url
		);

		# get park LOCATION
		# use AP's mac to get location 
		$aps_mac = DB::getInstance()->get( 'mareki_aps', array('mac', '=', $mac_ap ), 'parque' );
		
		if( $aps_mac ){
		
			Session::put('parks_name', $aps_mac->results()[0]->parque );
			
		}		 	


		# save marekis data to  session
		$mareki_data_serialize = serialize( $mareki_data_array );
		$mareki_session = Session::put('mareki_data', $mareki_data_serialize );


		# **************************************
		# START HTML
		# **************************************
		require_once 'login.php';	

	}elseif( Session::exists('mareki_data') ){
	# if marekis data exist USER SESSION
	# display login/register

		# **************************************
		# START HTML
		# **************************************
		require_once 'login.php';


	}else{
	# un Autorize Access redirecto to JP.	
		
		// echo "redirect user to JP -> no mareki data get or session ";
		die( Redirect::to('https://es-es.facebook.com/JuventudPresidente'));

	}

} #end else USER LOG IN


?>