$(document).ready(function() {

GetAllRecipes();	

function GetAllRecipes()
{

$('.listAllRecipes').empty();

$.mobile.loading('show', {text: 'Loading Your Recipes',textVisible: true,theme: 'a'});

//Web service call to get the data

var getAllrecipeData = $.get("http://localhost/models/class.model.getData.php?action=getAllRecipes",

//data.recipeData

	function(data) 

	{ 

	var j = 0;
	
	var myTotal = data.rec.length ;
	
	for(var i =0; i < data.rec.length;i++)
	
	{ 
	
		var recipe_id = data.rec[i].recipe_id;
		
		var recipe_name = data.rec[i].recipe_name;
		
		var recipe_description = data.rec[i].recipe_description;
		
		var recipe_type = data.rec[i].recipe_type;
		
		var img_full = data.rec[i].img_full;
		
		//determines how the  rows are postioned in the table
		var recipeDetails = '<div style="width:100%; float:left;"><img style="float:left;" src="'+img_full+'" width="300px"><div style="float:left; margin:0 0 0 20px;" class ="expand"><ul><li class="recipeTitle">Name: '+recipe_name+'</h2></li><li>Instructions: '+recipe_description+'</li><li>Type: '+recipe_type+'</li></ul></div></div>';
		
		
		$('.listAllRecipes').append(''+recipeDetails+'');
		
		//$('.images_'+j).append('test image' ); not needed
		
		j = j +1; $.mobile.loading('hide');
	
	}//close loop

}, "json"); 


getAllrecipeData.done(function() 

{ $.mobile.loading('hide');

initExpander();

console.log("Yeeee we got the data" );

})

getAllrecipeData.fail(function() 

{ $.mobile.loading('hide');

alert('something failed!')

}) 

};//Close Function




});