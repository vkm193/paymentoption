function loadDataOrForm()
{
	var fbId = true;
	if($.session.get('buttonRefer') == "True" && fbId)
	{
		$('#enterYourInput').show();
		$.session.set('buttonRefer', "False");
		$("#state").val($.session.get("state"));
		$("#cityVillage").val($.session.get("city"));
		$("#area").val($.session.get("locArea"));
		$("#street").val($.session.get("street"));
	}	
}

function ShowHideDiv() {
        if($("#ccdc").is(":checked"))
		{
			$("#percentageTax").show();
			$("#ccdcValue").val("1");
		}else{
			$("#percentageTax").hide();
			$("#ccdcTax").val(0);
			$("#ccdcValue").val("0");
		}
    }
  
$(document).ready(function(){
    $('#myTable').dataTable();
	var fbId = true;
	loadDataOrForm();
	$('#addEntry').click(function(){
		$.session.set('buttonRefer', "True");
		if(fbId)
		{
			if($.session.get('buttonRefer') == "True")
			{
				loadDataOrForm();
			}
		}else
		{
			window.location.href = "fbloginsdk/fblogin.php";
		}
	});
	ShowHideDiv();
	$("#ccdc").click(function(){
		ShowHideDiv();
	});
	$("#paytm").click(function(){
		if($("#paytm").is(":checked"))
		{
			$("#paytmValue").val("1");
		}else{
			$("#paytmValue").val("0");
		}
	});
	
	$(".vendorName").click(function(){
		var vid = $(this).attr("vid");
		var locid = $(this).attr("locid");
		$.ajax({
			url: "db/updateEntry.php",
			method: "post",
			dataType: "json",
			data: {"vid": vid, "locid": locid},
			success: function(result){
				$('#enterYourInput').show();
				$("#state").val(result.state);
				$("#cityVillage").val(result.city_village);
				$("#area").val(result.locArea);
				$("#street").val(result.street);
				$("#vendor").val(result.name);
				$("#ccdc").prop("checked", parseInt(result.ccdc));
				$("#ccdcValue").val(result.ccdc);
				if(parseInt(result.ccdc)){
					$("#percentageTax").show();
				}else{
					$("#percentageTax").hide();
				}
				$("#ccdcTax").val(result.ccdctax);
				$("#paytm").prop("checked", parseInt(result.paytm));
				$("#paytmValue").val(result.paytm);
			},
			fail: function(result){
				$("#myModal").modal("hide");
				$('#enterYourInput').hide();
			}
		});
	});
	$('.clearable').clearSearch();
	$('[data-toggle="tooltip"]').tooltip(); 
	$('form').validate();
});