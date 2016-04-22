<?php  
include_once 'core/init.php';
$user =  new User();

$salt_generate = Hash::salt(32);


$db = DB::getInstance();
$salt_obj = $db->get('users', array('id','=','43'), 'salt, password');
$salt = $salt_obj->results()[0]->salt;


$string = 'test';
$hash = Hash::make( $string, $salt );



$salt_special_char 			= htmlspecialchars($salt_generate, ENT_QUOTES, "UTF-8", false);
$salt_unicov 				= iconv('UTF-8', 'ASCII//TRANSLIT', $salt_generate);
$salt_html_entities 		= htmlentities( $salt_generate);
$salt_mb_converter 			= mb_convert_encoding( $salt_generate, "auto", "auto");
$salt_raw_enconde6			= rawurlencode($salt_generate);

echo '<br>';
echo 'ON THE FLY SALT = '.$salt_generate;
echo '<br>';
echo '<br>';


echo 'salt SPECIAL HTML CHARS = '.$salt_special_char;
echo '<br>';


echo 'salt UNICOV ='.$salt_unicov;
echo '<br>';

echo 'salt HTML ENTITIES = '.$salt_html_entities;
echo '<br>';					


echo 'salt utf-8 = '.$salt_mb_converter;
echo '<br>';

echo ' raw encode = '.$salt_raw_enconde;
echo '<br>';

$db->update('users', 43, array('salt'=>$salt_raw_enconde));




echo 'DB PSW = '.$salt_obj->results()[0]->password;
echo '<br>';
echo '<br>';
echo '<br>';

echo 'salt DB utf-8 = '.mb_convert_encoding( $salt, "auto", "auto");
echo '<br>';
echo '<br>';

echo 'salt URL DECODE = '.rawurldecode( $salt);
echo '<br>';
echo '<br>';



echo 'string = '.$string;
echo '<br>';


echo 'hash with db feed = '.$hash;
echo '<br>';


echo '<h1>SALT ENCODE</H1>'

?>