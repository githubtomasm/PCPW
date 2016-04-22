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

				# loop through the rules set for each validation field
				foreach( $rules as $rule => $rule_value  ){
					#value from fields
					$value =  $source[$item];
					// echo $value."<br>";

					# check if exist
					if( $rule === 'required' && empty($value) ){


					}
				}

			}

		}



		#
		# PASS: $source, string -> super global GET or POST, $items, array fields and rules set 
		# RETURN:
		private function addError(){} 



	} 


?>