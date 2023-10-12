<?php

 class College_Schema{
	 static function UpdateCollege()
	 {
		 $jsonSchema = '{"Type":  "Object",
						"Properties":  {  "college_info":  {  "Type":  "Object",
									"Properties":  {  "college_code":  {  "Type":  "integer"  },
												"college_description":  {  "Type":  "string"  }}, 
									"Required":  ["college_code",  "college_description"]},
						"Required":  ["college_info"]
		}';
						
		return $jsonSchema;
    }
  //--------------------------------------------------------------------------------------------------------
  
  
     static function SearchCollege()
	 {  $jsonSchema = '{   "Type": "object",
							"Properties": { "SearchKey": { "Type": "string" }
										},
							"Required": ["SearchKey"]
						}';
		 return $jsonSchema;
	 }
  //--------------------------------------------------------------------------------------------------------
  
 }
