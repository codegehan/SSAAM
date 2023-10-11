<?php 
       require_once("Authorization.php");
       require_once("Libraries/Route.php");

     
        $Data = file_get_contents('php://input'); 
         
        $Request_Headers = apache_request_headers();
         
		  
	   	            
			   $Data = '{"Record":' . (is_object(json_decode($Data))? $Data : "{}") . ',"Request" : "' . Route::Info()["Process"]  . '"}';
			    
				$Authorization = Authorization::Validate($Request_Headers, strtoupper(Route::Info()["Process"]));
				
               
               if(!str_contains($Authorization["Status"],'Error=>')){ 				 
					//Map Endpoints for the Route.
					if(strtoupper(Route::Info()["Module"])=="STUDENTACCOUNT"){
						echo Route::Transmit(Route::Info()["URL"] . "/Services/Student_Account/StudentAccount.Controller.php", 
				                       Route::Info()["Method"], $Data);
					 }
					else if(strtoupper(Route::Info()["Module"])=="USERACCOUNT"){
						echo Route::Transmit(Route::Info()["URL"] . "/Services/User_Account/UserAccount.Controller.php", 
				                       Route::Info()["Method"], $Data);
					}
					else if(strtoupper(Route::Info()["Module"])=="ACTIVITY"){
						echo Route::Transmit(Route::Info()["URL"] . "/Services/Activity/Activity.Controller.php", 
				                       Route::Info()["Method"], $Data);
					}else if(strtoupper(Route::Info()["Module"])=="ATTACHMENT"){
						echo Route::Transmit(Route::Info()["URL"] . "/Services/Attachment/Attachment.Controller.php", 
				                       Route::Info()["Method"], $Data);
					}else if(strtoupper(Route::Info()["Module"])=="PROGRAM"){
						echo Route::Transmit(Route::Info()["URL"] . "/Services/Program/Program.Controller.php", 
				                       Route::Info()["Method"], $Data);
					}else if(strtoupper(Route::Info()["Module"])=="COLLEGE"){
						echo Route::Transmit(Route::Info()["URL"] . "/Services/Program/College.Controller.php", 
				                       Route::Info()["Method"], $Data);
					}else if(strtoupper(Route::Info()["Module"])=="MAJOR"){
						echo Route::Transmit(Route::Info()["URL"] . "/Services/Program/Major.Controller.php", 
				                       Route::Info()["Method"], $Data);
					}else{ echo '{"Status" : "Error=> The API endpoint was not recognized."}';}
			   
			   //Declare The Page Header
	              header("Expires: Sat, 13 Jan 1979 05:00:00 GMT");
                  header("Cache-Control: no-cache");
                  header("Pragma: no-cache");
				  header("Developer: Coderstation Developers Team");
                  header("Provider: Coderstation Services and Technology Provider");
                  header("Authorization: Bearer {$Authorization['JWToken']}");
			   }else{ //Invalid Authorization
			          echo $Authorization["Status"];	}			  
                      
?>