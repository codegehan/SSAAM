<?php
  
    require_once ("..\..\Libraries\JSON_Validator.php");
	require_once ("StudentAccount_Schema.php");
	
	class StudentAccount{
//=================================================================================================================================================================================================	 
		  
		static function UpdateRecord($Record)
		 {   
			// Validate the JSON data against the schema
			$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(StudentAccount_Schema::UpdateRecord(), true)); 
   
			if($Validate_JSON["Valid"]===true){
				//Dummy Record
				echo '{ "Status" : "Record was successfully updated...",
					    "Record" :
								{ "Student_ID": "123", 
								  "Fullname" : {
									"FirstName" : "Gehan",
									"Middlename" : "Lumantas",
									"LastName" : "Resalute",
									"Suffix" : ""
								  }
								  "Contact_No": "09953924073",
								  "Email": "gehan@gmail.com",
								  "Profile": "gehan.png",
								  "Created_Date" : "2023-10-08 12:40:00"
								}
					  }';
				
			}else{echo '{ "JSON Schema Status" : "' .  $Validate_JSON["Status"] . '"}';}
			
		 }
			  
 //=================================================================================================================================================================================================	 
		 static function SearchRecord($Record)
		  {   
		    // Validate the JSON data against the schema
			$Validate_JSON =  JSON::ValidateSchema(json_decode(json_encode($Record), true), json_decode(StudentAccount_Schema::SearchRecord(), true)); 
   
			if($Validate_JSON["Valid"]===true){
				//Dummy Record
				if($Record->SearchKey=="123"){
				 echo '{"Status" : "Request was successfully processed...",
					   "Record" :{ "Student_ID": "123", 
								   "Name": "Jose Rizal",
								   "Age": 20,
								   "Email": "rizal@gmail.com",
								   "Address": { "Street": "New Town Ave.",
											   "City": "Dipolog City",
											   "Province": "Zamboanga del Norte"
                                             }
								}}';
								
				}else{ echo '{"Status" : "Error=> The Student ID '. $Record->SearchKey .' was not found in the database"}';}
				
			}else{echo '{ "JSON Schema Status" : "' . $Validate_JSON["Status"] . '"}';}

		  
		  }
 
//=================================================================================================================================================================================================	 

			  
	}
	
	?>