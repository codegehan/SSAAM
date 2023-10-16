<?php
  
    require_once ("..\..\Libraries\JSON_Validator.php");
    require_once ("..\..\Libraries\Application.Config.php");
    require_once ("..\..\Libraries\PdoMySql.php");
	require_once ("Activity.Schema.php");
	
	class Activity{
//=================================================================================================================================================================================================		  
		static function UpdateRecord($Record)
		 {   
			$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(Activity_Schema::UpdateRecord(), true));

			if ($Validate_JSON["Valid"] === true) {
				set_error_handler(function ($errno,$errstr,$errfile,$errline){
				throw new ErrorException($errstr,$errno,0,$errfile,$errline);});
	
				$activityDesc = $Record->activity_description;
				$startDate = $Record->start_date;
				$endDate = $Record->end_date;
	
				$data = array(
					"activity_description" => $activityDesc,
					"start_date" => $startDate,
					"end_date" => $endDate
				);
	
				try{
					$NewRecord = json_encode($data);
					$Procedure = "Call activity_update(?)";
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
static function GetActivity($Record)
		{   
			set_error_handler(function ($errno,$errstr,$errfile,$errline){
				throw new ErrorException($errstr,$errno,0,$errfile,$errline);});
				try{
					$Procedure = "Call get_activity()";
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