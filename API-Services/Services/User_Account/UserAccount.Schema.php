<?php

 class UserAccount_Schema{
	 static function Shakehand()
	 {
		 $jsonSchema = '{   "Type": "object",
							"Properties": { "student_id": { "Type": "string" },
							                "password": { "Type": "string" } 
										  },
							 "Required": ["student_id", "password"]
						}';
						
		return $jsonSchema;
    }
  //--------------------------------------------------------------------------------------------------------
  
  
     static function Login()
	 {  $jsonSchema = '{   "Type": "object",
							"Properties": { "student_id": { "Type": "string" },
							                "password": { "Type": "string" },
                                            "otp": { "Type": "string" }											
										  },
							 "Required": ["student_id", "password", "otp"]
						}';
		 return $jsonSchema;
	 }
  //--------------------------------------------------------------------------------------------------------
  
	static function Update()
		{  $jsonSchema = '{   "Type": "object",
								"Properties": { "student_id": {"Type": "string"},
												"password": {"Type": "string"},
												"account_privilege": {"Type": "string"}										
											},
								"Required": ["student_id","password","account_privilege"]
							}';
			return $jsonSchema;
		}
	//--------------------------------------------------------------------------------------------------------
 }

?>