<?php

class Course_Schema
{

	static function UpdateProgramEnroll()
	{
		$jsonSchema = '{ "Type":  "Object",
						   "Properties":  {  "student_id":  {  "Type":  "Int"  },
						   "program_code":  {  "Type":  "Int"  },
						   "major_code":  {  "Type":  "Int"  },
						   "others":  {  "Type":  "string"  }}, 

						"Required":["student_id","program_code","major_code","others",]},

	   }';

		return $jsonSchema;
	}
	//--------------------------------------------------------------------------------------------------------


	static function SearchProgramEnroll()
	{
		$jsonSchema = '{   "Type": "object",
						   "Properties": { "_student_id": { "Type": "string" }
									   },
						   "Required": ["_student_id"]
					   }';
		return $jsonSchema;
	}
	//--------------------------------------------------------------------------------------------------------


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
	{
		$jsonSchema = '{   "Type": "object",
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
	{
		$jsonSchema = '{   "Type": "object",
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
	{
		$jsonSchema = '{   "Type": "object",
						  "Properties": { 
											"request": {"Type": "string"}
										},
							"Required": ["request"]
						}';
		return $jsonSchema;
	}
}
