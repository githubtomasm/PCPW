var Login = function () {

	var handleLogin = function() {

		console.log($('#page_id').val());

		// check wich form to validate
	    if ($('#page_id').val() === 'page_register'){
	   	// register form
	
	        $('.login-form').validate({
		            errorElement: 'span', //default input error message container
		            errorClass: 'help-block custom-alert-error', // default input error message class
		            focusInvalid: false, // do not focus the last invalid input
		            ignore: "",
		            rules: {
		                
		                name: {
		                    required: true,
							minlength:2,
							maxlength:50
		                },

		                last_name: {
		                    required: true,
							minlength:2,
							maxlength:50
		                },		                

		                age:{
		                	required: true,
			                number:true,
		                },

		                sex:{
		                	required: true
		                },		                

		                email: {
		                    required: true,
		                    email: true
		                },

		                password: {
		                    required: true,
		                	minlength: 4
		                },

		                rpassword: {
		                    equalTo: "#password"
		                },

		                cell_number: {
			                number:true,
			                rangelength:[8,15]
		                }

		            },


		            messages: {
		            	name: 	{
		            		required: "Nombre Completo es Requerido.",
		            		minlength: "Favor Introducir un Nombre con menos 2 Caracteres." 
		            	},

		            	last_name: 	{
		            		required: "Apellidos son Requeridos.",
		            		minlength: "Favor Introducir un Nombre con menos 2 Caracteres." 
		            	},

		            	age: 	{
		            		required: "Este Campo es Requerido",
		            		number: "Favor Introducir un numero Valido." 
		            	},

		            	sex: 	{
		            		required: "Este Campo es Requerido." 
		            	},		            			            	

		                email: {
		                    required: "Dirección de Correo Electrónico es Requerida.",
		                    email: "Favor Introducir un Email valido."
		                },
		                
		                password: {
		                    required: "Contraseña es Requerida.",
		                    minlength: "Tamaño minimo de Contraseña 4 caracteres."
		                },

						rpassword: {
		                    equalTo: "Favor Introducir la misma Contraseña nuevamente."
		                },

						cell_number: {
		                    number: "Favor Introducir numero Celular Valido sin espacios.",
		                	rangelength: "Favor Introducir numero Celular no mayor a 8 caracteres."
		                }		                		                
		            
		            },


		            invalidHandler: function (event, validator) { //display error alert on form submit   
		                $('.alert-danger', $('.login-form')).show();
		            },

		            highlight: function (element) { // hightlight error inputs
		                $(element)
		                    .closest('.form-group').addClass('has-error'); // set error class to the control group
		            },

		            success: function (label) {
		                label.closest('.form-group').removeClass('has-error');
		                label.remove();
		            },

		            errorPlacement: function (error, element) {
		                if (element.attr("name") == "tnc") { // insert checkbox errors after the container                  
		                    error.insertAfter($('#register_tnc_error'));
		                } else if (element.closest('.input-icon').size() === 1) {
		                    error.insertAfter(element.closest('.input-icon'));
		                } else {
		                	error.insertAfter(element);
		                }
		            },

		            submitHandler: function (form) {
		                form.submit();
		            }
		    });


	    }else if( $('#page_id').val() === 'page_forgot_pasw' ){
	    // forgot psw form	

			$('.login-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block custom-alert-error', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            ignore: "",
	            
	            rules: {
	                email: {
	                    required: true,
	                    email: true
	                },
	            
	                cell_number:{
	                    required: true,	                	
		                number:true,
		                rangelength:[8,15]
	                }
	            },

	            messages: {
	                email: {
	                    required: "Email es Requerido.",
	                    email: "Favor Introducir un Email valido."
	                },

	                cell_number:{
	                    required: "Numero Celular es Requerido.",	                	
	                    number: "Favor Introducir numero Celular Valido sin espacios.",
	                	rangelength: "Favor Introducir numero Celular no mayor a 8 caracteres."
	                }	                
	            },


	            highlight: function (element) { // hightlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            errorPlacement: function (error, element) {
	                error.insertAfter(element.closest('.input-icon'));
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
		    });


	    }else if( $('#page_id').val() === 'page_forgot_reset' ){
	    // reset PSW

			$('.login-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block custom-alert-error', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            ignore: "",
	            
	            rules: {
	                password_current: {
	                    required: true,
	                },
	            
	                password_new:{
	                    required: true,	                	
	                	minlength: 4
	                },

	                password_repeat:{
	                    equalTo: "#password_new"
	                }

	            },

	            messages: {

	            	password_current:{
	            		required: "Contraseña es Requerida."
	            	},

	            	password_new:{
	                    required: "Nueva Contraseña es Requerida.",
	                    minlength: "Tamaño minimo de Contraseña 4 caracteres."	            	
	            	},

	            	password_repeat:{
	                    equalTo: "Favor Introducir la misma Contraseña nuevamente."	            		
	            	}

               
	            },


	            highlight: function (element) { // hightlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            errorPlacement: function (error, element) {
	                error.insertAfter(element.closest('.input-icon'));
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
		    });	    	


	    }else{
	    	// login form
			$('.login-form').validate({
		            errorElement: 'span', //default input error message container
		            errorClass: 'help-block custom-alert-error', // default input error message class
		            focusInvalid: false, // do not focus the last invalid input
		            rules: {
		                email: {
		                    required: true,
		                    email:true
		                },
		                password: {
		                    required: true
		                },
		                remember: {
		                    required: false
		                }
		            },

		            messages: {
		                email: {
		                    required: "Email es Requerido.",
		                    email: "Favor Introducir un Email valido."		                    
		                },
		                password: {
		                    required: "Contraseña es Requerida."
		                }
		            },

		            invalidHandler: function (event, validator) { //display error alert on form submit   
		                $('.alert-danger', $('.login-form')).show();
		            },

		            highlight: function (element) { // hightlight error inputs
		                $(element)
		                    .closest('.form-group').addClass('has-error'); // set error class to the control group
		            },

		            success: function (label) {
		                label.closest('.form-group').removeClass('has-error');
		                label.remove();
		            },

		            errorPlacement: function (error, element) {
		                error.insertAfter(element.closest('.input-icon'));
		            },

		            submitHandler: function (form) {
		                form.submit();
		            }
		    });
	    	
	    }

     

        $('.login-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.login-form').validate().form()) {
                    $('.login-form').submit();
                }
                return false;
            }
        });

	}

	var handleForgetPassword = function () {


	      

	        $('.forget-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.forget-form').validate().form()) {
	                    $('.forget-form').submit();
	                }
	                return false;
	            }
	        });

	        /*jQuery('#forget-password').click(function () {
	            jQuery('.login-form').hide();
	            jQuery('.forget-form').show();
	        });

	        jQuery('#back-btn').click(function () {
	            jQuery('.login-form').show();
	            jQuery('.forget-form').hide();
	        });*/

	}

	var handleRegister = function () {


			$('.register-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.register-form').validate().form()) {
	                    $('.register-form').submit();
	                }
	                return false;
	            }
	        });

	        /*jQuery('#register-btn').click(function () {
	            jQuery('.login-form').hide();
	            jQuery('.register-form').show();
	        });*/

	        /*jQuery('#register-back-btn').click(function () {
	            jQuery('.login-form').show();
	            jQuery('.register-form').hide();
	        });*/
	}
    
    return {
        //main function to initiate the module
        init: function () {
        	
            // handleRegister();
            handleLogin();
            //handleForgetPassword();

	       	$.backstretch([
		        "assets/img/bg/bg-1.jpg",
		        "assets/img/bg/2.jpg",
		        "assets/img/bg/3.jpg",
		        // "assets/img/bg/bg_day.jpg",
		        // "assets/img/bg/bg_nigth.jpg",
		        // "assets/img/bg/4.jpg"
		        ], {
		          fade: 1000,
		          duration: 800000
		    });
        }
    };

}();