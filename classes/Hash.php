<?php  


class Hash {


	public static function make( $string, $salt=''){
		# secure password using hash sha256 appendign salt to the given password string 	
		
	/*	
		echo 'comes from = '.$dbug;
		echo '<br>';
		echo 'string = '.$string;
		echo '<br>';
		echo 'salt = '.$salt;
		echo '<br>';
		echo 'HASH = '.hash('sha256', $string . $salt );
		echo '<br>';
		echo '<br>';
	*/
		return hash('sha256', $string . $salt );
	}

	public static function salt( $length ){
		# provid with random characters will be append it to the password string
		return mcrypt_create_iv( $length );

	}

	public static function unique(){
		# make the hash itself
		return self::make(uniqid());

	}


}



?>