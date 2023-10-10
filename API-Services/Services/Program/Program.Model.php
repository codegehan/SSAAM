<?php

require_once("..\..\Libraries\JSON_Validator.php");
require_once("Program_Schema.php");

class Program
{
	//=================================================================================================================================================================================================	 

	static function UpdateProgram($Record)
	{
		// Validate the JSON data against the schema
		$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(Program_Schema::UpdateProgram(), true));

		if ($Validate_JSON["Valid"] === true) {
			//Dummy Record
			echo '{ "Status" : "New Program Added.",
					"Record" :{"program_code": 1, 
								"program_description": "BSCS", 
								"college_code": "1"}
					}';

		} else {
			echo '{ "JSON Schema Status" : "' .  $Validate_JSON["Status"] . '"}';
		}
	}

	//=================================================================================================================================================================================================	 
	static function SearchProgram($Record)
	{
		// Validate the JSON data against the schema
		$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(Program_Schema::SearchProgram(), true));

		if ($Validate_JSON["Valid"] === true) {
			//Dummy Record
			if ($Record->SearchKey == "BSCS") {
				echo '{"Status" : "Request was successfully processed...",
					   "Record" :{"program_code": 2, 
						"program_description": "BSCS", 
						"college_description": "CCS"}}';
						
			} else {
				echo '{"Status" : "Error=> The Student ID ' . $Record->SearchKey . ' was not found in the database"}';
			}
		} else {
			echo '{ "JSON Schema Status" : "' . $Validate_JSON["Status"] . '"}';
		}
	}


	//=================================================================================================================================================================================================	 


}
