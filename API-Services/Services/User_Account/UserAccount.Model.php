<?php
  
    require_once ("..\..\Libraries\JSON_Validator.php");
    require_once ("..\..\Libraries\Application.Config.php");
    require_once ("..\..\Libraries\PdoMysql.php");
	require_once ("UserAccount.Schema.php");
	
	class UserAccount{
//=================================================================================================================================================================================================	 
		  
		static function Shakehand($Record)
		 {   
			// Validate the JSON data against the schema
			$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(UserAccount_Schema::Shakehand(), true)); 
			if($Validate_JSON["Valid"]===true){
				$student_id = $Record->student_id;
				$password = $Record->password;
				$code = rand(100000, 999999);
				$convertedCode = strval($code);
				$status = "active";
				$expiration = date('Y-m-d H:i:s', strtotime('+5 minutes'));
				

				$data = array(
					"student_id" => $student_id,
					"password" => $password,
					"otp" => array(
						"code" => $convertedCode,
						"status" => $status,
						"expiration" => $expiration
					)
				);

				set_error_handler(function ($errno,$errstr,$errfile,$errline){
				throw new ErrorException($errstr,$errno,0,$errfile,$errline);});
				try{
					$NewRecord = json_encode($data);
					$Procedure = "Call shakehand(?)";
					$Result = PdoMysql::ExecuteDML_Query(Application::$DBase, $Procedure, $NewRecord);
					if(trim($Result) != "")
					{
						$Result = json_decode($Result);
						$Result = $Result[0]->Status;
						echo json_encode(Array("Status" => "Requested service has been successfully processed.",
												"Result" => $Result
											), JSON_UNESCAPED_UNICODE);
					} else { echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error"), JSON_UNESCAPED_UNICODE);}
				} catch (ErrorException $e){ echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error $e"), JSON_UNESCAPED_UNICODE);}
			}else{echo '{ "JSON Schema Status" : "' .  $Validate_JSON["Status"] . '"}';}
			
		 }
			  
 //=================================================================================================================================================================================================	 
		 static function Login($Record)
		  {   
		    // Validate the JSON data against the schema
			$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(UserAccount_Schema::Login(), true)); 
                
			if($Validate_JSON["Valid"]===true){
				
				$studentid = $Record->student_id;
				$password = $Record->password;
				$otpcode = $Record->otp;

				$data = array(
					"student_id" => $studentid,
					"password" => $password,
					"otp" => $otpcode
				);

				set_error_handler(function ($errno,$errstr,$errfile,$errline){
				throw new ErrorException($errstr,$errno,0,$errfile,$errline);});
				try{
					$NewRecord = json_encode($data);
					$Procedure = "Call login_user(?)";
					$Result = PdoMysql::ExecuteDML_Query(Application::$DBase, $Procedure, $NewRecord);
					if(trim($Result) != "")
					{
						$Result = json_decode($Result);
						$Result = $Result[0]->Status;
						echo json_encode(Array("Status" => "Requested service has been successfully processed.",
												"Result" => $Result
											), JSON_UNESCAPED_UNICODE);
					} else { echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error"), JSON_UNESCAPED_UNICODE);}
				} catch (ErrorException $e){ echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error $e"), JSON_UNESCAPED_UNICODE);}
			}else{echo '{ "JSON Schema Status" : "' .  $Validate_JSON["Status"] . '"}';}

		  
		  }
 
//=================================================================================================================================================================================================	 
		static function Update($Record)
		{   
		// Validate the JSON data against the schema
		$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(UserAccount_Schema::Update(), true)); 
		if($Validate_JSON["Valid"]===true){

			$studentid = $Record->student_id;
			$password = $Record->password;
			$accountPrivilege = $Record->account_privilege;
			$createdDate = date('Y-m-d H:i:s');

			$data = array(
				"student_id" => $studentid,
				"password" => $password,
				"account_privilege" => $accountPrivilege,
				"otp" => null,
				"last_login" => null,
				"login_attempt" => null,
				"login_cooldown" => null,
				"created_date" => $createdDate
			);

			set_error_handler(function ($errno,$errstr,$errfile,$errline){
			throw new ErrorException($errstr,$errno,0,$errfile,$errline);});
			try{
				$NewRecord = json_encode($data);
				$Procedure = "Call account_update(?)";
				$Result = PdoMysql::ExecuteDML_Query(Application::$DBase, $Procedure, $NewRecord);
				if(trim($Result) != "")
				{
					$Result = json_decode($Result);
					$Result = $Result[0]->Status;
					echo json_encode(Array("Status" => "Requested service has been successfully processed.",
											"Result" => $Result
										), JSON_UNESCAPED_UNICODE);
				} else { echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error"), JSON_UNESCAPED_UNICODE);}
			} catch (ErrorException $e){ echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error $e"), JSON_UNESCAPED_UNICODE);}
			//Dummy Record
			}else{echo '{ "JSON Schema Status" : "' .  $Validate_JSON["Status"] . '"}';} 
		}

//=================================================================================================================================================================================================	
		
		static function Fetch($Record)
		{   
			set_error_handler(function ($errno,$errstr,$errfile,$errline){
			throw new ErrorException($errstr,$errno,0,$errfile,$errline);});
			try{
				// HEREEEEEEEEEEEEEEEEEEE
				$Procedure = "Call get_account()";
				$Result = PdoMysql::ExecuteDML_Query(Application::$DBase, $Procedure, $NewRecord);
				if(trim($Result) != "")
				{
					$Result = json_decode($Result);
					$Result = $Result[0]->Status;
					echo json_encode(Array("Status" => "Requested service has been successfully processed.",
											"Result" => $Result
										), JSON_UNESCAPED_UNICODE);
				} else { echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error"), JSON_UNESCAPED_UNICODE);}
			} catch (ErrorException $e){ echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error $e"), JSON_UNESCAPED_UNICODE);}	  
	
		}}
	
	?>