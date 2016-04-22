<?php  

class Redirect{

	public static function to($location = null ){


		# check $location was pass
		if( $location ){

			# if is numeric value pass in $location , error page
			if( is_numeric( $location ) ){

				switch( $location ) :

					case 404 :
						header('HTTP/1.0 404 Not Found');
						include 'includes/errors/404.php';
						exit();
						break;

				endswitch;

			}

			header( 'location:'.$location );
			exit();
		}

	}


}


?>