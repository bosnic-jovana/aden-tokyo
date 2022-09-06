<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php
		$pages = ["home","accommodation","gallery","contact","login","register"];
		$uri = $_SERVER['REQUEST_URI'];

		foreach($pages as $page){
			if(strpos($uri, $page)){
				include_once("views/fixed/head/head-$page.php");
			}
			//dodati za index bez home, ne radi else
		}
	?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Jovana Bosnić" />
	<link rel="shortcut icon" href="assets/images/aden.ico">
	<link rel="stylesheet" href="assets/css/superfish.css">
	<link rel="stylesheet" href="assets/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="assets/css/cs-select.css">
	<link rel="stylesheet" href="assets/css/cs-skin-border.css">
	<link rel="stylesheet" href="assets/css/themify-icons.css">
	<link rel="stylesheet" href="assets/css/flaticon.css">
	<link rel="stylesheet" href="assets/css/icomoon.css">
	<link rel="stylesheet" href="assets/css/flexslider.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/lightbox.min.css">
	<link rel="stylesheet" href="assets/css/my-style.css">
	<script src="assets/js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
		<script src="js/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	