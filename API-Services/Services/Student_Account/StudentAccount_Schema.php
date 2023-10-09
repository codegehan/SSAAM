<?php

 class StudentAccount_Schema{
	 static function UpdateRecord()
	 {
		 $jsonSchema = '{   "Type": "object",
							"Properties": { "Student_ID": { "Type": "string" },
							                "Fullname": {"Type": "object",
														 "Properties": { "Firstname" : { "Type": "string"},
														 				 "Middlename": { "Type": "string" },
																		 "Lastname": { "Type": "string"},
																		 "Suffix": { "Type": "string" }
																	   }, "Required" : ["Firstname", "Lastname"]
														},
											"Contact_No": { "Type": "string", "MinLength": "11", "MaxLength": "13" },
											"Email": { "Type": "string", "Format": "email" },
											"Profile": {"Type": "string"}
		 								  },
							 "Required": ["Student_ID", "Fullname", "Contact", "Email", "Profile"]
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