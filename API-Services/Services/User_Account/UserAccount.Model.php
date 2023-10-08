<?php
  
    require_once ("..\..\Libraries\JSON_Validator.php");
	require_once ("UserAccount_Schema.php");
	
	class UserAccount{
//=================================================================================================================================================================================================	 
		  
		static function Shakehand($Record)
		 {   
			// Validate the JSON data against the schema
			$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(UserAccount_Schema::Shakehand(), true)); 
   
			if($Validate_JSON["Valid"]===true){
				//Dummy Record
				$MyUser_ID = "18-A-03621";
				$MyPassword = "gehan";
				 if($Record->User_ID == $MyUser_ID && $Record->Password == $MyPassword)
				   { echo '{"OTP":"12345"}';}
				 else{echo '{ "Status" : "Error=> Access Denied!!!, UserAccount not Found..."}';}
				 
			}else{echo '{ "JSON Schema Status" : "' .  $Validate_JSON["Status"] . '"}';}
			
		 }
			  
 //=================================================================================================================================================================================================	 
		 static function Login($Record)
		  {   
		    // Validate the JSON data against the schema
			$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(UserAccount_Schema::Login(), true)); 
                
			if($Validate_JSON["Valid"]===true){
				//Dummy Record
				 $MyUser_ID = "18-A-03621";
				 $MyPassword = "gehan";
				 $MyAccess_Code ="12345";
				
				 if($Record->User_ID == $MyUser_ID && $Record->Password == $MyPassword && $Record->OTP == $MyAccess_Code)
				   {
					// Insert Database Operations
					   echo '{"Status" : "Authorization was successfully processed.",
					   "Record" :{"User_ID": "18-A-03621",
								  "Fullname": {
													"Firstname" : "Gehan",
													"Middlename" : "Lumantas",
													"Lastname" : "Resalute"
								  			   }
								  "Email": "gehanatomost@gmail.com",
								  "Contact_No": "+639953924073",
								  "College_Department": "College of Computer Studies",
								  "Account_Privilege": "Representative"
								}}';
				   }
				 else{echo '{ "Status" : "Error=> Access Denied!!!, Authorization was not successfully processed."}';}
				  
			}else{echo '{"JSON Schema Status" : "' . $Validate_JSON["Status"] . '"}';}

		  
		  }
 
//=================================================================================================================================================================================================	 
		static function Update($Record)
		{   
		// Validate the JSON data against the schema
		$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(UserAccount_Schema::Update(), true)); 
			
		if($Validate_JSON["Valid"]===true){
			//Dummy Record
			echo '{ "Status" : "New account added...",
				"Record" :{ "User_ID": "22-B-12345", 
						  	"Account_Privilege": "Representative",
							"Last_Login": "0000-00-00 00:00:00",
							"account_status": "Active",
							"login_attempt": "0",,
							"login_cooldown": "0000-00-00 00:00:00",
							"created_date": "2023-10-08 12:29:33"
						}}';	
		}else{echo '{"JSON Schema Status" : "' . $Validate_JSON["Status"] . '"}';}


		}
			  
	}
	
	?>