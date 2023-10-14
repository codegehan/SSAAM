<?php

require_once("..\..\Libraries\JSON_Validator.php");
require_once("Program_Enroll_Schema.php");

class Program_Enroll
{
	//=================================================================================================================================================================================================	 

	static function UpdateProgramEnroll($Record)
	{
		// Validate the JSON data against the schema
		$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(Program_Enroll_Schema::UpdateProgramEnroll(), true));

		if ($Validate_JSON["Valid"] === true) {
			//Dummy Record
			echo '{ "Status" : "New Program Added.",
			   "Record" :{"program_code": 1, 
						"program_description": "BSCS", 
						"college_code": "1"}}';
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
			if ($Record->SearchKey == "123") {
				echo '{"Status" : "Request was successfully processed...",
					   "Record" :{"program_code": 2, 
						"program_description": "BSCS", 
						"college_description": "CCS"}}';
			} else {
				echo '{"Status" : "Error=> The Program Description ' . $Record->SearchKey . ' was not found in the database"}';
			}
		} else {
			echo '{ "JSON Schema Status" : "' . $Validate_JSON["Status"] . '"}';
		}
	}


	//=================================================================================================================================================================================================	 


}
