<?php

require_once("..\..\Libraries\JSON_Validator.php");
require_once("Program_Enroll_Schema.php");
require_once("../../Libraries/db_connect.php");
require_once("../../Libraries/pdoMysql.php");

class Program_Enroll
{
	//=================================================================================================================================================================================================	 

	static function UpdateProgramEnroll($Record)
	{
		// Validate the JSON data against the schema
		$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(Program_Enroll_Schema::UpdateProgramEnroll(), true));

		if ($Validate_JSON["Valid"] === true) {
			//Dummy Record

			$studentID = $Record->student_id;
			$programCode = $Record->program_code;
			$majorCode = $Record->major_code;
			$others = $Record->others;

			$data = array(
				"student_id" => $studentID,
				"program_code" => $programCode,
				"major_code" => $majorCode,
				"others" => $others
			);

			set_error_handler(function ($errno, $errstr, $errfile, $errline) {
				throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
			});
			try {
				$NewRecord = json_encode($data);
				$Procedure = "Call update_program_enroll(?)";
				$Result = PdoMysql::ExecuteDML_Query(Application::$DBase, $Procedure, $NewRecord);
				if (trim($Result) != "") {
					$Result = json_decode($Result, true);
					// $Result = $Result[0]->Status;
					echo json_encode(array(
						"Status" => "Requested service has been successfully processed.",
						"Result" => $Result
					), JSON_UNESCAPED_UNICODE);
				} else {
					echo json_encode(array("Status" => "Error: Request has failed.The server has encountered an error"), JSON_UNESCAPED_UNICODE);
				}
			} catch (ErrorException $e) {
				echo json_encode(array("Status" => "Error: Request has failed.The server has encountered an error $e"), JSON_UNESCAPED_UNICODE);
			}
		
		} else {
			echo '{ "JSON Schema Status" : "' .  $Validate_JSON["Status"] . '"}';
		}
	}


	//=================================================================================================================================================================================================	 
	static function SearchProgramEnroll($Record)
	{
		// Validate the JSON data against the schema
		$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(Program_Enroll_Schema::SearchProgramEnroll(), true));

		if ($Validate_JSON["Valid"] === true) {
			//Dummy Record
			$studentID = $Record->_student_id;
		
			$data = array(
				"_student_id" => $studentID
			);

			set_error_handler(function ($errno, $errstr, $errfile, $errline) {
				throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
			});
			try {
				$NewRecord = json_encode($data);
				$Procedure = "Call search_program_enroll(?)";
				$Result = PdoMysql::ExecuteDML_Query(Application::$DBase, $Procedure, $NewRecord);
				if (trim($Result) != "") {
					$Result = json_decode($Result, true);
					// $Result = $Result[0]->Status;
					echo json_encode(array(
						"Status" => "Requested service has been successfully processed.",
						"Result" => $Result
					), JSON_UNESCAPED_UNICODE);
				} else {
					echo json_encode(array("Status" => "Error: Request has failed.The server has encountered an error"), JSON_UNESCAPED_UNICODE);
				}
			} catch (ErrorException $e) {
				echo json_encode(array("Status" => "Error: Request has failed.The server has encountered an error $e"), JSON_UNESCAPED_UNICODE);
			}
			//Dummy Record
		} else {
			echo '{ "JSON Schema Status" : "' .  $Validate_JSON["Status"] . '"}';
		}
	}


	//=================================================================================================================================================================================================	 


}
