$(document).ready(function() {

	//GetAllRecipes();
	GetRecipeOfDay();


function GetRecipeOfDay()
	{
		$('.listRecipesOfDay').empty();
		$.mobile.loading('show', {text: 'Loading Your Recipes',textVisible: true,theme: 'a'});

		//Web service call to get the data
		var getRecipeOfTheDay = $.get("http://localhost/models/recipeOfTheDay.php?action=getRecipeOfDay",

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
				var recipeDetails =  formateRecipe(recipe_id, img_full, recipe_name, recipe_description, recipe_type) + '<div style="clear:both;"></div>';
				
				
				$('.listRecipesOfDay').append(''+recipeDetails+'');
				
				//$('.images_'+j).append('test image' ); not needed
				j = j +1; $.mobile.loading('hide');
			
			}//close loop
