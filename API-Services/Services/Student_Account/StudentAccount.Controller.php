<?php
    
     require_once ("StudentAccount.Model.php");
      
    $Method = strtoupper($_SERVER['REQUEST_METHOD']);
    $Data = file_get_contents('php://input');
	  
    $ObjData=json_decode($Data);
	 
	 
	if(strtoupper($Method)=="POST")
	   { 
	     if(strtoupper($ObjData->Request)=="UPDATE")		{StudentAccount::UpdateRecord($ObjData->Record);}
		 else if(strtoupper($ObjData->Request)=="FETCH")	{StudentAccount::FetchRecord($ObjData->Record);}
		  
		 else{ echo json_encode(Array("Status"=> "Error: Service request is not valid."), JSON_UNESCAPED_UNICODE);}
		 
		 
	   } else{ echo json_encode(Array("Status"=> "Error: POST method is required in the process."), JSON_UNESCAPED_UNICODE);}
 
?>