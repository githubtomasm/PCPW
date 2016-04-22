<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Mareki's Splash Page Alcalidia de Managua</title>
<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->


<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2-metronic.css"/>
<link rel="stylesheet" href="assets/plugins/data-tables/DT_bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-datepicker/css/datepicker.css"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME STYLES -->
<link href="assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="assets/css/pages/login-soft.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>

<!-- FACEBOOK API -->
<script src="assets/scripts/custom/facebook-api-scripts.js"></script>
</head>



<!-- BEGIN BODY -->
<body class="login">


<script type="text/javascript">
// Additional JS functions here
	window.fbAsyncInit = function() {
	  FB.init({
	    //appId      : "<?= Config::get('facebookAppId') ?>", // App ID
	    appId      : "200608606633019", // App ID
	    status     : true,    // check login status
	    cookie     : true,    // enable cookies to allow the server to access the session
	    xfbml      : true,     // parse page for xfbml or html5 social plugins like login button below
	    version    : 'v2.2',  // API version
	  });


	FB.getLoginStatus( function (response)
	{

	    if( response.status === 'connected' ){
	    // user is connected to facebook

	      //validate if the LIKE BTN has been pres alredy
	      //checkLike(response.authResponse.userID);


	    FB.api(
	        
	        "me/likes?fields=id,name&target_id=200608606633019",
	          
	        function (response) 
	        {
	            if (response && !response.error) {
	            /* handle the result */
	              console.log(response.data[0].id);
	            }
	        }
	    );                  
	          


	          FB.Event.subscribe('edge.create', function(response) {
	              console.log('create edge');
	        console.log(response); 
	          });


	          // Let's re-enable the form when someone "UnLikes" a Like button
	          FB.Event.subscribe("edge.remove", function(response){
	            console.log(response);
	            console.log('remove edge');
	          });           
	    

	    }else{
	    // user not connected, DENIED ACCESS TO INTERNET  

	      //do login to FB
	      alert('user not connected');

	    }

	  });
	};


	// Load the SDK Asynchronously
	(function(d, s, id){
	   var js, fjs = d.getElementsByTagName(s)[0];
	   if (d.getElementById(id)) {return;}
	   js = d.createElement(s); js.id = id;
	   js.src = "//connect.facebook.net/en_US/sdk.js";
	   fjs.parentNode.insertBefore(js, fjs);
	 }(document, 'script', 'facebook-jssdk'));

</script>    

	<div id="fb-root"></div>

	<div id="bg" class="container">

		<div id="island" class="bg_imgs_position">
			<img src="assets/img/bg/slice_center.png" alt="" class="col-xs-offset-1 col-sm-offset-2 col-md-offset-3 col-lg-offset-4 col-xs-10 col-sm-8 col-md-6 col-lg-4 img-responsive">
		</div>
		<!-- /center	 -->

		<ul id="waves" class="list-unstyled">
			<li class="wave"id="waves_back"></li>
			<li class="wave"id="waves_front"></li>
			<li class="wave"id="waves_top"></li>
		</ul>
		<!--/waves -->
		
		<!-- <img id="sun" src="assets/img/bg/slice_sun.png" alt="" class="col-xs-offset-10 col-sm-offset-10 col-md-offset-11 col-lg-offset-11 col-xs-2 col-sm-2 col-md-1 col-lg-1 img-responsive">	 -->

		<!-- 
		<ul id="clouds" class="bg_imgs_position list-unstyled">
			<li id="cloud_1" class="clouds"></li>
			<li id="cloud_2" class="clouds"></li>
		</ul>
		/clouds	 -->
		
		
		<!-- 
		<div id="mountain" class="bg_imgs_position">
			<img src="assets/img/bg/slice_momotombo.png" alt="" class="img-responsive">
			<img id="cloud_3" src="assets/img/bg/slice_claud.png" alt="" class="img-responsive">
			<img id="cloud_4" src="assets/img/bg/slice_claud.png" alt="" class="img-responsive">
		</div>
		/mountain	 -->
	</div>
	<!-- /bg	 -->


	<!-- BEGIN LOGO -->
	<div id="wifi-logo" class="logo l-padding-none">
		<a href="index.php">
			<img src="assets/img/wifi_logo.png" alt="Parques Wifi"/>
		</a>	
	</div>  <!--END LOGO -->	