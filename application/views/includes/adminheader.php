<!doctype html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en-gb" class="no-js"> <!--<![endif]-->

<head>
    <title>Dale Play - Dashboard<?php echo base_url();?></title>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url();?>images/favicon.png"/>
    
    <!-- Favicon --> 
    <link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.ico">
    
    <!-- this styles only adds some repairs on idevices  -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Google fonts - witch you want to use - (rest you can just remove) -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Dancing+Script:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,100,100italic,300,300italic,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
    
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <!-- ######### CSS STYLES ######### -->
    
    <link rel="stylesheet" href="<?php echo base_url();?>css/reset.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" />
    
    <!-- font awesome icons -->
    <link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome/css/font-awesome.min.css">
    
    <!-- simple line icons -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/simpleline-icons/simple-line-icons.css" media="screen" />
    
    <!-- animations -->
    <link href="<?php echo base_url();?>js/animations/css/animations.min.css" rel="stylesheet" type="text/css" media="all" />
    
    <!-- responsive devices styles -->
    <link rel="stylesheet" media="screen" href="<?php echo base_url();?>css/responsive-leyouts.css" type="text/css" />
    
    <!-- shortcodes -->
    <link rel="stylesheet" media="screen" href="<?php echo base_url();?>css/shortcodes.css" type="text/css" />
    
<!-- just remove the below comments witch color skin you want to use -->
    <!--<link rel="stylesheet" href="css/colors/blue.css" />-->
    <!--<link rel="stylesheet" href="css/colors/green.css" />-->
    <!--<link rel="stylesheet" href="css/colors/cyan.css" />-->
    <!--<link rel="stylesheet" href="css/colors/orange.css" />-->
    <!--<link rel="stylesheet" href="css/colors/lightblue.css" />-->
    <!--<link rel="stylesheet" href="css/colors/pink.css" />-->
    <!--<link rel="stylesheet" href="css/colors/purple.css" />-->
    <!--<link rel="stylesheet" href="css/colors/bridge.css" />-->
    <!--<link rel="stylesheet" href="css/colors/slate.css" />-->
    <!--<link rel="stylesheet" href="css/colors/yellow.css" />-->
    <!--<link rel="stylesheet" href="css/colors/darkred.css" />-->

<!-- just remove the below comments witch bg patterns you want to use --> 
    <!--<link rel="stylesheet" href="css/bg-patterns/pattern-default.css" />-->
    <!--<link rel="stylesheet" href="css/bg-patterns/pattern-one.css" />-->
    <!--<link rel="stylesheet" href="css/bg-patterns/pattern-two.css" />-->
    <!--<link rel="stylesheet" href="css/bg-patterns/pattern-three.css" />-->
    <!--<link rel="stylesheet" href="css/bg-patterns/pattern-four.css" />-->
    <!--<link rel="stylesheet" href="css/bg-patterns/pattern-five.css" />-->
    <!--<link rel="stylesheet" href="css/bg-patterns/pattern-six.css" />-->
    <!--<link rel="stylesheet" href="css/bg-patterns/pattern-seven.css" />-->
    <!--<link rel="stylesheet" href="css/bg-patterns/pattern-eight.css" />-->
    <!--<link rel="stylesheet" href="css/bg-patterns/pattern-nine.css" />-->
    <!--<link rel="stylesheet" href="css/bg-patterns/pattern-ten.css" />-->
    <!--<link rel="stylesheet" href="css/bg-patterns/pattern-eleven.css" />-->
    <!--<link rel="stylesheet" href="css/bg-patterns/pattern-twelve.css" />-->
    <!--<link rel="stylesheet" href="css/bg-patterns/pattern-thirteen.css" />-->
    
    <!-- mega menu -->
    <link href="<?php echo base_url();?>js/mainmenu/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>js/mainmenu/menu.css" rel="stylesheet">
    
    <!-- forms -->
    <link rel="stylesheet" href="<?php echo base_url();?>js/form/sky-forms2.css" type="text/css" media="all">
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/tabs/assets/css/responsive-tabs.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/tabs/assets/css/responsive-tabs2.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/tabs/assets/css/responsive-tabs3.css">
    
    <!-- angular-modal -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/angular-fancy-modal/angular-fancy-modal.min.css">    
		
	<!-- angular app https://code.angularjs.org/1.2.28/ -->
	<script src="<?php echo base_url();?>js/app/angular.min.js"></script>
	<script src="<?php echo base_url();?>js/app/angular-route.min.js"></script>
	<!--<script src="<?php echo base_url();?>js/app/ui-bootstrap-custom-tpls-0.12.0.js"></script>-->
	<script src="<?php echo base_url();?>js/app/ui-bootstrap-tpls-0.12.0.min.js"></script>
	<script src="<?php echo base_url();?>js/app/angular-timestamp-filter.js"></script>
	<script src="<?php echo base_url();?>js/angular-fancy-modal/angular-fancy-modal.min.js"></script> 
	<script src="<?php echo base_url();?>js/angular-file-upload/angular-file-upload-shim.min.js"></script>
	<script src="<?php echo base_url();?>js/angular-file-upload/angular-file-upload.min.js"></script>          			
	<script src="<?php echo base_url();?>js/app/app.js"></script>	
	<script src="<?php echo base_url();?>js/app/controllers.js"></script>
	
</head>

<body ng-app="App">