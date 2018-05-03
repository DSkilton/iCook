<?php
/**
 * class.model.registerUser.php
 *
 * The purpose of the file is to register users of the website using their first name, last name, email address and password. This file uses JSON to encode data back to the controller.
 *
 * PHP version 5.3
 *
  
 * @author  Original Author <you@live.tees.ac.uk>
  
 * @version SVN:1.0
  
 */
date_default_timezone_set('Europe/London');
include "class.model.common.php"; // includes common functionality such as DBConnect()
 
DBConnect();
  
  
error_reporting(E_ERROR);
 
 
$action = $_GET['action'];
 
    if($action=="register"){
 
        registerUser($Host, $User, $DBPassword, $DBName, $table_1); 
         
    }
 
 
function registerUser($Host, $User, $DBPassword, $DBName, $table_1){
 
    $Link = mysql_connect($Host, $User, $DBPassword);
 
    //COLLECT POST data
    $formValue=array();
    foreach ($_POST as $key => $value) {
        $formValue[$key] = strip_tags($value);//remove html tags
        $formValue[$key] = str_replace("'", "&#39;", $value);//remove single quotes
         
 
    //AB: put this within the loop
    if($formValue[$key]==""){
        $message = "Please Fill In The Missing Field(s)!";
        echo json_encode(array('console.log'=>'missing data from the form','error'=>$message));
        exit();
    }//close missing field condition
 
        $testOutput = $testOutput.$key.": ".$formValue[$key].", ";
         
    }//close for each
 
 
 
//DEBUG Send Back Data To The Controller
//DEBUG echo json_encode(array('console.log'=>$testOutput));
 
 
$email = $formValue['email'];
//Check if the owner has an email in the table - 
$Query = "SELECT email FROM $table_1 WHERE email = '".$email."'";
$Result = mysql_db_query($DBName, $Query, $Link);
$Row = mysql_fetch_array($Result);
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
    //echo $Query;
    //exit();                                       
                                             
//Has the query executed?                           
if(mysql_db_query($DBName, $Query, $Link)){
            $message = "You Have Successfully Created The Account!";     
            //Send Back to the Controller
            echo json_encode(array('action'=>'login','html'=>$message, 'console.log'=>$Query));
 
        }//close insert query conditional 
                 
}//close email check conditional
 
}
 
?>