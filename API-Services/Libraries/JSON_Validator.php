<?php

  /****************************************************/
  /* Function : JSON Schema Validator                  /
  /* Author   : Armando Saguin Jr.                     / 
  /* Email    : saguin.armando.jr@gmail.com            /
  /* Mobile   : +639306694943                          /
  /****************************************************/
 
class JSON {
	
  static function ValidateSchema($JSON_Data, $Json_Schema){
	 foreach ($Json_Schema['Properties'] as $key => $property) {
        if (isset($JSON_Data[$key])) {
            // Check data type
            $dataType = gettype($JSON_Data[$key]);
             
            if ($dataType !== $property['Type']) {
			   if($property['Type']!="object" && $dataType!="array")
			     { return Array("Valid" => false, 
	 	                        "Status" => "Error=> The '{$key}' property should have its value assigned in accordance with the data type '{$property['Type']}' as specified by the Schema.");  
					 }  	
              }
		    
			 // Check nested arrays data
			if($property['Type']== "array" && $dataType =="array")
			     {  for($Cnt=0; $Cnt < Count($JSON_Data[$key]); $Cnt++)
					 { $itemType = gettype($JSON_Data[$key][$Cnt]);
					   if($property['Properties']['Type']!== $itemType)
					      { return Array("Valid" => false, 
	 	                                 "Status" => "The '{$key}' array element should have its value assigned in accordance with the data type '{$property['Properties']['Type']}' as specified by the Schema.");  
						  }
                       if(isset($property['Properties']['Maximum']) && $JSON_Data[$key][$Cnt] > $property['Properties']['Maximum'])
					      {  return Array("Valid" => false, 
	 	                                  "Status" => "Error=> The element value of the '{$key}' property should adhere to the schema by being assigned a value that is less than {$property['Properties']['Maximum']}.");
						  }	
                       if(isset($property['Properties']['Minimum']) && $JSON_Data[$key][$Cnt] < $property['Properties']['Minimum'])
					      {return Array("Valid" => false, 
	 	                                "Status" => "Error=> The element value of the '{$key}' attribute must adhere to the schema by being assigned a value that exceeds {$property['Properties']['Minimum']}.");
						   }
					   if(isset($property['Properties']['MinLength']) && $JSON_Data[$key][$Cnt] < $property['Properties']['MinLength'])
					      {return Array("Valid" => false, 
	 	                                "Status" => "Error=> The element value of the '{$key}' attribute must adhere to the schema by being assigned a value that exceeds {$property['Properties']['MinLength']}.");
						   }
					   if(isset($property['Properties']['MaxLength']) && $JSON_Data[$key][$Cnt] < $property['Properties']['MaxLength'])
						{return Array("Valid" => false, 
										"Status" => "Error=> The element value of the '{$key}' attribute must adhere to the schema by being assigned a value that exceeds {$property['Properties']['MaxLength']}.");
						}				
					  }
				   }
            // Check minimum and maximum values
            if (isset($property['Minimum']) && $JSON_Data[$key] < $property['Minimum']) {
                 return Array("Valid" => false, 
	 	                      "Status" => "Error=> The value of the '{$key}' attribute must adhere to the schema by being assigned a value that exceeds {$property['Minimum']}.");
            }
            if (isset($property['Maximum']) && $JSON_Data[$key] > $property['Maximum']) {
               return Array("Valid" => false, 
	 	                    "Status" => "Error=> The value of the '{$key}' property should adhere to the schema by being assigned a value that is less than {$property['Maximum']}.");
            }
			// Check minimum and maximum length
			if (isset($property['MinLength']) && strlen($JSON_Data[$key]) < $property['MinLength']) {
				return Array("Valid" => false, 
					"Status" => "Error=> The value of the '{$key}' property should adhere to the schema by being assigned a value with a minimum length of {$property['MinLength']} characters.");
			}
			if (isset($property['MaxLength']) && strlen($JSON_Data[$key]) > $property['MaxLength']) {
				return Array("Valid" => false, 
					"Status" => "Error=> The value of the '{$key}' property should adhere to the schema by being assigned a value with a maximum length of {$property['MaxLength']} characters.");
			}
			// Check email format
			if (isset($property['Format']) && !filter_var($JSON_Data[$key], FILTER_VALIDATE_EMAIL)) {
				 return Array("Valid" => false, 
	 	                      "Status" => "Error=> The '{$key}' property's value must confirm to the Email format as defined by the schema.");
            }
			if(isset($property['Text']) && $property['Text'] === 'letter'){
				$pattern = '/^[A-Za-z\s]+$/';
				if(!preg_match($pattern, $JSON_Data[$key])){
					return Array("Valid" => false,
								"Status" => "Error => The value for {$key} property should consist of letters only as define bt the schema.");
				}
			}
            // Check nested objects or arrays
            if ($property['Type'] === 'object' && isset($property['Properties'])) {
                if ( !Self::ValidateSchema($JSON_Data[$key], $property)) {return false;}
				        for($Cnt=0; $Cnt < Count($property['Required']); $Cnt++)
					       {
							if (!isset($JSON_Data[$key][$property['Required'][$Cnt]])) {
					            return Array("Valid" => false, 
	 	                                     "Status" => "Error=> The value for the '{$property['Required'][$Cnt]}' property should be set in accordance with the schema.");
		                           // Required property missing
			                   }
				           }			
			 }
			 
        } elseif (isset($Json_Schema['Required'])) {
		 	if(in_array($key, $Json_Schema['Required'])){
			 if(!isset($JSON_Data[$key]))
			    {  return Array("Valid" => false, 
	 	                     "Status" => "Error=> The value for the '{$key}' property should be set in accordance with the schema.");
		           // Required property missing
			    }
			}
				
				
        }
    }

     return Array("Valid" => true, 
	 	          "Status" => "The data is valid based on the required format of the JSON Schema.");
		
    }
   // End Function....	
 }
//==============================================================================================================================================================================================================================
?>   