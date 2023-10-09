<?php
  
    require_once ("..\..\Libraries\JSON_Validator.php");
	require_once ("Activity.Schema.php");
	
	class Activity{
//=================================================================================================================================================================================================	 
		  
		static function UpdateRecord($Record)
		 {   
			// Validate the JSON data against the schema
			$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(Activity_Schema::UpdateRecord(), true)); 
   
			if($Validate_JSON["Valid"]===true){
				//Dummy Record
				echo '{ "Status" : "Record was successfully updated...",
					    "Record" :
								{ 
                                    "Activity_Description":"General Meeting",
                                    "Activity_Date":"2023-9-10 - 2023-10-10"
								}
					  }';	
			}else{echo '{ "JSON Schema Status" : "' .  $Validate_JSON["Status"] . '"}';}
			
		 }
			  
 //=================================================================================================================================================================================================	 
		 static function SearchRecord($Record)
		  {   
		    // Validate the JSON data against the schema
			$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(Activity_Schema::SearchRecord(), true)); 
   
			if($Validate_JSON["Valid"]===true){
				//Dummy Record
				if($Record->SearchKey=="General Meeting"){
				 echo '{"Status" : "Request was successfully processed...",
					   "Record" :{ 
                                    "Activity_Description":"General Meeting",
                                    "Activity_Date":"2023-9-10 - 2023-10-10"
								}
                        }';
								
				}else{ echo '{"Status" : "Error=> The Search Key "'. $Record->SearchKey .'" was not found in the database"}';}
				
			}else{echo '{ "JSON Schema Status" : "' . $Validate_JSON["Status"] . '"}';}

		  
		  }
 
//=================================================================================================================================================================================================	 
static function GetActivityRecord($Record)
		  {   
			echo '{"Status" : "Request was successfully processed...",
				"Record" :
                            { 
                                "Activity_Description":"General Meeting",
                                "Activity_Date":"2023-9-10 - 2023-10-10"
						    },
                            { 
                                "Activity_Description":"Student Fest",
                                "Activity_Date":"2023-4-12 - 2023-9-12"
						    },
                            { 
                                "Activity_Description":"University Week",
                                "Activity_Date":"2024-10-01 - 2024-17-01"
						    },
                            { 
                                "Activity_Description":"General Assembly",
                                "Activity_Date":"2024-15-02"
						    },
                            { 
                                "Activity_Description":"SSG Election",
                                "Activity_Date":"2024-04-20"
						    },
				}';	  
		  }
 
//=================================================================================================================================================================================================	 

			  
	}
	
	?>