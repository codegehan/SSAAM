<?php

 class Major_Schema{
	 static function UpdateMajor()
	 {
		 $jsonSchema = '{"Type": "Object",
						"Properties": { "major_info": {"Type": "Object",
											"Properties": {"major_code": {"Type": "integer" },
											"program_code": {"Type": "integer"}, 
											"major_description": {"Type": "string"}
											},

											"Required": ["major_code", "program_code", "major_description"]
											},
						"Required": ["major_info"]
			
		}';
						
		return $jsonSchema;
    }
  //--------------------------------------------------------------------------------------------------------
  
  
     static function SearchMajor()
	 {  $jsonSchema = '{   "Type": "object",
							"Properties": { "SearchKey": { "Type": "string" }
										},
							"Required": ["SearchKey"]
						}';
		 return $jsonSchema;
	 }
  //--------------------------------------------------------------------------------------------------------
  
 }
