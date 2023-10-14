<?php

 class Program_Enroll_Schema{
	 static function UpdateProgramEnroll()
	 {
		 $jsonSchema = '{ "Type":  "Object",
							"Properties":  {  "enrollment_info":  {  "Type":  "Object",
							"Properties":  {  "student_id":  {  "Type":  "Int"  },
							"program_code":  {  "Type":  "Int"  },
							"major_code":  {  "Type":  "Int"  },
							"others":  {  "Type":  "string"  }}, 

							"Required":["student_id","program_code","major_code","others",]},

						"Required":  ["enrollment_info"]
		}';
						
		return $jsonSchema;
    }
  //--------------------------------------------------------------------------------------------------------
  
  
     static function SearchProgramEnroll()
	 {  $jsonSchema = '{   "Type": "object",
							"Properties": { "_student_id": { "Type": "string" }
										},
							"Required": ["_student_id"]
						}';
		 return $jsonSchema;
	 }
  //--------------------------------------------------------------------------------------------------------
  
 }
