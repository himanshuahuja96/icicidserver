<?php
		include_once('../includes/config.php');
						
					if (!isset($_REQUEST['username']) and !isset($_REQUEST['accesscode'])) {
						echo "No input received";
						}
					else{
						
							// Define $username and $password
							$username=$_REQUEST['username'];
							$accesscode=$_REQUEST['accesscode'];
							
							
							try{
									$sql= "SELECT * FROM users WHERE username = :username"; 
									$stmt = $db->prepare($sql);
									$stmt->bindParam(':username',$username); 
									$stmt->execute();
									$obj = $stmt->fetch(PDO::FETCH_ASSOC);
									$rc=$stmt->rowCount();
								}
								
								catch(PDOException $e) {
								  echo $e->getMessage();
								}
								
							if ($rc == 1) {
					
								if($accesscode==$obj['accesscode']){
									
									
									
									echo "Success";
														
								
								
								}
								else{
									
									echo "Invalid Details";
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
							
											
										echo "Account created";
								 
								 }
								 catch(Exception $ex){
									 
									echo $ex->getMessage(); 
								 }
								
							}
					
					
					}

?>
