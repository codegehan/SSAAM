<?php

 class Activity_Schema{
	 static function UpdateRecord()
	 {
		 $jsonSchema = '{   "Type": "object",
							"Properties": { 
											"activity_description": {"Type": "string", "Text": "letter"},
                                            "start_date": {"Type": "string"},
											"end_date": {"Type": "string"}
		 								  },
							 "Required": ["activity_description", "start_date", "end_date"]
						}';
						
		return $jsonSchema;
    }
  //--------------------------------------------------------------------------------------------------------
 }

?>