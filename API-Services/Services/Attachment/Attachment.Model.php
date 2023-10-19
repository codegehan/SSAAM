<?php
  
    require_once ("..\..\Libraries\JSON_Validator.php");
	require_once ("Attachment.Schema.php");
    require_once ("..\..\Libraries\Application.Config.php");
    require_once ("..\..\Libraries\PdoMySql.php");
	
	class Attachment{
//=================================================================================================================================================================================================	 	  
		static function InsertRecord($Record)
		 {
			// Validate the JSON data against the schema
			$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(Attachment_Schema::InsertRecord(), true)); 
			if($Validate_JSON["Valid"]===true){
                set_error_handler(function ($errno,$errstr,$errfile,$errline){
                throw new ErrorException($errstr,$errno,0,$errfile,$errline);});
                
                $studentid = $Record->student_id;
                $fileType = $Record->attachment_description->file_type;
                $status = "pending";
                $dateSubmitted = date("Y-m-d H:i:s");
                $file_data = $Record->attachment_data;

                $data = array(
                    "student_id" => $studentid,
                    "attachment_description" => array(
                        "file_type" => $fileType,
                        "date_submitted" => $dateSubmitted,
                        "status" => $status
                    )
                );

                try{
                    $NewRecord = Array(json_encode($data), $file_data);
                    $Procedure = "Call attachment_insert(?,?)";
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
            else 
                {
                    echo '
                        { "JSON Schema Status" : "' .  $Validate_JSON["Status"] . '"}
                        ';
                }
            }		  
 //=================================================================================================================================================================================================	 
        static function UpdateRecord($Record)
        {   
            // Validate the JSON data against the schema
            $Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(Attachment_Schema::UpdateRecord(), true)); 

            if($Validate_JSON["Valid"]===true){
                set_error_handler(function ($errno,$errstr,$errfile,$errline){
                throw new ErrorException($errstr,$errno,0,$errfile,$errline);});
                try{
                    $NewRecord = json_encode($Record);
                    $Procedure = "Call attachment_validation(?)";
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
        static function FetchRecordAttachment($Record)
        {   
			set_error_handler(function ($errno,$errstr,$errfile,$errline){
			throw new ErrorException($errstr,$errno,0,$errfile,$errline);});
				try{
					$Procedure = "Call get_attachment_record()";
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
        static function FetchAttachmentData($Record)
        {   
            // Validate the JSON data against the schema
            $Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(Attachment_Schema::FetchAttachmentData(), true)); 

            if($Validate_JSON["Valid"]===true){
                set_error_handler(function ($errno,$errstr,$errfile,$errline){
                throw new ErrorException($errstr,$errno,0,$errfile,$errline);});
                try{
                    $NewRecord = json_encode($Record);
                    $Procedure = "Call get_attachment_data(?)";
                    $Result = PdoMysql::ExecuteDML_Query(Application::$DBase, $Procedure, $NewRecord);
                    if(trim($Result) != "")
                    {
                        $Result = json_decode($Result);
                        $Result = $Result[0]->attachment_data;
                        $Result = str_replace("/", "_", $Result);
                        echo json_encode(Array("Status" => "Requested service has been successfully processed.",
                                                "Result" => $Result
                                            ), JSON_UNESCAPED_UNICODE);
                    } else { echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error"), JSON_UNESCAPED_UNICODE);}
                } catch (ErrorException $e){ echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error $e"), JSON_UNESCAPED_UNICODE);}
                //Dummy Record
            }else{echo '{ "JSON Schema Status" : "' .  $Validate_JSON["Status"] . '"}';} 
        }
//=================================================================================================================================================================================================	

}  
?>