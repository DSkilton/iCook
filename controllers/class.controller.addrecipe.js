// Variable to store your files
$(document).ready(function() {
	
console.log('add recipe controller file linked');
var files;
 
// Add events
$('input[type=file]').on('change', prepareUpload);
 
// Grab the files and set them to our variable
function prepareUpload(event)
{
	console.log("got inside prepare upload");
  files = event.target.files;
}



$('#createNewRecipe').on('submit', uploadFiles);

// Catch the form submit and upload the files
function uploadFiles(event)
{
console.log("got inside upload files");
//alert('submit button pressed')
  event.stopPropagation(); // Stop stuff happening
    event.preventDefault(); // Totally stop stuff happening
 
    // START A LOADING SPINNER HERE
 
    // Create a formdata object and add the files
	var data = new FormData();
	$.each(files, function(key, value)
	{
		data.append(key, value);
	});

   console.log("got inside uploadFiles function");
    $.ajax({
        url: 'models/class.model.addRecipe.php?files',
        type: 'POST',
        data: data,
        cache: false,
        dataType: "json",
        processData: false, // Don't process the files
        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
        success: function(data, textStatus, jqXHR)
        {
        	if(typeof data.error === 'undefined')
        	{
        		// Success so call function to process the form
        		submitForm(event, data);
        	}
        	else
        	{
        		// Handle errors here
        		console.log('ERRORS: ' + data.error);
        	}
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
        	// Handle errors here
        	console.log('ERRORS: ' + textStatus);
        	// STOP LOADING SPINNER
        }
    });
}

function submitForm(event, data)
{
  // Create a jQuery object from the form

  //alert('submitForm function')
	$form = $(event.target);
	
	// Serialize the form data
	var formData = $form.serialize();

	// You should sterilise the file names
	$.each(data.files, function(key, value)
	{
		//formData = formData + '&filenames[]=' + value;

		$.each($form.find("input[type='file']"), function(i, tag) {
			
			$.each($(tag)[0].files, function(i, file) {
	            //console.log(tag.name, file);

	            console.log(file.name);

				formData = formData + '&filenames[]=' + file.name;
				
					        
	        });
	});
	
	
	
	});

	$.ajax({
		url: 'models/class.model.addRecipe.php?action=addrecipe',
        type: 'POST',
        data: formData,
        cache: false,
        dataType: 'json',
        success: function(data, textStatus, jqXHR)
        {
        	if(typeof data.error === 'undefined')
        	{
        		;				
				// Success so call function to process the form
        		console.log('SUCCESS: ' + data.success);
        	}
        	else
        	{
        		// Handle errors here
        		console.log('ERRORS: ' + data.error);
        	}
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
        	// Handle errors here
        	console.log('ERRORS: ' + textStatus);
        },
        complete: function()
        {
        	alert("You have added a recipe");
				$.mobile.changePage('#dashboard')// STOP LOADING SPINNER
        }
	});
}

});

