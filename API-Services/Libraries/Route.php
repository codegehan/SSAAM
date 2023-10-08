<?php
 
  class Route{
	  
			static function Info(){
				
				$Method = strtoupper($_SERVER['REQUEST_METHOD']);
				$Host = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
								"https" : "http") . "://$_SERVER[HTTP_HOST]";
							
				$URL =   (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
	                   
	            $Module="";
				$Process="";
				 
				if(dirname($_SERVER['PHP_SELF'])=="/"){
				  $Module  =  explode(dirname($_SERVER['PHP_SELF']) ,  $_SERVER['REQUEST_URI'])[1];
			      $Process =  explode($Module ."/",  $_SERVER['REQUEST_URI'])[1];	
				 }else{
					   $Request = explode(dirname($_SERVER['PHP_SELF']) ,  $_SERVER['REQUEST_URI'])[1];
					   $Module  = explode("/", $Request)[1];
					   $Process = explode($Module ."/", $Request)[1]; 
					   $URL = $URL . dirname($_SERVER['PHP_SELF']);
				}      
				     
			 return array("Method" => $Method, "Host" => $Host, "URL" => $URL, "Module"=> $Module,  "Process" => $Process) ;
		  }
		  
//==============================================================================================================================================================================
    
	 static function Transmit($Route_URL, $Method, $Data){
		         
		           $Response="";
		             
			              set_error_handler(function($errno, $errstr, $errfile, $errline ){ 
				            throw new  ErrorException($errstr, $errno, 0, $errfile, $errline); 
				            });
				   
				          do {try{ //Request URL Page to open.
				                    
									if(strtoupper($Method)=="POST"){
										$MyCurl = curl_init($Route_URL);
										curl_setopt($MyCurl, CURLOPT_RETURNTRANSFER, true);
										curl_setopt($MyCurl, CURLOPT_POST, true);
										curl_setopt($MyCurl, CURLOPT_POSTFIELDS, $Data);
										curl_setopt($MyCurl, CURLINFO_HEADER_OUT, true);
                                     
										$Response = curl_exec($MyCurl);
                                        curl_close($MyCurl);
									  }else { $Response = '"Status":"Error=> POST method is required in the process."}';  }
                                      
						         }catch(ErrorException $e){ $Response = '"Status":"Error=> Services Not Found..."}';}
							                        
			                  } while ($Response=="");
							   
			return $Response;
	  }

//================================================================================================================================================================================
 		  
	 }
 ?>