<?php
  
    require_once ("..\..\Libraries\JSON_Validator.php");
	require_once ("..\..\Libraries\Application.Config.php");
    require_once ("..\..\Libraries\PdoMysql.php");
	require_once ("StudentAccount.Schema.php");
	// header('Access-Control-Allow-Origin: *');
	class StudentAccount{
//=================================================================================================================================================================================================	   
		static function UpdateRecord($Record)
		 {   
			// Validate the JSON data against the schema
			$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(StudentAccount_Schema::UpdateRecord(), true)); 
			if($Validate_JSON["Valid"]===true){

			$studentid = $Record->student_id;
			$firstname = $Record->fullname->firstname;
			$middlename = $Record->fullname->middlename;
			$lastname = $Record->fullname->lastname;
			$suffix = $Record->fullname->suffix;
			$sex = $Record->sex;
			$yearLevel = $Record->program_enroll->year_level;
			$course = $Record->program_enroll->college;
			$program = $Record->program_enroll->program;
			$major = $Record->program_enroll->major;
			$others = $Record->program_enroll->other;
			$contactNo = $Record->contact_no;
			$email = $Record->email_address;
			$profileImage = $Record->profile;
			$updatedDate = date('Y-m-d H:i:s');

			$data = array(
				"student_id" => $studentid,
				"fullname" => array(
					"firstname" => $firstname,
					"middlename" => $middlename,
					"lastname" => $lastname,
					"suffix" => $suffix
				),
				"sex" => $sex,
				"program_enroll" => array (
					"year_level" => $yearLevel,
					"course" => $course,
					"program" => $program,
					"major" => $major,
					"other" => $others
				),
				"contact_no" => $contactNo,
				"email" => $email,
				"updated_date" => $updatedDate
			);

			set_error_handler(function ($errno,$errstr,$errfile,$errline){
			throw new ErrorException($errstr,$errno,0,$errfile,$errline);});
			try{
				$NewRecord = Array(json_encode($data), $profileImage);
				$Procedure = "Call student_update(?,?)";
				$Result = PdoMysql::ExecuteDML_Query(Application::$DBase, $Procedure, $NewRecord);
				if(trim($Result) != "")
				{
					$Result = json_decode($Result);
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
		static function FetchId($Record)
		{   
			set_error_handler(function ($errno,$errstr,$errfile,$errline){
			throw new ErrorException($errstr,$errno,0,$errfile,$errline);});
			try{
				$studentidd = $Record->student_id;
				$data = array(
					"student_id" => $studentidd
				);
				$NewRecord = json_encode($data);
				$Procedure = "Call get_student_info(?)";
				$Result = PdoMysql::ExecuteDML_Query(Application::$DBase, $Procedure, $NewRecord);
				if(trim($Result) != "")
				{
					$Result = json_decode($Result);
					$Image = $Result[0]->profile_image;
					$Fullname = $Result[0]->student_information->fullname;
					$Image = str_replace("/", "_", $Image);
					echo json_encode(Array("Status" => "Requested service has been successfully processed.",
											"Fullname" => $Fullname,
											"Image" => $Image
										), JSON_UNESCAPED_UNICODE);
				} else { echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error"), JSON_UNESCAPED_UNICODE);}
			} catch (ErrorException $e){ echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error $e"), JSON_UNESCAPED_UNICODE);}	  

		}
//=================================================================================================================================================================================================	
		static function ValidateId($Record)
		{   
			set_error_handler(function ($errno,$errstr,$errfile,$errline){
			throw new ErrorException($errstr,$errno,0,$errfile,$errline);});
			try{
				$studentidd = $Record->student_id;
				$data = array(
					"student_id" => $studentidd
				);
				$NewRecord = json_encode($data);
				$Procedure = "Call validate_student(?)";
				$Result = PdoMysql::ExecuteDML_Query(Application::$DBase, $Procedure, $NewRecord);
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
		static function LoginStudent($Record)
		{   
			$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(StudentAccount_Schema::LoginStudent(), true)); 
			if($Validate_JSON["Valid"]===true){
				set_error_handler(function ($errno,$errstr,$errfile,$errline){
				throw new ErrorException($errstr,$errno,0,$errfile,$errline);});

				try{
					$studentidd = $Record->student_id;
					$password = $Record->password;
					$data = array(
						"student_id" => $studentidd,
						"password" => $password
					);
					$NewRecord = json_encode($data);
					$Procedure = "Call login_student(?)";
					$Result = PdoMysql::ExecuteDML_Query(Application::$DBase, $Procedure, $NewRecord);
					if(trim($Result) != "")
					{
						$Result = json_decode($Result);
						echo json_encode(Array("Status" => "Requested service has been successfully processed.",
												"Result" => $Result
											), JSON_UNESCAPED_UNICODE);
					} else { echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error"), JSON_UNESCAPED_UNICODE);}
				} catch (ErrorException $e){ echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error $e"), JSON_UNESCAPED_UNICODE);}	  	
			} else{echo '{ "JSON Schema Status" : "' .  $Validate_JSON["Status"] . '"}';}
		}
	}
?>