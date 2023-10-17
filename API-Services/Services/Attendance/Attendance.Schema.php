<?php

 class Attendance_Schema{
	 static function UpdateAttendance()
	 {
		 $jsonSchema = '{"Type": "object",
						 "Properties": {
							"student_id": {"Type": "string"},
							"activity_no": {"Type": "integer"},
              "attendance_type":  {"Type": "string"},
              "attendance_date": {"Type": "string"},
              "day_type":{"Type": "string"}
						 }, "Required": ["student_id", "activity_no", "attendance_type","attendance_date","day_type"]
		      }';
		return $jsonSchema;
    }
  //--------------------------------------------------------------------------------------------------------
 }

?>