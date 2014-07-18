function cancel(){
	window.location = "http://harvardp4-harvardp3.rhcloud.com/all";
}

function ok(){
	var p1 = $("#p1").val();
	var p2 = $("#p2").val();
	var old = $("#old").val();
	
	if(p1 === p2){
		$.ajax({
		  url: 'http://harvardp4-harvardp3.rhcloud.com/change-password',
		  type: 'post',
		  data: {'password1': p1, 'password2': p2, 'old': old},
		  success: function(data, status) {
		    if(data === "ok"){
			    window.location = "http://harvardp4-harvardp3.rhcloud.com/all";
		    }
		  },
		  error: function(xhr, desc, err) {
		  }
		});
	}
	else{
		changeError();
	}
}

$('.regular-input').keyup(function(e){
  $(".error-change").slideUp();
});


function changeError(){
  $(".error-change").slideDown();
}