<?php
/**
 * class.model.registerUser.php
 *
 * The purpose of the file is to register users of the website using their first name, last name, email address and password. This file uses JSON to encode data back to the controller.
 *
 * PHP version 5.3
 *
 
 * @author  Original Author you@live.tees.ac.uk
 
 * @version SVN:1.0
 
 */
 
include "class.model.common.php";

DBConnect();
 
error_reporting(E_ERROR);

$action = $_GET['action'];

if($action=="register"){
	registerUser($Host, $User, $DBPassword, $DBName, $table_1);
}

function registerUser($Host, $User, $DBPassword, $DBName, $table_1){
$Link = mysqli_connect($Host, $User, $DBPassword, $DBName);
	
//COLLECT POST data
$formValue=array();
foreach ($_POST as $key => $value) {
$formValue[$key] = strip_tags($value);//remove html tags
$formValue[$key] = str_replace("'", "'", $value);//remove single quotes
  
if($formValue[$key]==""){
  $message = "Please Fill In The Missing Field(s)!";
  echo json_encode(array('console.log'=>'missing data from the form','html'=>$message));
  exit();
  }//close missing field condition
 

$testOutput = $testOutput.$key.": ".$formValue[$key].", ";
  
}//close for each

$email = $formValue['email'];
//Check if the owner has an email in the table - 
$Query = "SELECT email FROM $table_1 WHERE email = '".$email."'";
$Result = mysqli_query($Link, $Query);
$Row = mysqli_fetch_array($Result);
$email_check = $Row['email'] ;
//If the owner already has data, do not allow them to add more!
if( $email == $email_check){
$message = "Sorry, you have already created an account under this email address!";	 
//Send Back to the Controller
echo json_encode(array('action'=>'error','html'=>$message));
exit();
						
}else{
			
//Match not found so carry on with the registration process
	
$PassWord = $formValue['PassWord'];
//Remove All Whitespace from the string
$PassWord = preg_replace('/\s/', '', $PassWord);

$Query = "INSERT INTO $table_1 VALUES ('0', '".$formValue['firstN']."', '".$formValue['lastN']."', '".$email."', '".$PassWord."')";											
											
											
//Has the query executed?							
if(mysqli_query($Link, $Query)){
$message = "You Have Successfully Created The Account!";	 
//Send Back to the Controller
echo json_encode(array('action'=>'login','html'=>$message, 'console.log'=>$Query));

		}else{
$message = "mySQL issue, check PHP and database";	 
//Send Back to the Controller
echo json_encode(array('action'=>'error','html'=>$message, 'console.log'=>$Query));

		//close insert query conditional 

}
				
}//close email check conditional


}//close function



?>