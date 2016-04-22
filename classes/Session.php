<?php  


class Session{

	# check if session exists
	public static function exists( $name ){
		return (isset($_SESSION[$name])) ? true : false;
	}

	# put especific values in specific name of the session super global
	public static function put( $name, $value ){
		return $_SESSION[$name] = $value;
	}

	# get Token
	public static function get($name){
		return $_SESSION[$name];
	}


	# Delete the token
	public static function delete($name){
		# validate if the token already exists
		if( self::exists($name) ){
			unset( $_SESSION[$name] );
		}

	}

	# create message to out put to the user, and delete it after refreshing the page
	public static function flash( $name, $string=''){

		# check if the session exists 
		if( self::exists($name) ){
		# session does exists, set the value the is return to the session data	

			# store the session 
			$session = self::get($name);
			#delete the session
			self::delete($name);
			return $session;

		}else{
		# session does NOT exist, set the DATA
			self::put( $name, $string );	

		}


		// return '';	

	}


}

?>