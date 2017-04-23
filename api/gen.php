<?php

		include_once('../includes/config.php');
		
		$response=-1;
			
		if(!empty($_POST['token'] && $_POST['atmid'])){
			
			$vartoken=$_POST['token'];
			$varatmid=$_POST['atmid'];
			//changed to dynamic;
			$varatmid=$_SERVER['REMOTE_ADDR'];
			
			//row count variable
			$total=-1;
			try{
				
				$sql= "SELECT * FROM atmtoken WHERE atmid = :atmid";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':atmid', $varatmid);
				$stmt->execute();
				$total = $stmt->rowCount();
			}
			catch(PDOException $e) {
              echo $e->getMessage();
            }
			
			if($total<=0){		
			
				try {
					 $sql ="INSERT INTO atmtoken (token,atmid,time,iciciuserid,acc_rej) 
					 VALUES (
					:token,
					:atmid,
					:time,
					:iciciuserid,
					:acc_rej)";
					$now=date('Y-m-d H:i:s');
					 $stmt = $db->prepare($sql);
					 $stmt->bindValue(":token",$vartoken);
					 $stmt->bindValue(":atmid",$varatmid);
					 $stmt->bindValue(":time",$now);
					 $stmt->bindValue(":iciciuserid",-1);
					 $stmt->bindValue(":acc_rej",-1);
					 $stmt->execute();
					
					$response=1;


					}
					catch(PDOException $e) {
					  echo $e->getMessage();
					}
			}else{
			
				try{
						$sql = "UPDATE atmtoken SET token = :newtoken, 
						time = :newtime
						WHERE atmid = :atmid";
						$newnow=date('Y-m-d H:i:s');
						$stmt = $db->prepare($sql); 
						$stmt->bindValue(":newtoken",$vartoken);
						$stmt->bindValue(":newtime",$newnow);
						$stmt->bindValue(":atmid",$varatmid);
						$stmt->execute(); 
				}
				
					catch(PDOException $e) {
					  echo $e->getMessage();
					}
				
				
			$response=2;
			
			}
			
		}else{
			
			$response=0;
			//echo $_POST['token'];
			
			//echo $_POST['atmid'];
			
			}
		
		echo $response;
		
?>