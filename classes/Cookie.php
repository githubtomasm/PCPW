<?php 

class Cookie{


	# validate if cookie exist
	# return boolean if exist true otherwise false
	public static function exists( $name ){
		return ( isset( $_COOKIE[$name] ) ) ? true : false;
	}


	public static function get( $name ) {
		return $_COOKIE[$name];
	}


	public static function put( $name, $value, $expiry ){

		# set the cookie with pass parameters -> $name, $value, current time  + exipiration ( in seconds), path  
		if(setcookie( $name, $value, time() + $expiry, '/' )){
			return true;
		}

		return false;

	}

	public static function delete( $name ){
		# delete the cookien
		self::put( $name, '', time() - 1 );
	}

}

	

?>