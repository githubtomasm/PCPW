<?php  

	class Validate {

		private $_passed = false,
				$_errors = array(),
				$_db	 = null;

		public function __construct(){
			# create an instance of the DB class, will run in the construct as soon as the class its call
			$this->_db = DB::getInstance(); 
		}			

		#
		# PASS: $source, string -> super global GET or POST, $items, array fields and rules set 
		# RETURN:
		public function check( $source, $items=array() ){


			# loop through the items array the contains the validation fields with repsective set of rules
			foreach( $items as $item => $rules ){
				# item-> array key
				# rules->array value (an other array) 

				# loop through the rules set for each validation field
				foreach( $rules as $rule => $rule_value  ){
					#$rule->key = require, min, max, unique
					#$rule_value = validate value ( boolean, table name, etc )
					
					# value from fields
					$value 	= trim( $source[$item] );
					$item 	= escape( $item ); 	

					# check if REQUIRED RULE exist
					# if rule require is present and no value for REQUIRED is pass in the POST or GET
					if( $rule === 'required' && empty( $value ) ){
					# field is REQUIRED and was not pass IN POST or GET, i decided to validate this with JS (login-soft.js) this will be use as a second tear for validation  
						# Add error to array for each case 
						$this->addError( "{$item} is required" );

					}else{
					# REQUIRED FILD was pass, proceed to validate rueles	

						# loop thruough all declare validation rules 
						switch ($rule):

							# check if string lenth of the input value is less than the rule value difined
							case 'min':

								if(strlen($value) < $rule_value ){
									# add error to Errors Array, so can be display if it fails
									$this->addError("{$item} must be a minimun of {$rule_value} Characters");
								}

								break; 

							case 'max':
								if(strlen($value) > $rule_value ){
									# add error to Errors Array, so can be display if it fails
									$this->addError("{$item} must be maximum of {$rule_value} Characters");
								}

								break;

							# check if the repaet password matches the password field  	
							case 'matches':

								if( $value != $source[$rule_value] ){
									$this->addError("{$rule_value} must match {$item}");
								}	

								break;

							# check for user name to be unique	
							case 'unique':
								# use the instance of the db called in the custructor
								# check in the db for a match betwen item and value
								$check =  $this->_db->get( $rule_value, array( $item, '=', $value ));

								# if there is a count, meaning a match is return, there is allready a user with this user name, display error
								if( $check->count()){	
									$this->addError( ucfirst($item)." Ya existe en registro. Favor intentarlo nuevamente.");
								}	

								break;																

						endswitch;

					}

				}

			}

			# check if the error array its empty or not
			if( empty($this->_errors) ){
			# NO errors, validation PASS 
				$this->_passed = true;	
			}

			// Session::flash('error_validation');
			return $this;
		}


		# addError, Store errors to an array
		private function addError( $error ){
			return $this->_errors[] = $error;
		}


		# Return list of error addError Arrys
		public function errors(){
			return $this->_errors;
		}		


		public function passed(){
			return $this->_passed;
		}








	} 


?>