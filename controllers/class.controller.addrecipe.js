$(document).ready(function() {
	console.log('add reipe controller file linked');
	$('#addRecipe').submit(function(){

		console.log("add recipe button clicked");
		
		var postData = $(this).serialize();
		console.log(postData);
		
		$.mobile.loading('show', {text: 'Adding New Recipe - Please Wait',textVisible: true,theme: 'a'});
		
		//*****Ajax JSON call will SEND and RECEIVE data back from the model****
		  $.ajax({
			  type: 'POST',
			  dataType: "json",
			  data: postData,
			  
		//Always external URL in an App
		url: 'http://localhost/models/class.model.addRecipe.php?action=addRecipe',
			  
			  success: function(data){
	  
			console.log(data);
			 //alert('Data sent and received successfully!');
			 

			//display the data in the html JSON array back to the user
			 $('<div></div>').html(data.html).appendTo('.msg');

			 
			 $.mobile.loading('hide');
	
			  },
			  error: function(){
				  console.log(data);
				  alert('There was an error handling your registration!');
				  $.mobile.loading('hide');		  }
		  
		  });

		//$.mobile.loading('hide');});
		
		return false;

	}); //close handler
});