<?php

 class UserAccount_Schema{
	 static function Shakehand()
	 {
		 $jsonSchema = '{   "Type": "object",
							"Properties": { "User_ID": { "Type": "string" },
							                "Password": { "Type": "string" } 
										  },
							 "Required": ["User_ID", "Password"]
						}';
						
		return $jsonSchema;
    }
  //--------------------------------------------------------------------------------------------------------
  
  
     static function Login()
	 {  $jsonSchema = '{   "Type": "object",
							"Properties": { "User_ID": { "Type": "string" },
							                "Password": { "Type": "string" },
                                            "OTP": { "Type": "string" }											
										  },
							 "Required": ["User_ID", "Password", "OTP"]
						}';
		 return $jsonSchema;
	 }
  //--------------------------------------------------------------------------------------------------------
  
	static function Update()
		{  $jsonSchema = '{   "Type": "object",
								"Properties": { "User_ID": { "Type": "string" },
												"Password": { "Type": "string" },
												"Account_Privilege": { "Type": "string" }
																							
											},
								"Required": ["User_ID", "Password", "Account_Privilege"]
							}';
			return $jsonSchema;
		}
	//--------------------------------------------------------------------------------------------------------
 }

?>