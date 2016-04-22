<?php  

class Input{

	# EXIST if post or get exist
	# PASS: post type
	# RETURN: boolean, true if post or get not empty, false otherwise
	public static function exists( $type = 'post' ){

		switch ( $type ):

			case 'post':
				return ( !empty($_POST) ) ? true : false;
				break;

			case 'get':
				return ( !empty($_GET) ) ? true : false; 					
				break;

			default:
				return false;
				break;	

		endswitch;

	}


	# GET fetch all data pass through via POST or GET super global
	# PASS: post type
	# RETURN: boolean, true if post or get not empty, false otherwise
	public static function get( $item ){

		if( isset($_POST[$item]) ){

			return $_POST[$item];
				
		}elseif( isset( $_GET[$item] ) ){

			return $_GET[$item];

		}

		# if no POST or GET output empty string
		return '';
	}


}

?>