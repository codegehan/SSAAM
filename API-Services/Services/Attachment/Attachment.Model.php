<?php
  
    require_once ("..\..\Libraries\JSON_Validator.php");
	require_once ("Attachment.Schema.php");
	
	class Attachment{
//=================================================================================================================================================================================================	 
		  
		static function InsertRecord($Record)
		 {   
			// Validate the JSON data against the schema
			$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(Attachment_Schema::InsertRecord(), true)); 
   
			if($Validate_JSON["Valid"]===true){
				//Dummy Record
				echo '{ "Status" : "Record was successfully inserted...",
					    "Record" :
								{ 
                                    "Student_ID": "123",
                                    "Attachment_Type": "Student Copy",
                                    "File_Name": "Gehan-Student-Copy",
                                    "File_Data": "1231782eiushdaljshdkksadh2qc6732qhmajksdsa",
                                    "Date_Submitted": "2023-10-09",
                                    "File_Status": "PENDING"
								}
					  }';	
			}else{echo '{ "JSON Schema Status" : "' .  $Validate_JSON["Status"] . '"}';}
			
		 }
			  
 //=================================================================================================================================================================================================	 
        static function UpdateRecord($Record)
        {   
            // Validate the JSON data against the schema
            $Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(Attachment_Schema::UpdateRecord(), true)); 

            if($Validate_JSON["Valid"]===true){
                if($Record->Attachment_No == 3){
                    echo '{ "Status" : "Record was successfully updated...",
                        "Record" :
                                { 
                                    "Student_ID": "123",
                                    "Attachment_Type": "Student Copy",
                                    "File_Name": "Gehan-Student-Copy",
                                    "File_Data": "1231782eiushdaljshdkksadh2qc6732qhmajksdsa",
                                    "Date_Submitted": "2023-10-09",
                                    "File_Status": "APPROVED OR DECLINE"
                                }
                    }';	
                }
                //Dummy Record
            }else{echo '{ "JSON Schema Status" : "' .  $Validate_JSON["Status"] . '"}';} 
        }  
	}
	
	?>