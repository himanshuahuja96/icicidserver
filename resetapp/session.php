<?php

include_once('../includes/config.php');


		$login_session =$_SESSION['login_user'];
			try{
			$sql= "SELECT * FROM users WHERE username = :username"; 
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':username',$login_session); 
				$stmt->execute();
				$obj = $stmt->fetch(PDO::FETCH_ASSOC);
				$rc=$stmt->rowCount();
			}
			
			catch(PDOException $e) {
              $_SESSION['error']=$e->getMessage();
            }
			
			
			if(!isset($login_session)){

			header('Location: index.php'); // Redirecting To Home Page
				}
?>