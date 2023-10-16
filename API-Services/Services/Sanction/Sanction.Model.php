<?php
  
    require_once ("..\..\Libraries\JSON_Validator.php");
	require_once ("Sanction.Schema.php");
    require_once ("..\..\Libraries\Application.Config.php");
    require_once ("..\..\Libraries\PdoMySql.php");
	
	class Sanction{
//=================================================================================================================================================================================================	 	  
		static function UpdateRecord($Record)
		{
			// Validate the JSON data against the schema
            $Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(SanctionSchema::InsertRecord(), true)); 
			if($Validate_JSON["Valid"]===true){
                set_error_handler(function ($errno,$errstr,$errfile,$errline){
                throw new ErrorException($errstr,$errno,0,$errfile,$errline);});

                $sanctionNo = $Record->sanction_no;
                $minAbsences = $Record->min_absences;
                $maxAbsences = $Record->max_absences;
                $sanctionDesc = $Record->sanction_desc;

                $data = array(
                    "sanction_no" => $sanctionNo,
                    "min_absences" => $minAbsences,
                    "max_absences" => $maxAbsences,
                    "sanction_description" => $sanctionDesc
                );

                try{
                    $NewRecord = json_encode($data);
                    $Procedure = "Call set_sanction(?)";
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
        static function GetSanctionRecord($Record)
        {
            set_error_handler(function ($errno,$errstr,$errfile,$errline){
            throw new ErrorException($errstr,$errno,0,$errfile,$errline);});
            try{
                $Procedure = "Call get_all_student_sanction()";
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
    
    // TO DOOOOO 
    // GET SANCTIOOON LISTSSSSSSSSSSSS

    // static function UpdateRecord($Record)
	// 	{
	// 		// Validate the JSON data against the schema
    //         $Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(SanctionSchema::InsertRecord(), true)); 
	// 		if($Validate_JSON["Valid"]===true){
    //             set_error_handler(function ($errno,$errstr,$errfile,$errline){
    //             throw new ErrorException($errstr,$errno,0,$errfile,$errline);});

    //             $sanctionNo = $Record->sanction_no;
    //             $minAbsences = $Record->min_absences;
    //             $maxAbsences = $Record->max_absences;
    //             $sanctionDesc = $Record->sanction_desc;

    //             $data = array(
    //                 "sanction_no" => $sanctionNo,
    //                 "min_absences" => $minAbsences,
    //                 "max_absences" => $maxAbsences,
    //                 "sanction_description" => $sanctionDesc
    //             );

    //             try{
    //                 $NewRecord = json_encode($data);
    //                 $Procedure = "Call set_sanction(?)";
    //                 $Result = PdoMysql::ExecuteDML_Query(Application::$DBase, $Procedure, $NewRecord);
    //                 if(trim($Result) != "")
    //                 {
    //                     $Result = json_decode($Result);
    //                     echo json_encode(Array("Status" => "Requested service has been successfully processed.",
    //                                             "Result" => $Result
    //                                         ), JSON_UNESCAPED_UNICODE);
    //                 } else { echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error"), JSON_UNESCAPED_UNICODE);}
    //             } catch (ErrorException $e){ echo json_encode(Array("Status" => "Error: Request has failed.The server has encountered an error $e"), JSON_UNESCAPED_UNICODE);}
    //         }
    //         else 
    //             {
    //                 echo '
    //                     { "JSON Schema Status" : "' .  $Validate_JSON["Status"] . '"}
    //                     ';
    //             }
    //     }


//=================================================================================================================================================================================================
	}  
?>