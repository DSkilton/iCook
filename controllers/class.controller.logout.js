$(document).on('click', '#logout', function() {

	$.get("https://u0018370.scm.tees.ac.uk/MAD_complete/models/class.model.logout.php", function() {
      $.mobile.changePage('#home');
    });
	

});//end logout