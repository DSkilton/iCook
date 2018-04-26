//$(document).ready(function() {
	
getTrip();
	
//$('#trip').append("test");
//get a simple list of trips
function getTrip(){
	
	//$('table#trip').append("test");
	$('table#trip').empty();
	$('table#sectors').empty();
	
$.get("https://u0018370.scm.tees.ac.uk/MAD_complete/models/class.model.getDashBoardData.php?action=getTrip",
function(data) {
//table row
var tr;


for (var i = 0; i < data.tripData.length; i++) {
tr = $('');

tr = "<td>" + data.tripData[i] + "</td>";

$('table#trip').append(tr);

//$('table#trip').append("test");

//alert(data.tripData[i]);
}

//Refresh JQM
$( "div#home[data-role=page]" ).trigger("create");

}, "json");

getTripSectors();
return false;
};//Close Function



//get a list of all sectors for this trip
function getTripSectors(){

//Remove any exosting data
//$('table').empty();

	

$.get("https://u0018370.scm.tees.ac.uk/MAD_complete/models/class.model.getDashBoardData.php?action=getTripSectors",

function(data) {


var k = 0;
var tr;


for (var i = 0; i < data.sectorsData.length; i++) {

if(i ==1){
tr = $('');
tr.append(""+ data.sectorsData[i] + "");
//$('table#sectors').append(tr);
$('table#sectors').append("<td class='tr_bg2'>" + data.sectorsData[i] + "</td>");
k=0;
}

else{

tr = $('');
tr.append(""+ data.sectorsData[i] + "");
//$('table#sectors').append(tr);
$('table#sectors').append("<td class='tr_bg'>" + data.sectorsData[i] + "</td>");
k=1;
}

}

//Refresh JQM
$( "div#home[data-role=page]" ).trigger("create");

}, "json");




return false;


};//Close Function*/
//});