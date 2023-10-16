<?php
 class SanctionSchema{
	 static function InsertRecord()
	 {
		 $jsonSchema = '{   "Type": "object",
                            "Properties": { 
                                            "sanction_no": {"Type": "integer"},
                                            "min_absences": {"Type": "integer"},
                                            "max_absences": {"Type": "integer"},
                                            "sanction_desc": {"Type": "string"}
                                        },
                            "Required": ["sanction_no","min_absences", "max_absences", "sanction_info"]
                        }';			
		return $jsonSchema;
    }
//--------------------------------------------------------------------------------------------------------
    // static function UpdateRecord()
    // {
    //     $jsonSchema = '{   "Type": "object",
    //                         "Properties": { 
    //                                         "attachment_no": {"Type": "integer"},
    //                                         "file_status": {"Type": "string"},
    //                                         "date_validated": {"Type": "string"}
    //                                     },
    //                         "Required": ["attachment_no", "file_Status", "date_validated"]
    //                     }';					
    //     return $jsonSchema;
    // }
//--------------------------------------------------------------------------------------------------------
 }

?>