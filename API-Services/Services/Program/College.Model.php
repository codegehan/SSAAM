<?php

require_once("..\..\Libraries\JSON_Validator.php");
require_once("College_Schema.php");

class College
{
	//=================================================================================================================================================================================================	 

	static function UpdateCollege($Record)
	{
		// Validate the JSON data against the schema
		$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(College_Schema::UpdateCollege(), true));

		if ($Validate_JSON["Valid"] === true) {
			//Dummy Record
			echo '{ "Status" : "New College Added.",
			   "Record" :{"college_code": " ", "college_description": "CCS"}}';
		} else {
			echo '{ "JSON Schema Status" : "' .  $Validate_JSON["Status"] . '"}';
		}
	}

	//=================================================================================================================================================================================================	 
	static function SearchCollege($Record)
	{
		// Validate the JSON data against the schema
		$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(College_Schema::SearchCollege(), true));

		if ($Validate_JSON["Valid"] === true) {
			//Dummy Record
			if ($Record->SearchKey == "CCS") {

				echo '{"Status" : "Request was successfully processed...",
					   "Record" :{"college_code": 1, "college_description": "CCS"}}';
			} else {
				echo '{"Status" : "Error=> The College Description ' . $Record->SearchKey . ' was not found in the database"}';
			}
		} else {
			echo '{ "JSON Schema Status" : "' . $Validate_JSON["Status"] . '"}';
		}
	}


	//=================================================================================================================================================================================================	 


}
