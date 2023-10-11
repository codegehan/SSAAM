<?php

require_once("..\..\Libraries\JSON_Validator.php");
require_once("Major_Schema.php");

class Major
{
	//=================================================================================================================================================================================================	 

	static function UpdateMajor($Record)
	{
		// Validate the JSON data against the schema
		$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(Major_Schema::UpdateMajor(), true));

		if ($Validate_JSON["Valid"] === true) {
			//Dummy Record
			echo '{ "Status" : "New College Added.",
					"Record" :{
								"major_code": 1, 
								"program_description": "BSCS", 
								"major_description": "Software eng."
								}
					}';
		} else {
			echo '{ "JSON Schema Status" : "' .  $Validate_JSON["Status"] . '"}';
		}
	}

	//=================================================================================================================================================================================================	 
	static function SearchMajor($Record)
	{
		// Validate the JSON data against the schema
		$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(Major_Schema::SearchMajor(), true));

		if ($Validate_JSON["Valid"] === true) {
			//Dummy Record
			if ($Record->SearchKey == "Software eng.") {

				echo '{"Status" : "Request was successfully processed...",
					   "Record" :{
									"major_code": 1, 
									"program_description": "BSCS", 
									"major_description": "Software eng."
								}
						}';
			} else {
				echo '{"Status" : "Error=> The Major Description ' . $Record->SearchKey . ' was not found in the database"}';
			}
		} else {
			echo '{ "JSON Schema Status" : "' . $Validate_JSON["Status"] . '"}';
		}
	}


	//=================================================================================================================================================================================================	 


}
