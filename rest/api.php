<?php
header("Content-Type: text/html; charset=utf-8");
	/*
		This is an example class script proceeding secured API
		To use this class you should keep same as query string and function name
		Ex: If the query string value rquest=delete_user Access modifiers doesn't matter but function should be
		     function delete_user(){
				 You code goes here
			 }
		Class will execute the function dynamically;

		usage :

		    $object->response(output_data, status_code);
			$object->_request	- to get santinized input

			output_data : JSON (I am using)
			status_code : Send status message for headers

	
 	*/

	require_once("Rest.inc.php");
	//require_once("statements.php");
	$configs = include('config.php');

	class API extends REST {

		public $data = "";

		const DB_SERVER = "localhost";
		const DB_USER = "bindasrishant";
		const DB_PASSWORD = "";
		const DB = "c9";
		const HASHKEY = "f@ckH1kar1";
		const EMAILSUFFIX = "altmail-1.appspotmail.com";
		
		private $cookieTmp = NULL;
		private $db = NULL;
		private $createNewEmailInDb = NULL;
		private $fetchEmails = NULL;
		private function prepareDbStatements(){
			$this->checkEmailExists = $this->db->prepare("SELECT name from emails where sessionId = ? LIMIT 1");
			$this->createNewEmailInDb = $this->db->prepare("INSERT INTO emails (name,sessionId) VALUES (?,?)");
			$this->fetchEmails = $this->db->prepare("SELECT * from mailData where emailId = ?");
			$this->insertReceivedEmail = $this->db->prepare("INSERT into mailData(emailId,sender,content,receivedTime,subject)VALUES(?,?,?,CURRENT_TIMESTAMP,?)");
		}



		public function __construct(){
			parent::__construct();				// Init parent contructor
			$this->dbConnect();				// Initiate Database connection
			$this->prepareDbStatements();			// Prepare DB Statements
		}

		/*
		 *  Database connection
		*/
		private function dbConnect(){
			$this->db=new mysqli(self::DB_SERVER,self::DB_USER,self::DB_PASSWORD,self::DB);
		}

		/*
		 * Public method for access api.
		 * This method dynmically call the method based on the query string
		 *
		 */
		public function processApi(){
			$func = strtolower(trim(str_replace("/","",$_REQUEST['rquest'])));
			$this->cookieTmp = $_COOKIE["PHPSESSID"];
			if((int)method_exists($this,$func) > 0)
				$this->$func();
			else
				$this->response('',404);			// If the method not exist with in this class, response would be "Page not found".
		}

		private function checkMailExists($sessionId){
		   if($this->checkEmailExists  != null){
	   		   $tmp=$this->checkEmailExists ->bind_param("s", $sessionId);
			   if(false==$tmp){return false;}
	        	   $tmp=$this->checkEmailExists ->execute();
			   if(false==$tmp){return false;}
			   	  $tmp = $this->checkEmailExists->get_result();
                  while($row= mysqli_fetch_assoc($tmp)){
                     $newEmail=$row["name"];
                  }
			   	   $this->checkEmailExists ->close();
			return $newEmail;
		   }
                   else return false;
                }

		private function insertNewMailInDB($newEmail,$sessionId){
		   if($this->createNewEmailInDb  != null){
	   		   $tmp=$this->createNewEmailInDb ->bind_param("ss", $newEmail,$sessionId);
			   if(false===$tmp){return false;}
	        	   $tmp=$this->createNewEmailInDb ->execute();
			   if(false===$tmp){return false;}
                   $this->createNewEmailInDb ->close();
			     	return $newEmail;
		   }
                   else return false;
                }

		private function getEmail(){
			// Cross validation if the request method is POST else it will return "Not Acceptable" status
			if($this->get_request_method() != "GET"){
				$this->response('',406);
			}
			
			$result=$this->checkMailExists($this->cookieTmp);
			if($result==false){
			//Generating New Email
			$time = time();
			$hash = md5( self::HASHKEY.$time);
        	$newEmail = $hash."@".self::EMAILSUFFIX;
			$result=$this->insertNewMailInDB($newEmail,$this->cookieTmp);
			if($result!=false){
				$result=array("Email"=>$result,"session"=>$this->cookieTmp);
				$this->response($this->json($result), 200);
			}
			else {
			$error = array('status' => "Failed", "msg" => "Unable to create");
			$this->response($this->json($error), 400);
			}
			   }
			else {
				$result=array("Email"=>$result,"session"=>$this->cookieTmp);
				$this->response($this->json($result), 200);
			}
		}
		
		// private function updateMailStatus(){
		// 	// Cross validation if the request method is GET else it will return "Not Acceptable" status
		// 	if($this->get_request_method() != "POST"){
		// 		$this->response('',406);}
  //          if(!empty($this->_request['mailId'])){
		// 	$mailId = $this->_request['mailId'];
  //          $result = array();}
		// 	// Input validations
		// 	// If invalid inputs "Bad Request" status message and reason
		// 	$error = array('status' => "Failed", "msg" => "Invalid Email address");
		// 	$this->response($this->json($error), 400);	
		// }
		
		private function receiveMail(){
			file_put_contents('log.txt', print_r($this->_request, true));
			if($this->get_request_method() != "POST"){
				$this->response('',406);}
		
            if(!empty($this->_request['to'])|| !empty($this->_request['from'])||!empty($this->_request['subject'])||!empty($this->_request['date'])||!empty($this->_request['body'])){
           
                $to=($this->_request['to']);
                $from=($this->_request['from']);
            	$subject = $this->_request['subject'];
            	$body = $this->_request['body'];
            
            
               if($this->insertReceivedEmail  != null){
	   		   $tmp=$this->insertReceivedEmail ->bind_param("ssss",$to,$from,$body,$subject);
	   		   if(false===$tmp){$this->response('', 204);}
	           $tmp=$this->insertReceivedEmail ->execute();
	           //$asd = array("original"=>$this->_request['to'],"to"=>$to,"from"=>$from,"subject"=>$subject,"body"=>$body,"date"=>$date,"execute"=>$tmp);
				//if(false===$tmp){$this->response('', 204);}
	           $debugs = array("abc" => $this->insertReceivedEmail);
	           if(false===$tmp){$this->response($this->json($debugs), 204);}
               $this->insertReceivedEmail ->close();
			   $success = array('status' => "Success", "msg" => "Inserted !!");
			   $this->response($this->json($success), 200);
				}
			/*	$asd = array("to"=>$to,"from"=>$from,"subject"=>$subject,"body"=>$body,"date"=>$date);
				$this->response($this->json($asd),200);*/
              }	
              
             else {
				$error = array('status' => "Failed", "msg" => "Invalid Email address");
				$this->response($this->json($error), 400);
                }  
		}

		private function getMails(){
			// Cross validation if the request method is GET else it will return "Not Acceptable" status
			if($this->get_request_method() != "POST"){
				$this->response('',406);}
            if(!empty($this->_request['email'])){
			$email = $this->_request['email'];
            $result = array();
			// Input validations
			if(!empty($email)){
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				  if($this->fetchEmails  != null){
			      $tmp=$this->fetchEmails ->bind_param("s", $email);
               	  if(false===$tmp){return false;}
	        	  $tmp=$this->fetchEmails ->execute();
	              if(false===$tmp){return false;}
                  $tmp = $this->fetchEmails->get_result();
                  while($row= mysqli_fetch_assoc($tmp)){
                  	file_put_contents('log2.txt', print_r($row, true));
                     array_push($result,$row);
                  }
			      $this->fetchEmails ->close();
                if(empty($result)) {
                  $this->response('', 204);
                }else {
                  $this->response($this->json($result), 200);
                }
   						// If success everythig is good send header as "OK" and user details
						}
	             // If no records "No Content" status
			        	}
		     	    }
  			    }
				// If invalid inputs "Bad Request" status message and reason
				$error = array('status' => "Failed", "msg" => "Invalid Email address");
				$this->response($this->json($error), 400);
		 	}

    	/*
		 *	Encode array into JSON
	 	*/
		private function json($data){
			if(is_array($data)){
				return json_encode($data);
			}
		}
	}

	// Initiiate Library

	$api = new API;
	$api->processApi();
?>
