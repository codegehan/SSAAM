<?php

 class Attachment_Schema{
	 static function InsertRecord()
	 {
		 $jsonSchema = '{   "Type": "object",
							          "Properties": { 
                          "student_id": {"Type": "string"},
                          "attachment_description": { "Type": "object",
                                                      "Properties": { "file_type": {"Type": "string"},
                                                                      "status": {"Type": "string"}
                                                                    }, "Required": ["file_type", "status"]
                                                    },
                          "attachment_data": {"Type": "string"}
		 								},
							 "Required": ["student_id", "attachment_description", "attachment_data"]
						}';					
		return $jsonSchema;
    }
  //--------------------------------------------------------------------------------------------------------
    static function UpdateRecord()
    {
        $jsonSchema = '{   "Type": "object",
                            "Properties": { 
                                            "attachment_no": {"Type": "integer"},
                                            "file_status": {"Type": "string"},
                                            "date_validated": {"Type": "string"}
                                           },
                            "Required": ["attachment_no", "file_Status", "date_validated"]
                        }';					
        return $jsonSchema;
    }
 }

?>