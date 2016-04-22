<?php  

# help to avoid Cross-Site Request Forgery
class Token{

	# create a token will be unique for the users load page, this will be store in the user session so, user ke be identy and the only manipulating the form
	public static function generate(){
	# generate token

		$current_token = md5(uniqid());



		# NOTE: when user redicted by mareki, this will update more than ones, this will generete 3 different TOKENS in the same pass, wich will FAIL the validation for TOKEN check, now will collect the different session token and compare it to the POST token

		if( $_SESSION['token'] ){
		# toker already exist in session
			Session::put( config::get('session/token_name'), $_SESSION['token']."-". $current_token  );	
		}else{
		# first time token been gene	
			Session::put(config::get('session/token_name'), $current_token);
			// return Session::put(config::get('session/token_name'), md5(uniqid()));
		}

		return $current_token;

	}


	# determinate if token exist in the user session, and match the token supply in the form, if it matches, delete the token
	public static function check( $token ){

		# get the token id store in the user session super global
		$token_name =  Config::get('session/token_name');


		$session_token_string = Session::get($token_name);
		$session_token_array = explode('-', $session_token_string);


		# check if the session token and the token pass in the form matches
		// if( Session::exists( $token_name ) && $token === Session::get($token_name) ){
		if( Session::exists( $token_name ) && in_array($token, $session_token_array ) ){
				# token session and token form matches, delete token  
				Session::delete($token_name);
				return true;
		}	

		return false;		

	}


}


?>