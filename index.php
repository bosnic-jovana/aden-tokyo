<?php
	session_start();
    include "config/connection.php";
	include "models/functions.php";
    include "views/fixed/head/head.php";
    include "views/fixed/header.php";

	if(isset($_GET["page"])){
		switch($_GET["page"]){
			case 'home':
				include "views/pages/home.php";
				break;
			case 'accommodation':
				include "views/fixed/background.php";
				include "views/pages/accommodation.php";
				break;
			case 'accommodations':
				include "views/fixed/background.php";
				include "views/pages/accommodations.php";
				break;
			case 'gallery':
				include "views/fixed/background.php";
				include "views/pages/gallery.php";
				break;
			case 'contact':
				include "views/fixed/background.php";
				include "views/pages/contact.php";
				break;
			case 'register':
				include "views/fixed/background.php";
				include "views/pages/register.php";
				break;
			case 'login':
				include "views/fixed/background.php";
				include "views/pages/login.php";
				break;
			case 'reservations':
				include "views/fixed/background.php";
				include "views/pages/reservations.php";
				break;
			case 'author':
				include "views/fixed/background.php";
				include "views/pages/author.php";
				break;
		}
		if($page == "admin"){
			if(isset($_SESSION["user"])){
        		if($_SESSION["user"]->id_role == 1){
            		include "views/fixed/background.php";
					include "views/pages/admin.php";
        		}
				else{
					header("Location: 403.php");
				}
			}
			else{
				header("Location: 403.php");
			}
		}
	  } 
	  else {
		include "views/pages/home.php";
	  }

    include "views/fixed/footer.php";
?>