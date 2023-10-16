<?php

 class Course_Schema{
	 static function UpdateCourse()
	 {
		 $jsonSchema = '{"Type": "object",
						 "Properties": {
							"college_code": {"Type": "integer"},
							"college_description": {"Type": "string"}
						 }, "Required": ["college_code", "college_description"]
		}';
						
		return $jsonSchema;
    }
  //--------------------------------------------------------------------------------------------------------
  
     static function UpdateProgram()
	 {  $jsonSchema = '{   "Type": "object",
						   "Properties": {
											"program_code": {"Type": "integer"} ,
											"college_code": { "Type": "integer" },
											"program_description": { "Type": "string" }
										},
							"Required": ["college_code", "program_description"]
						}';
		 return $jsonSchema;
	 }
  //--------------------------------------------------------------------------------------------------------
  
	static function UpdateMajor()
	{  $jsonSchema = '{   "Type": "object",
						  "Properties": { 
											"major_code": {"Type": "integer"},
											"program_code": { "Type": "integer" },
											"major_description": { "Type": "string" }
										},
							"Required": ["program_code", "major_description"]
						}';
		return $jsonSchema;
	}

 //--------------------------------------------------------------------------------------------------------
  
	static function GetRequest()
	{  $jsonSchema = '{   "Type": "object",
						  "Properties": { 
											"request": {"Type": "string"}
										},
							"Required": ["request"]
						}';
		return $jsonSchema;
	}
 }

?>