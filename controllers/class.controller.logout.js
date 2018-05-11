$(document).on('click', '#logout', function() {

	$.get("http://M1610718.spaces.middlesbro.ac.uk/httpdocs/cst_1718/webapp/controllers/class.model.logout.php", function() {
      $.mobile.changePage('#home');
    });
	

});//end logout