<?php



error_reporting(E_ERROR);
//Connection To MYSQL DataBase
//Function called in external scripts 



function DBConnect(){
//add further global vars at the end of the line below once you have created them in the database admin tool
global $Host, $User, $DBPassword, $DBName, $table_1, $table_2, $table_3, $table_4 ;

$Host = "10.20.3.37:3306";
$User = "M1610718";
$DBPassword = "Skil27";
$DBName = "M1610718_iCook";
//add links to your new tables here as well

$table_1 = "users";
$table_2 = "recipe";
$table_3 = "recipe_images";
$table_4 = "favourites";


//IMPORTANT!Comment out this block when connection is successful!
/*if(mysqli_connect($Host, $User, $DBPassword, $DBName)){
	print "MySQL Connection Active!";
	}else{
	print "MySQL Connection Error! Please Check Details In class.model.common.php!";
	} */


}//close function

//DBConnect();
?>
