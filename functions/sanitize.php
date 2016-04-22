<?php  

# Sanitize input strings
# PASS: string to sanitize
# RETURN: string, html special charts sinitzie, quoatation, and utf-8 encoded
function escape( $string ){

	return htmlentities( $string, ENT_QUOTES, 'UTF-8' );

}



?>