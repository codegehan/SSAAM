<?php

 class Schedule_Schema{
  //--------------------------------------------------------------------------------------------------------
    static function UpdateSchedule()
    {
      $jsonSchema = '{"Type": "object",
              "Properties": {
                "schedule_no": {"Type": "integer"},
                "status": {"Type": "string"},
                "allowed": {"Type": "string"}
              }, "Required": ["schedule_no", "status","allowed"]
            }';
      return $jsonSchema;
      }
 }
 //--------------------------------------------------------------------------------------------------------

?>