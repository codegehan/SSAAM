<?php

 class StudentAccount_Schema{
	 static function UpdateRecord()
	 {
		 $jsonSchema = '{   "Type": "object",
							"Properties": { "student_id": { "Type": "string" },
							                "fullname": {"Type": "object",
														 "Properties": { "firstname" : { "Type": "string"},
														 				 "middlename": { "Type": "string" },
																		 "lastname": { "Type": "string"},
																		 "suffix": { "Type": "string" }
																	   }, "Required" : ["firstname", "lastname"]
														},
											"sex" : {"Type": "string"},
											"program_enroll" : {"Type": "object",
																"Properties": {
																	"college": {"Type": "string"},
																	"program": {"Type": "string"},
																	"major": {"Type": "string"},
																	"other": {"Type": "object",
																		"semester": {"Type": "string"},
																		"school_year": {"Type": "string"}
																	}, "Required": ["semester","school_year"]
																}, "Required": ["college", "program", "major","other"]
											},
											"contact_no": { "Type": "string", "MinLength": "11", "MaxLength": "13" },
											"email_address": { "Type": "string", "Format": "email" },
											"profile": {"Type": "string"}
										 },
							 "Required": ["student_id","fullname","sex","program_enroll","contact_no", "email_address","profile"]
						}';
						
		return $jsonSchema;
    }

	
  //--------------------------------------------------------------------------------------------------------
 }

?>