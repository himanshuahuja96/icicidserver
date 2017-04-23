<?php
// include Database connection file
include("../includes/config.php");

		if(isset($_REQUEST['token']) or isset($_REQUEST['iciciuserid']) or isset($_REQUEST['acc_rej']) !==""){
		
		if($_REQUEST['type']=='check'){
			
			//echo "check";
			//print_r($_POST);
			//echo $_POST['token'];
		$rc=0;
			try{
				$sql= "SELECT iciciuserid,atmid FROM atmtoken WHERE token = :token"; 
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':token', $_REQUEST['token']); 
				$stmt->execute();
				$obj = $stmt->fetch(PDO::FETCH_ASSOC);
				$rc=$stmt->rowCount();
			}
			
				catch(PDOException $e) {
		              echo $e->getMessage();
            }
				if($rc>0){
				header('Content-Type: application/json');			
				 echo (json_encode($obj));	
					}else{
					echo -1;
				}

			
		}
		else if($_REQUEST['type']=='update'){
			
			try{
				$sql = "UPDATE atmtoken SET iciciuserid = :iciciuserid, 
						acc_rej = :acc_rej 
						WHERE token = :token";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':token', $_REQUEST['token']); 
				$stmt->bindParam(':iciciuserid',$_REQUEST['iciciuserid']); 
				$stmt->bindParam(':acc_rej',$_REQUEST['acc_rej']); 
				$stmt->execute();
				$rc=$stmt->rowCount();
								
				if($rc>0){
					echo 1;
				}
				else{
					echo 0;
				}
				
			}
			
			catch(PDOException $e) {
              echo $e->getMessage();
            }
			
		}
		else if($_REQUEST['type']=='logout'){
			
			
			try{
				$sql = "DELETE FROM atmtoken WHERE iciciuserid =:iciciuserid";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':iciciuserid', $_REQUEST['iciciuserid'],PDO::PARAM_STR); 
				$stmt->execute();
				$rc=$stmt->rowCount();
								
				if($rc>0){
					echo 1;
				}
				else{
					echo 0;
				}
								
			}
			
			catch(PDOException $e) {
              echo $e->getMessage();
            }
			
		}
		
		}
		
		?>
