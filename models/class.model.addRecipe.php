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
 

session_start ();
	
include "class.model.common.php"; // includes common functionality such as DBConnect()

DBConnect();
 
error_reporting(E_ERROR);

$action = $_GET['action'];

if($action=="addrecipe"){

	addRecipe($Host, $User, $DBPassword, $DBName, $table_1, $table_2, $table_3);	
		
}


function addRecipe($Host, $User, $DBPassword, $DBName, $table_1, $table_2, $table_3){

	$Link = mysqli_connect($Host, $User, $DBPassword, $DBName);

	//COLLECT POST data
	$formValue=array();
	foreach ($_POST as $key => $value) {
		$formValue[$key] = strip_tags($value);//remove html tags
		$formValue[$key] = str_replace("'", "&#39;", $value);//remove single quotes
		
		$testOutput = $testOutput.$key.": ".$formValue[$key].", ";
	}//close for each

	if($formValue[$key]==""){
		$message = "Please Fill In The Missing Field(s)!";
		echo json_encode(array('console.log'=>'missing data from the form','error'=>$message));
		exit();
	}//close missing field condition

//DEBUG Send Back Data To The Controller
//echo json_encode(array('console.log'=>$testOutput));
	$User_ID = $_SESSION['User_ID'];
	$filename = "recipeImages/".$formValue['filenames'][0]; //need to create this folder
	$Query = "INSERT INTO $table_2 VALUES ('0','".$User_ID."', '".$formValue['name']."', '".$formValue['description']."', '".$formValue['type']."')";	//modify to fit your own recipe table

//Has the query executed?							
	if(mysqli_query($Link, $Query)){
	//echo json_encode(array('console.log'=>$Query));
	//return the last id
	$recipes_id = mysqli_insert_id($Link);
	
	//insert for new image
	$Query2 = "INSERT INTO $table_3 VALUES ('0', '".$recipes_id."', '".$filename."')";											
	echo json_encode(array('console.log'=>$Query2));
		if(mysqli_query($Link, $Query2)){

			$message = "You Have Successfully Created The recipe!";	 
			//Send Back to the Controller
			echo json_encode(array('action'=>'success','html'=>$message, 'console.log'=>$Query));
			}
	}//close insert query conditional 

}// close function



//now that we have a valid db record, upload the image to the diretory	

			$data = array();
 				if(isset($_GET['files']))
					{  
						$error = false;
						$files = array();
						 
							$uploaddir = '../recipeImages/';
							foreach($_FILES as $file)
							{
								if(move_uploaded_file($file['tmp_name'], $uploaddir .$file['name']))
								{
									$files[] = $uploaddir .$file['name'];
								}
								else
								{
								    $error = true;
								}
							}
							$data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
						}
						else
						{	

								$data = array('success' => 'Form was submitted', 'formData' => $_POST);
						}
						 
						echo json_encode($data);

?>