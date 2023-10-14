<?php
  
    require_once ("..\..\Libraries\JSON_Validator.php");
	require_once ("..\..\Libraries\Application.Config.php");
    require_once ("..\..\Libraries\PdoMysql.php");
	require_once ("StudentAccount.Schema.php");
	
	class StudentAccount{
//=================================================================================================================================================================================================	 
		  
		static function UpdateRecord($Record)
		 {   
			// Validate the JSON data against the schema
			$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(StudentAccount_Schema::UpdateRecord(), true)); 
			if($Validate_JSON["Valid"]===true){

			$studentid = $Record->Student_ID;
			$firstname = $Record->Fullname->Firstname;
			$middlename = $Record->Fullname->Middlename;
			$lastname = $Record->Fullname->Lastname;
			$suffix = $Record->Fullname->Suffix;
			$contactNo = $Record->Contact_No;
			$email = $Record->Email;
			$profileImage = $Record->Profile;
			$createdDate = date('Y-m-d H:i:s');

			$data = array(
				"student_id" => $studentid,
				"fullname" => array(
					"firstname" => $firstname,
					"middlename" => $middlename,
					"lastname" => $lastname,
					"suffix" => $suffix
				),
				"contact_no" => $contactNo,
				"email" => $email,
				"profile" => $profileImage,
				"created_date" => $createdDate
			);

			set_error_handler(function ($errno,$errstr,$errfile,$errline){
			throw new ErrorException($errstr,$errno,0,$errfile,$errline);});
			try{
				$NewRecord = json_encode($data);
				$Procedure = "Call student_update(?)";
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
static function FetchRecord($Record)
		  {   
			set_error_handler(function ($errno,$errstr,$errfile,$errline){
				throw new ErrorException($errstr,$errno,0,$errfile,$errline);});
				try{
					$Procedure = "Call get_student()";
					$Result = PdoMysql::ExecuteDML_Query(Application::$DBase, $Procedure, $Record);
					if(trim($Result) != "")
					{
						$Result = json_decode($Result);
						echo json_encode(Array("Status" => "Requested service has been successfully processed.",
												"Result" => $Result
											), JSON_UNESCAPED_UNICODE);
					} else { echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error"), JSON_UNESCAPED_UNICODE);}
				} catch (ErrorException $e){ echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error $e"), JSON_UNESCAPED_UNICODE);}	  
		  }
//=================================================================================================================================================================================================	 		  
	}
	
	?>