<?php

require_once("..\..\Libraries\JSON_Validator.php");
require_once ("..\..\Libraries\Application.Config.php");
require_once ("..\..\Libraries\PdoMysql.php");
require_once("Schedule.Schema.php");

class Schedule
{
	//=================================================================================================================================================================================================	 
	static function UpdateSchedule($Record)
	{
		// Validate the JSON data against the schema
		$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(Schedule_Schema::UpdateSchedule(), true));

		if ($Validate_JSON["Valid"] === true) {

			set_error_handler(function ($errno,$errstr,$errfile,$errline){
			throw new ErrorException($errstr,$errno,0,$errfile,$errline);});
			try{

				$NewRecord = json_encode($Record);
				$Procedure = "Call set_schedule(?)";
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
	static function FetchSchedule($Record)
	{
		set_error_handler(function ($errno,$errstr,$errfile,$errline){
			throw new ErrorException($errstr,$errno,0,$errfile,$errline);});
			try{
				$Procedure = "Call schedule_heartbeat()";
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
