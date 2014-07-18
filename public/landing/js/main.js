$(".main").onepage_scroll({
   sectionContainer: "section",    
   easing: "ease",                  
   animationTime: 1000,             
   pagination: true,                
   updateURL: false,                
   beforeMove: function(index) {},  
   afterMove: function(index) {},   
   loop: false,                     
   keyboard: true,                  
   responsiveFallback: false,        
   direction: "vertical"  
});


function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 

$('.ghost-input').keyup(function(e){
  $(".error-signin").slideUp();
  $(".error-signup").slideUp();
});


$('.email-input').keyup(function(e){
	 var val = $(this).val();
  if(validateEmail(val) || val === ""){
    $(this).css("border","solid thin #eee");
  }
  else{
    $(this).css("border","solid thin #e51c23");
  }
});

function signUp(){
  var email = $("#sign_up_email").val();
  var pass1= $("#sign_up_password").val();
  var pass2 = $("#sign_up_confirm").val();
  
  if(validateEmail(email) && pass1 === pass2){
    
    $.ajax({
	  url: 'http://harvardp4-harvardp3.rhcloud.com/add-user',
	  type: 'post',
	  data: {'email': email, 'password1': pass1, 'password2': pass2},
	  success: function(data, status) {
	  	console.log(data);
	    if(data === "ok"){
		    window.location = "http://harvardp4-harvardp3.rhcloud.com/all";
	    }
	    else if(data === "error"){
		    signUpError();
	    }
	  },
	  error: function(xhr, desc, err) {
	  }
	});
    
    
  }
  else{
    signUpError();
  }
}

function signIn(){
  var email = $("#sign_in_email").val();
  var pass = $("#sign_in_password").val();
  
  if(validateEmail(email)){
    
    $.ajax({
	  url: 'http://harvardp4-harvardp3.rhcloud.com/login',
	  type: 'post',
	  data: {'email': email, 'password': pass},
	  success: function(data, status) {
	    if(data === "ok"){
		    window.location = "http://harvardp4-harvardp3.rhcloud.com/all";
	    }
	    else if(data === "error"){
		    signInError();
	    }
	  },
	  error: function(xhr, desc, err) {
	  }
	});
    
  }
  else{
    signInError();
  }
}

function signInError(){
  $(".error-signin").slideDown();
}
function signUpError(){
   $(".error-signup").slideDown();
}