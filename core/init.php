<?php  

session_start();

# config data, data base, cookies
# HOTS use allways ip of host, will work better with PDO, if use domain name will take longer cuz makes a DNS TALBE LOOK UP to find the domain name and take a lot longer to load
$GLOBALS['config'] = array(
	#MySql settings
	'mysql'			=> array(
		'host'			=> 'localhost', 
		'user_name'		=> 'root',
		'password'		=> 'root',
		'db'			=> 'alcaldia_mareki'
	),

	# Cookies
	'remember'		=> array(
		'cookie_name'	=> 'hash',
		'cookie_expiry'	=> 604800 # one moth in seconds 
	), 

	#session and token
	'session'		=> array(
		'session_name'	=> 'user',
		'token_name' 	=> 'token' # token to autenticate page and avoid	 
	),

	'facebookAppId'	=> '1490778374534531' 
);


# load classes 
# load then using standar php library to load only the classes the has been call instend of requiring all of then
spl_autoload_register(  function ( $class ){
		# $class will be replace with the class name the its been call

		# work around calling the facebook api class, wich gives a problem with the SPL_AUTOLOAD_REGISTER, wich will try to call all class by the giving path
		# return in there the pass class has contains facebook string 
		$facebook_class = strpos( strtolower($class), 'facebook');
		
		# just use the class the do not contain whe word facebook in it 
		if( $facebook_class  === false  ){
			require_once 'classes/'. $class . '.php';
		}

	}
);



# load functions
require_once 'functions/sanitize.php';



# check if the cookie exist and the user is NOT loging
if( Cookie::exists( Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))){

	# cookie DOES exists
	# check if user is log or not

	# get the cookie
	$hash = Cookie::get( Config::get('remember/cookie_name') );


	# geth the hash from users session table
	$hash_check = DB::getInstance()->get('users_sessions', array('hash', '=', $hash));

	# validate if hashes match, log user in
	if( $hash_check->count() ){
		# hash store in db and cookie hash matches log user in

		$user =  new User( $hash_check->first()->user_id );

		$user->login(); 

	}

}	


# FACEBOOK API
require_once 'autoload.php';

# FACEBOOK api key
Facebook\FacebookSession::setDefaultApplication(Config::get('facebookAppId'), '2f4ff20a2e937de3c7b4988693aff66a');
# Facebook redirect url
$facebook = new Facebook\FacebookRedirectLoginHelper('http://beta.skyviewestimator.com/index.php');


try{
# handles process after coming back from facebook api for access
	if( $fb_api_session = $facebook->getSessionFromRedirect() ){
	# if there redirect method exists, facebook login btn has been click
	
		# get token generate by facebook api and store it in the session
		$_SESSION['facebook'] = $fb_api_session->getToken();
		// header('location: index.php'); 
	}


} catch( Facebook\FacebookRequestException $e  ){
# catch any errors from facebook api 

	echo 'Could not login to facebook try again later';
	echo "<br>";
	var_dump($e);
	header('location: index.php'); 

}catch ( \Exeception $e ){
# get normal exception Local problem 
	echo 'Could not login to facebook try again later';
	echo "<br>";
	var_dump($e);
	header('location: index.php'); 

}


?>