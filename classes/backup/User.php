<?php  

class User{

	private $_db,
			$_data,
			$_session_name,
			$_cookie_name,
			$_is_logged_in;

	

	# create a db instance
	public function __construct( $user=null ){
		$this->_db = DB::getInstance();
		# get the session name value will.	
		$this->_session_name = Config::get('session/session_name');
		$this->_cookie_name  = Config::get('remember/cookie_name');

		# Used to check if user is login or not
		if( !$user ){

			# user has a session 	
			if(Session::exists($this->_session_name)){

				$user = Session::get($this->_session_name);

				# check if the user exists
				if($this->find($user)){
					
					$this->_is_logged_in = true;

				}else{
					# logout
					$this->_is_logged_in = falses;
				}
			}

		}else{
			# $user has beend defined 
			$this->find($user);
		}

	}



	public function update( $fields = array(), $id = null ){

		# update CURRENT user, if user id is nor provided and user is currently login,
		if( !$id && $this->is_logged_in()){
			# get user ID
			$id = $this->data()->id;
		}

		# update ESPECIFI user
		if( !$this->_db->update('users', $id, $fields) ){

			throw new Exception("There was a problem Updating");

		}

	}



	public function create( $fields = array(), $table = 'users' ){


		# if the insert query does not pass
		if( !$this->_db->insert( $table, $fields ) ){
			# error processing the query
			throw new Exception( 'Error al Crear Cuenta de Usuario, Favor tratar nuevamente.' );
		}
	}




	# find if pass value is present in the db
	public function find( $user = null ){

		if($user){

			# get if the serch will be using user ID or USER_NAME
			$field = (is_numeric($user)) ? 'id' : 'email';
			
			
			# query to db 
			$data = $this->_db->get('users', array( $field, '=', $user));

			# if there is match found
			if($data->count()){
			# user does exist

				#store user data, form the first and only resutl from the query
				$this->_data = $data->first();
				return true;

			}
		}

		return false;
	}


	#login method
	public function login( $user_name = null, $password = null, $remember = false, $forgot = false ){


		# if there is no user or passw pass and the user exists
		# automaticly login user
		# use for REMEMBER ME class functionality  
		if ( !$user_name && !$password && $this->exists() ) {
		# User alreday log
		
			# add to session data	
			Session::put( $this->_session_name, $this->data()->id );

		}else{
		# NO USER LOG
		# Get credentials and try to login	
			
			$user = $this->find( $user_name );
			
			if($user){

				# CHECK if login via NORMAL ACCESS or FORGOT PSW using phone number
				if( !$forgot ){
				# NORMAL login access	

					# verify the password ( reconstruc the password ) matches with the one store in the DB
					# retrive db SALT, then urldecode and reconstruc HASH psw
					# validate psw input and DB store r the same 
					if($this->data()->password === Hash::make( $password, rawurldecode($this->data()->salt) )){
					# VALIDATION PASS !! log user in

						# password verify, set user session
						Session::put( $this->_session_name, $this->data()->id );

						# validate remember field is check
						if($remember){

							# generate a hash
							# check if the hash does not exist in the db
							# store the hash 

							$hash = Hash::unique();

							# query to check if already has a HASH store in db
							$hash_check = $this->_db->get('users_sessions', array('user_id', '=', $this->data()->id));

							if( !$hash_check->count()){
								# no hash founded
								# store new hash in db
								$this->_db->insert('users_sessions' ,array(
									'user_id' 	=> $this->data()->id,
									'hash' 	=> $hash
								));
							}else{
								# hash founded
								$hash = $hash_check->first()->hash;

							}

							Cookie::put( $this->_cookie_name, $hash, Config::get( 'remember/cookie_expiry' ));

						}

						# Success MESAGE
						Session::flash('sucess_login', 'Su cuenta ha sido creada Exitosamente');

						return true;
					}else{
						# LOGIN VALIDATION FAIL, display error
						Session::flash('error_login', 'Error al Iniciar Sesion, Favor tratar nuevamente.');
					}

					
				}else{
				# FORGOT psw LOGIN access
					
					# check credentials
					# $password = phone number
					if( $this->data()->cell_hash === Hash::make( $password, rawurldecode($this->data()->salt)) ){

						# add to session
						Session::put( $this->_session_name, $this->data()->id );
						return true;
					}else{
					# phone data does not match	
						Session::flash('error_login_forgot', 'Error, Numero Celular no Encontrado.');
					}	

				}


			}else{
			# NO USR FOUDED
				Session::flash('error_login', 'Error al Iniciar Sesion, Favor tratar nuevamente.');
				Session::flash('error_login_forgot', 'Error al Iniciar Sesion, Favor tratar nuevamente.');
			}

		} // end else

		return false;
	}

	


	public function setCookie(){

		Cookie::put( $this->_cookie_name, $hash, Config::get( 'remember/cookie_expiry' ));

	}

	


	# validate if current user is ADMIN
	public function has_permission( $key ){

		# get the current user GROUP value -> int === id of the ROLE (admin / user) in the grups table	
		$group = $this->_db->get( 'groups', array( 'id', '=', $this->data()->group ) );

		# validate if grup value was found
		if( $group->count()){

			# get json OBJ from DB and them DECODED as an array
			$permissions = json_decode($group->first()->permissions, true );

			if( $permissions[$key] === 1 ){
				
				return true;	
			}
		}

		return false;

	}





	# validate if user exists by get data from it
	public function exists(){
		return (!empty( $this->_data ))? true : false;
	}


	

	# logout, delete, hashesh and cookies store in db 
	# will not remember user after
	public function logout(){
		
		# delete the hash from db	
		$this->_db->delete('users_sessions', array( 'user_id', '=', $this->data()->id ));	
		

		#delte back grom REGISTER btn
		Session::delete('back_to_index');		
		# delete marekis data
		Session::delete('mareki_data');
		Session::delete($this->_session_name);
		#delete the hash and the cookie
		Cookie::delete($this->_cookie_name);
		session_unset();
	}


	

	# return the array containing the query results
	public function data(){
		return $this->_data;
	}



	# return the login state flag
	public function is_logged_in(){
		return $this->_is_logged_in;
	} 

}




?>