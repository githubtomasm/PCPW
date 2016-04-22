<?php  

# Access all of the config data from the config init CONSTANTS array 
# RETURN, string, value of config pass to the class, format array level sperate it with /, mysql/host -> 127.0.0.1 (host ip)
Class Config{

	# FETCH values form config constant
	# PASS: string , key value sparete it by / match key from confing array
	# RETURN : string, config value  
	# NOTE IMPROVE, the method its only validating if a value was pass through the $path, and it's not validating if the $path values exist as key inside the config array
	public static function get( $path = null ){

		# path, this contains the key of the array data to fetch separate by /, set as null by default so can determinate if a value was pass

		if($path){
		# path exist, proccess the method	
			
			$config 	= $GLOBALS['config'];
			# create an array from the pass value in $path, use the / as delimitite
			$path		= explode( '/', $path );


			# loop througth the elements of the $path array
			foreach( $path as $bit ){

				# check if the elements of the $path array are set on the $config array, this will check for the first key level in the $config array and the firts element of the $path array in the firts loop
				if( isset( $config[$bit]  ) ){
					# this will set $config to value to the matching $config key and first $path element, so in the second loop if there is any other level will go inside the next level of the array and as meny as are set
					$config = $config[ $bit ];

				}


			} 		

			return $config;	
		}


		# if nathing was pass to the object
		return false;


	}


}



?>