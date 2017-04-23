<?php
include_once('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
header("location: profile.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login </title>
<link href="../assets/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="main">
<h1 >Login To Account</h1>
<div id="login">
<h2>Login Form</h2>
<form action="" method="post">
<label>UserName :</label>
<input id="name" name="username" placeholder="username" type="text">
<label>AccessPassword :</label>
<input id="accesscode" name="accesscode" placeholder="**********" type="password">
<input name="submit" type="submit" value=" Login ">
<span>
	<?php 
		if(isset($_SESSION['error']) or isset($_SESSION['status']))
			{
			
			if($_SESSION['status']=='-1'){
			echo "Fields are Empty";
			}
			else if($_SESSION['status']=='0'){
			echo "Your Accesscode is Wrong";
			}
			else if($_SESSION['status']=='2'){
				
				echo "Account Created Successfully";
			}
			/*else if($_SESSION['status']=='-2' or $_SESSION['error']=='-2'){
				
				echo "pta ni kya hua";
				
			}*/
			else{
				echo $_SESSION['error'];
			}
			
			//echo $_SESSION['accesscode'];
			
			unset($_SESSION['status']);
			unset($_SESSION['error']);
			
			}?>
			
	</span>
</form>
</div>
</div>
</body>
</html>