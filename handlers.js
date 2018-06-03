var NotEditingText = "Not editing any review (use form above to fetch)";
var EditingPrefix = "Currently editing review with id=";
var editing = 0;

$(document).ready(function(){
    $("#editText").html(NotEditingText);

	$("#readForm").submit(function(){
		event.preventDefault();

		$.ajax({
			url: "http://kulina.gearhostpreview.com/read.php",
			data: {"id" : $("#txtId")[0].value},
			type: "GET",
			success: function(resp){
				console.log(resp);
			}
		});
	});
});