<?php

 class Attachment_Schema{
	 static function InsertRecord()
	 {
		 $jsonSchema = '{   "Type": "object",
							"Properties": { 
                                            "Student_ID": {"Type": "string"},
                                            "Attachment_Type": {"Type": "string"},
                                            "File_Name": {"Type": "string"},
                                            "File_Data": {"Type": "string"},
                                            "Date_Submitted": {"Type": "string"},
                                            "File_Status": {"Type": "string"}
		 								  },
							 "Required": ["Student_ID", "Attachment_type", "File_Name", "Date_Submitted", "File_Status"]
						}';					
		return $jsonSchema;
    }
  //--------------------------------------------------------------------------------------------------------
    static function UpdateRecord()
    {
        $jsonSchema = '{   "Type": "object",
                            "Properties": { 
                                            "Attachment_No": {"Type": "integer"},
                                            "File_Status": {"Type": "string"}
                                           },
                            "Required": ["Attachment_No", "File_Status"]
                        }';					
        return $jsonSchema;
    }
 }

?>