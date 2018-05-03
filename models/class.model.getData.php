<?php

include "class.model.common.php";

DBConnect();

$Link = mysqli_connect($Host, $User, $DBPassword, $DBName);



$action = $_GET['action'];

if($action=="getAllRecipes"){

getAllRecipes($Host, $User, $DBPassword, $DBName, $table_1, $table_2, $table_3);

}



//1. 

function getAllRecipes($Host, $User, $DBPassword, $DBName, $table_1, $table_2, $table_3){

$Link = mysqli_connect($Host, $User, $DBPassword, $DBName);



$Query = "SELECT * FROM $table_2";

if($Result = mysqli_query($Link, $Query)){

//For each category	

$array_recipes = array();	

$n=0;

while($row = mysqli_fetch_array($Result)){

//Get the data for the category

$recipe_id = $row['id'];

$recipe_name = $row['name'];

$recipe_description = nl2br($row['description']);

$recipe_type = $row['type'];

//Nested Query to return the related images

$Query2 = "SELECT * FROM $table_3 WHERE recipes_id ='".$recipe_id."' ";

if($Result2 = mysqli_query($Link, $Query2)){

while($row2 = mysqli_fetch_array($Result2)){


$img_full = $row2['filename'];

}

}

//Create an array object 

$array_recipes[] = array('success'=>true, 'recipe_id'=>$recipe_id, 'recipe_name'=>$recipe_name, 'recipe_description'=>$recipe_description,'recipe_type'=>$recipe_type, 'img_full'=>$img_full);

$n++;	

}//close while loop

//Send data to the Controller function

echo json_encode(array('action'=>$success,'rec'=>$array_recipes));

exit();

}else{

//Send Error for the first query

echo json_encode(array('action'=>'mysql error', 'console.log'=>$Query));

exit();

}//close condition

}//Close Function

?>