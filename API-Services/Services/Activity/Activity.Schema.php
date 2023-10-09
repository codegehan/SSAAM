<?php

 class Activity_Schema{
	 static function UpdateRecord()
	 {
		 $jsonSchema = '{   "Type": "object",
							"Properties": { "Activity_Description": {"Type": "string", "Text": "letter"},
                                            "Activity_Date": {"Type": "string"}
		 								  },
							 "Required": ["Activity_Description", "Activity_Date"]
						}';
						
		return $jsonSchema;
    }
  //--------------------------------------------------------------------------------------------------------
  
  
     static function SearchRecord()
	 {   $jsonSchema = '{   "Type": "object",
							"Properties": { "SearchKey": { "Type": "string" }
							              },
						    "Required": ["SearchKey"]
						}';
		 return $jsonSchema;
	 }
  //--------------------------------------------------------------------------------------------------------
  
 }

?>