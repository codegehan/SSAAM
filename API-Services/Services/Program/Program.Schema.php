<?php

 class Program_Schema{
	 static function UpdateProgram()
	 {
		 $jsonSchema = '{"Type": "Object",
		 				"Properties":  {  "program_info":  {  "Type":  "Object",
		 								"Properties":  {  "program,_code":  {  "Type":  "integer"  }, 
													"program_description":  {  "Type":  "string"  }, 
													"college_code":  {  "Type":  "integer"}},

		 								"Required": ["program,_code", "program_description", "college_code"]
		 },
		 "Required":  ["program_info"]
		}';
						
		return $jsonSchema;
    }
  //--------------------------------------------------------------------------------------------------------
  
  
     static function SearchProgram()
	 {  $jsonSchema = '{   "Type": "object",
							"Properties": { "SearchKey": { "Type": "string" }
										},
							"Required": ["SearchKey"]
						}';
		 return $jsonSchema;
	 }
  //--------------------------------------------------------------------------------------------------------
  
 }
