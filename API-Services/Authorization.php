<?php 
 class Authorization{
	 static function Validate($Header, $Service)
	 {  $Header = json_decode(json_encode($Header), true);
	    $Exempted_Services =["SHAKEHAND", "RESETPASSWORD"];
	    $UserAgent = ["Coderstation", "CCS Creative", "PostmanRuntime/7.32.3"];
		//Dummy Security
	    $JWToken = "Bearer eyJUWVAiOiJKV1QiLCJBTEciOiJIUzI1NiJ9.eyJSRUNPUkQiOiJleUpWYzJWeWMxOUJZMk52.STZJbEp2ZDJWdVlTQlRZV2QxYVc0aUxDSl";
	    $API_Key ="JMCS8280C000HaS9448da4501hBaa62295b187HaS4a060cfd05hjM47fcc96a38HaS9448da45";
		$Identify ="477466316933354762314336524167685337385278304B664A624C6A5250507A6331556C50723047675F4D";
        $Status ="";
		//   if(isset($Header["User-Agent"]) && in_array($Header["User-Agent"], $UserAgent)){
		    if(isset($Header["API-Key"]) && ($API_Key==$Header["API-Key"])){
			 if(isset($Header["Identity"]) && $Identify==$Header["Identity"]){
			 if(in_array($Service, $Exempted_Services)===false){	 
			  if(isset($Header["Authorization"]) && ($JWToken==$Header["Authorization"])){
					 $Status ="Client JWT Authorization is successfully validated.";
               }else{$Status = "Error=> Client Authorization is not recognized...";}
			  } 
			 }else{$Status = "Error=> Client Identity is not recognized...";}
			}else{$Status = "Error=> Client API-Key is not recognized...";}
		//  }else{$Status = "Error=> Client User-Agent is not recognized...";}
	  return array("Status" => $Status,"JWToken" => $JWToken) ;
	}
 }
?>