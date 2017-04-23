<?php
include('session.php');
if (isset($_POST['resetapp'])) {
	
	try{
		
		$sql = "UPDATE users SET reset = :reset 
            WHERE username = :username";
			
			$val=1;
				$stmt = $db->prepare($sql);                                  
				$stmt->bindParam(':reset',$val);       
				$stmt->bindParam(':username',$login_session);    
				  
				$stmt->execute(); 
		$_SESSION['resetreq']=1;
	}
	catch(Exception $ex){
		
		$_SESSION['resetdberror']=$ex->getMessage();
		
	}
	
	
	
	
}

?>

<!DOCTYPE html>
<html lang="en">
  
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">

    <title>Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/navbar.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">ICICI Dashboard</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="index.php">Home</a></li>
              
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="logout.php">Logout</a></li>
              
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h3>Welcome ,<?php echo strtoupper($login_session); ?></h3>
        <p>Reset App Data If You Have Lost Your Phone using Below Button</p>
        <p>
          
		  <form class="" method="post">
		  <button type="submit" name="resetapp" id="resetapp" class="btn btn-default navbar-btn">Reset Now</button>
		  </form>
        
		</p>
		
		<h2>
	  <span><?php 
	  
	  if(isset($_SESSION['reseterror']) or isset($_SESSION['resetreq']))
	  {
		if($_SESSION['resetreq']=='1'){
			
			echo "Success,Request Received. App will be Resetted if unknown User will try to open it";
		}
		else{
			
			echo $_SESSION['reseterror'];
		}
		
		}
	  
	  ?></span></h2>
		
      </div>

	  
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../assets/js/jquery.min.js"><\/script>')</script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>


</html>
