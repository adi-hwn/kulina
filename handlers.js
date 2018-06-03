var NotEditingText = "Not editing any review (use form above to fetch)";
var EditingPrefix = "Currently editing review with id=";
var editing = 0;

$(document).ready(function(){
    $("#editText").html(NotEditingText);

	$("#readForm").submit(function(){
		event.preventDefault();

		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		       // Typical action to be performed when the document is ready:
		       console.log(xhttp.responseText);
		    }
		};
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.open("POST", "http://kulina.gearhostpreview.com/read.php", true);
		xhttp.send("id=" + $("#txtId")[0].value);

		console.log();
	});
});