<?php

require_once(__DIR__.'/lnUsers.php');

class lnAuth{
	
	function __construct(){

	}
	
	function login(){

		$lnUsers = new lnUsers();
		$user = $lnUsers-> getUserLogin($_POST['username'],$_POST['pass']); 

		if($user){

			session_start();
			$_SESSION['user'] = $user[0]; 

			header('Location:../home.php');

		}else{
			return array("error" => "incorrect data");
		}
		
	}
	
	function logout(){
		session_start();
		session_destroy();
		header('Location:../login.php');
	}
	
	function getAccess($page=""){
		
		session_start();
		
		if($page=="login"){
			
			if(isset($_SESSION['user'])){
				header('Location:home.php');
			}
			
		}else{
			
			if(!isset($_SESSION['user'])){
				header('Location:login.php?msg=Error');
			}
			
		}	
		
	}
	
}

?>