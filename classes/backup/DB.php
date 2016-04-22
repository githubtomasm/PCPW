<?php  


# DB warper with PDO.
# using Singelton pattern, this way the DB can be instance in any part of the site using the object insted of conecting back to db every time that is need,
class DB{


	private static $_instance = null; # store instace of the DB any time the is abeliable
	private  $_pdo, 
			 $_query,
			 $_error = false,
			 $_results,
			 $_count = 0;


	# this will run when ever the class is instantieted
	# DB CONNECTION will be created as soon the clas is been instantieted
	# RETURN:		 	
	private function __construct(){
		
		try{

			# create connection 
			$this->_pdo = new PDO('mysql:host='. Config::get('mysql/host') .';dbname='.Config::get('mysql/db'), Config::get('mysql/user_name'), Config::get('mysql/password'));

		}catch(PDOExeption $e){
		# If there is an Error Connecting to the DB, DIE and get error	
			die( $e->getMessage() );
		}
	}		  


	# Check if the Object has been already instantieted, to create a new instance or ruturn already call instance
	# return, if object has been instatieted return the instance, else instantied the object	
	public static function getInstance(){

		# if the instance of the Class has not been created, any time the class run twise in a page it wont run more than once, and only will return the instance of the DB connection
		if( !isset( self::$_instance ) ){
			# set the instance of the Class, so the construc method run and the DB conection its created
			self::$_instance = new DB(); 

		}

		return self::$_instance;

	}

	# QUERY TO DB
	# PASS:
	# RETURN:
	public function query( $sql, $params = array() ){

		# reset error to false
		$this->_error =  false;

		#check fi the query was prepare succesfully
		if( $this->_query = $this->_pdo->prepare( $sql ) ){

			# counter for bind value to $param
			$x = 1;

			# query was prepare successfully, 
			#check if the params exist
			if(count($params)){

				foreach( $params as $param ){

					# bind value of the index $x to the value of the $param pass in the array
					# SELECT user FROM users WHERE username = ?, array('name')
					# ? == param index, name == param value
					$this->_query->bindValue($x, $param);
					$x++;
				}

			} # end if count($params)


			# execute the query, regardless of there were any params pass to the method
			if( $this->_query->execute() ){

				# store resutls as an object
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count	= $this->_query->rowCount();

			}else{
			# query was not executed succesfully get the error	
				
				$this->_error = true;

			}

		}

		return $this;

	}


	# 
	# PASS: $action-> the query action to execute, $table-> table name on the db, $where-> params of the query
	# RETURN:
	public function action( $action, $table, $where=array()  ){

		# check if the count of the where is pass in its == 3, needs to be, fiel, operator and a value
		if( count($where) === 3 ){

			# operators allows
			$operators =  array( '=', '>', '<', '>=','<=' );

			# get the operators need it from the $where array pass to the method
			$field 		= $where[0];
			$operator 	= $where[1];
			$value 		= $where[2];

			# validate if the operator passed in the $where array, is defined as an allow operator in the $operators array  
			if( in_array( $operator ,$operators )){

				# process the action with the params pass to through the method
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

				# if there is not an error perform a query with PDO method using the $sql with replacement value 
				if( !$this->query($sql, array($value))->error() ){

					return $this; 

				} 

			}

		}

		return false;

	}


	# 
	# PASS:
	# RETURN:
	public function get( $table, $where, $fields = '*' ){

		return $this->action("SELECT". " " .$fields ." ", $table, $where);
		// return $this->action("SELECT * FROM table WHERE user_name = loreias");
		// return $this->action("SELECT *", $table, $where);

	}



	# 
	# PASS:
	# RETURN:
	public function delete( $table, $where, $fields=' ' ){
		return $this->action("DELETE" . " ". $fields , $table, $where);
	}


	# INSERT TO DB 
	# PASS:
	# RETURN:
	public function insert( $table, $fields = array() ){

		# check if fields has data
		if( count($fields) ){

			
			# extract the keys of the array $fields, these are the fields will be update in the DB   
			$keys 	= array_keys( $fields );
			# keep track of the question mark for value replacement and sanitazi inside of the query	
			$values	= null;
			$x = 1;

			# get a list of "?" as replacement for the values, to apply porper sinitize
			foreach( $fields as $field ){
				# user the ? for replacement for values	in the query
				$values .= "?";
				if( $x < count($fields) ){
					$values .= ", ";
				}

				$x++;
			}


			#build query, this will store the QUERY for INSERTING data properly format and sanitazation
			$sql = "INSERT INTO ". $table . " " . "(`" . implode('`,`', $keys). "`) VALUES({$values})";

			# if there is no error executing the query
			if( !$this->query($sql, $fields)->error()){
				
				return true;

			}


		}

		return false;

	}



	# UPDATE DB 
	# PASS:
	# RETURN:
	public function update( $table, $id, $fields, $where_id = 'id' ){

		$set = "";
		$x=1;

		foreach( $fields as $name => $value ){

			$set .= "{$name} = ?";

			if( $x < count($fields)){

				$set .= ', ';
			}

			$x++; 

		}

		$sql = "UPDATE {$table} SET {$set} WHERE {$where_id} = {$id}";
		// $sql = "UPDATE table_name SET password = 'pass' WHERE id=3";

		# if the query does not get eny error
		if( !$this->query( $sql, $fields)->error()){

			return true;

		}

		return false;

	}



	# 
	# PASS:
	# RETURN:
	public function count(){
		return $this->_count;
	}


	# 
	# PASS:
	# RETURN:
	public function results(){

		return $this->_results;

	} 


	# 
	# PASS:
	# RETURN:
	public function first(){
		return $this->results()[0];
	}


	# ERROR fetching 
	# PASS:
	# RETURN:
	public function error(){

		return $this->_error;

	}




}// end DB Class


?>