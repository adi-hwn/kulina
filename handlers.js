var NotEditingText = "Not editing any review (use form above to fetch)";
var EditingPrefix = "Currently editing review with id=";
var editing = 0;
var editingID = -1;

$(document).ready(function(){

	function getReviewList(){
		$.ajax({
			url: "http://kulina.gearhostpreview.com/list.php",
			data: {"qty" : 20},
			type: "GET",
			success: function(response){
				//console.log(response);
				respObj = JSON.parse(response);
				if(respObj.result == 0){
					editing = 1;
					editingID = $("#txtId")[0].value;
	    			$("#txtList").html(respObj.list_str);
				} else {
					alert("Error when generating ID list");
				}
			}
		});
	}
	$("#txtList").html(getReviewList());

	$("#listForm").submit(function(){
		event.preventDefault();
		$("#txtList").html(getReviewList());
	});

    $("#txtEdit").html(NotEditingText);
    $("#btnStop").click(function(){
    	editing = 0;
    	$("#txtEdit").html(NotEditingText);
    });

	$("#readForm").submit(function(){
		event.preventDefault();

		$.ajax({
			url: "http://kulina.gearhostpreview.com/read.php",
			data: {"id" : $("#txtId")[0].value},
			type: "GET",
			success: function(response){
				//console.log(response);
				respObj = JSON.parse(response);
				if(respObj.result == 0){
					editing = 1;
					editingID = $("#txtId")[0].value;
	    			$("#txtEdit").html(EditingPrefix + respObj.id);

	    			$("#txtOrd").val(respObj.json.order_id);
	    			$("#txtProd").val(respObj.json.product_id);
	    			$("#txtUser").val(respObj.json.user_id);

	    			$("#txtRate").val(respObj.json.rating);
	    			$("#txtRev").val(respObj.json.review);
				} else if(respObj.result == 1){
					alert("Review not found");
				} else if(respObj.result == 2){
					alert("Please enter a review ID");
				}
			}
		});
	});

	$("#cudForm").submit(function(){
		event.preventDefault();
		//console.log($(this).serialize());

		var formSerialized = $(this).serializeArray();
		var formObj = {};
		if(formObj.method != "delete"){
			for(var i = 0; i < formSerialized.length; i++){
				formObj[formSerialized[i].name] = formSerialized[i].value;
			}
		}
		//console.log(formObj);

		if(formObj.method != "create" && editing == 0){
			alert("No review selected. Fetch one using the appropriate ID");
		} else {
			if(formObj.method != "create"){
				formObj["id"] = editingID;
			} 
			$.ajax({
				url: "http://kulina.gearhostpreview.com/" + formObj.method + ".php",
				data: formObj,
				type: "POST",
				success: function(response){
					respObj = JSON.parse(response);
			    	editing = 0;
			    	$("#txtEdit").html(NotEditingText);
			    	$("#cudForm")[0].reset();
					if(respObj.result != 0){
						alert("Error when handling request");
					}
					$("#txtList").html(getReviewList());
				}
			});
		}
	});
});