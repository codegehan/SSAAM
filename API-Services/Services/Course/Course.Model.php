<?php

require_once("..\..\Libraries\JSON_Validator.php");
require_once ("..\..\Libraries\Application.Config.php");
require_once ("..\..\Libraries\PdoMysql.php");
require_once("Course.Schema.php");

class Course
{
	//=================================================================================================================================================================================================	 
	static function UpdateCollege($Record)
	{
		// Validate the JSON data against the schema
		$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(Course_Schema::UpdateCourse(), true));

		if ($Validate_JSON["Valid"] === true) {

			$collegeCode = $Record->college_code;
			$collegeDescription = $Record->college_description;

			$data = array(
				"college_code" => $collegeCode,
				"college_description" => $collegeDescription
			);

			set_error_handler(function ($errno,$errstr,$errfile,$errline){
			throw new ErrorException($errstr,$errno,0,$errfile,$errline);});
			try{

				$NewRecord = json_encode($data);
				$Procedure = "Call update_college(?)";
				$Result = PdoMysql::ExecuteDML_Query(Application::$DBase, $Procedure, $NewRecord);
				if(trim($Result) != "")
				{
					$Result = json_decode($Result);
					echo json_encode(Array("Status" => "Requested service has been successfully processed.",
											"Result" => $Result
										), JSON_UNESCAPED_UNICODE);
				} else { echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error"), JSON_UNESCAPED_UNICODE);}
			} catch (ErrorException $e){ echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error $e"), JSON_UNESCAPED_UNICODE);}
		} else {
			echo '{ "JSON Schema Status" : "' .  $Validate_JSON["Status"] . '"}';
		}
	}
	//=================================================================================================================================================================================================	 
	static function UpdateProgram($Record)
	{
		// Validate the JSON data against the schema
		$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(Course_Schema::UpdateProgram(), true));

		if ($Validate_JSON["Valid"] === true) {

			$programCode = $Record->program_code;
			$collegeCode = $Record->college_code;
			$programDescription = $Record->program_description;

			$data = array(
				"program_code" => $programCode,
				"college_code" => $collegeCode,
				"program_description" => $programDescription
			);

			set_error_handler(function ($errno,$errstr,$errfile,$errline){
			throw new ErrorException($errstr,$errno,0,$errfile,$errline);});
			try{

				$NewRecord = json_encode($data);
				$Procedure = "Call update_program(?)";
				$Result = PdoMysql::ExecuteDML_Query(Application::$DBase, $Procedure, $NewRecord);
				if(trim($Result) != "")
				{
					$Result = json_decode($Result);
					echo json_encode(Array("Status" => "Requested service has been successfully processed.",
											"Result" => $Result
										), JSON_UNESCAPED_UNICODE);
				} else { echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error"), JSON_UNESCAPED_UNICODE);}
			} catch (ErrorException $e){ echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error $e"), JSON_UNESCAPED_UNICODE);}
		} else {
			echo '{ "JSON Schema Status" : "' .  $Validate_JSON["Status"] . '"}';
		}
	}
	//=================================================================================================================================================================================================	 

	static function UpdateMajor($Record)
	{
		// Validate the JSON data against the schema
		$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(Course_Schema::UpdateMajor(), true));

		if ($Validate_JSON["Valid"] === true) {
			
			$majorCode = $Record->major_code;
			$programCode = $Record->program_code;
			$majorDescription = $Record->major_description;

			$data = array(
				"major_code" => $majorCode,
				"program_code" => $programCode,
				"major_description" => $majorDescription
			);

			set_error_handler(function ($errno,$errstr,$errfile,$errline){
			throw new ErrorException($errstr,$errno,0,$errfile,$errline);});
			try{

				$NewRecord = json_encode($data);
				$Procedure = "Call update_major(?)";
				$Result = PdoMysql::ExecuteDML_Query(Application::$DBase, $Procedure, $NewRecord);
				if(trim($Result) != "")
				{
					$Result = json_decode($Result);
					echo json_encode(Array("Status" => "Requested service has been successfully processed.",
											"Result" => $Result
										), JSON_UNESCAPED_UNICODE);
				} else { echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error"), JSON_UNESCAPED_UNICODE);}
			} catch (ErrorException $e){ echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error $e"), JSON_UNESCAPED_UNICODE);}
		} else {
			echo '{ "JSON Schema Status" : "' .  $Validate_JSON["Status"] . '"}';
		}
	}
	//=================================================================================================================================================================================================	 
	static function GetRequest($Record)
	{
		$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(Course_Schema::GetRequest(), true));

		if ($Validate_JSON["Valid"] === true) {
			set_error_handler(function ($errno,$errstr,$errfile,$errline){
			throw new ErrorException($errstr,$errno,0,$errfile,$errline);});

			$request = $Record->request;
			$request = strtoupper($request);

			$data = array(
				"request" => $request
			);

			try{
				$NewRecord = json_encode($data);
				$Procedure = "Call get_request(?)";
				$Result = PdoMysql::ExecuteDML_Query(Application::$DBase, $Procedure, $NewRecord);
				if(trim($Result) != "")
				{
					$Result = json_decode($Result);
					echo json_encode(Array("Status" => "Requested service has been successfully processed.",
											"Result" => $Result
										), JSON_UNESCAPED_UNICODE);
				} else { echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error"), JSON_UNESCAPED_UNICODE);}
			} catch (ErrorException $e){ echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error $e"), JSON_UNESCAPED_UNICODE);}
		} else {
			echo '{ "JSON Schema Status" : "' .  $Validate_JSON["Status"] . '"}';
		}
	}
}
