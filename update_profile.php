<?php  


require_once 'core/init.php';

$user =  new User();

# if user is NOT login, redirect
if( !$user->is_logged_in()){
	Redirect::to('index.php');
}

# check token 
if( Input::exists()){
	if(Token::check(Input::get('token'))){

		# validate the filds are update with espected format and parameters
		$validate = new Validate();
		$validation = $validate->check( $_POST, array(
			'name' => array(
				'required' 	=> true,
				'min'		=> 2,
				'max' 		=> 50
			)
		));

		# check if validation has passed
		if( $validation->passed()){

			try{

				$user->update(array(
					'name' 	=> Input::get('name')
				));

				Session::flash('success', 'Your details have been updated');
				Redirect::to('index.php');

			}catch( Exeption $e ){
				die($e->getMessage());
			}

		}else{
		# validation failed
			# loop through the errors

			foreach($validation->errors() as $error ){
				echo $error.'<br>';
			}


		}

	}
}


?>



<form action="" method="post" >
	

	<label for="name">Name</label>
	<input type="text" name="name" id="name" value="<?php echo escape( $user->data()->name ); ?>" >
	<br>


	<input type="hidden" id="token" name="token" value="<?php echo Token::generate(); ?>" >	
	<input type="submit" value="Update">

	

</form>