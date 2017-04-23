<?php

?>


<html>
<head>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<title>ATM LOGIN USING QRCODE LOGIN</title>
</head>
<style type="text/css">
            body {
                background-color:#3686be;
                color:#FFF;
                border:0px;
                margin:0px;
                overflow:hidden;
            }
            .wrapper {
                position:absolute;
                top:15%;
                left:0px;
                right:0px;
                width:100%;
                height:auto;
            }
            .sammy {
                float:left;
                width:100%;
                height:auto;
                text-align:center;
            }
            .message {
                float:left;
                width:100%;
                height:auto;
                font-size:36px;
                text-align:center;
                font-family:Arial,Helvetica,sans-serif;
                margin-top:25px;
            }
        </style>

<body>
<div class="wrapper">
<div id="sammy" align="center">
    
</div>
<div class="message" id="message">Please log into your ATM by Scanning This QR Code in App</div>
</div>
    <script type="text/javascript">
	var randomString = function(length) {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for(var i = 0; i < length; i++) {
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    }
    return text;
	}
	
	$(document).ready(function () {
	
    var seconds = 20000; // time in milliseconds
    var atmid="hrynr01";
	
	var reload = function() {
	var token= randomString(50);
	console.log(token);
	
       jQuery.ajax({
          url: 'api/gen.php',
		  data:{
		  token:token,
		  atmid:atmid,
		  },
		  type: "POST",
          cache: false,
          success: function(data) {
		  
		  console.log(data);
		   
		   (function insert(){
            var src = document.getElementById("sammy");
            var img = document.createElement("img");
            img.src = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl="+token+"&choe=UTF-8";
			img.id="old";
			
			if ($('#old').length > 0) { 
			// it exists 
			document.getElementById("old").remove();	
			}
			src.appendChild(img);
			
			
			jQuery.ajax({
			  url: 'api/get.php',
			  data:{
			  token:token,
			  type:"check",
			  },
			  type: "POST",
			  cache: false,
			  success: function(data) {
			  
				//console.log(data);
				var json = JSON.parse(data);
				console.log(json.iciciuserid);
				console.log(json.atmid);
				
				if(json.iciciuserid!=-1){
					
					document.getElementById("old").remove();
					
					$('#message').text('You are Loggedin');
					
					setTimeout(function() {
						 reload();
					  }, seconds);
					
					
				}else{
						
						setTimeout(function() {
						 reload();
					  }, seconds);
					  $('#message').text('You are LoggedOut');
				}
				
				
			  },
			  error:function (){

				}
			});		
			
			
			
			})();
             
			
          },
		  error:function (){

			}
       });
     };
	 
	 
	 
     reload();
});

    
    </script>
	
</div>

</body>
</html>