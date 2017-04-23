<?php
		include_once('../includes/config.php');
				
				
				if(!isset($_SESSION)){session_start();} // Starting Session
			
			
			if (isset($_POST['submit'])) {
					
					
					if (empty($_POST['username']) || empty($_POST['accesscode'])) {
						$_SESSION['status'] = -1;
						}
					else{
						
							// Define $username and $password
							$username=$_POST['username'];
							$accesscode=$_POST['accesscode'];
							
							
							try{
									$sql= "SELECT * FROM users WHERE username = :username"; 
									$stmt = $db->prepare($sql);
									$stmt->bindParam(':username',$username); 
									$stmt->execute();
									$obj = $stmt->fetch(PDO::FETCH_ASSOC);
									$rc=$stmt->rowCount();
								}
								
								catch(PDOException $e) {
								  $_SESSION['error']=$e->getMessage();
								}
								
							if ($rc == 1) {
					
								if($accesscode==$obj['accesscode']){
									
									$_SESSION['status']=1;
									$_SESSION['login_user']=$username; // Initializing Session

									$_SESSION['token']=$obj['token'];
									header("location: profile.php"); // Redirecting To Dashboard Page
								}
								else{
									$_SESSION['status']=0;  //accesscode not matching
									header("location: index.php");
								}
							
							}
							
							else {
					 
					 //post request
									// create curl resource
										$ch = curl_init();


										$url="https://corporateapiprojectwar.mybluemix.net/corporate_banking/mybank/authenticate_client?client_id=$username&password=$accesscode";

										//echo $url;

										curl_setopt($ch, CURLOPT_URL,$url);
                                                //return the transfer as a string
                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                                                // $output contains the output string
                                                $output = curl_exec($ch);

                                                //echo $output;

                                                // close curl resource to free up system resources

                                                curl_close($ch);

											// close curl resource to free up system resources 
											curl_close($ch);      
					 
					 
								 try{
									//Account Created
										$sql = "INSERT INTO users(username,accesscode,token)
										VALUES (
												:username, 
												:accesscode, 
												:token
											)";
																							  
										$stmt = $db->prepare($sql);
																					  
										$stmt->bindParam(':username',$username);       
										$stmt->bindParam(':accesscode',$accesscode); 
										$stmt->bindParam(':token',$output);
										 
																			  
										$stmt->execute(); 
							
									$_SESSION['status']=2;
										
								 header("location: index.php"); // Redirecting To Other Page
								 }
								 catch(Exception $ex){
									 
									$_SESSION['error'] =$ex->getMessage(); 
								 }
								
							}
					
					
					}
					
			}

?>