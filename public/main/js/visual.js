var local_color = false;
var local_tag = false;

document.getElementById("tag_toggle").addEventListener('change',function(){
	if(local_tag){
		//change it!
		var value = document.getElementById("tag_toggle").checked;
		localStorage.setItem("tags",value);
		
		if(value){
			$(".tag-div").css("display","block");
		}
		else{
			$(".tag-div").css("display","none");
		}
	}
	else{
		local_tag = true;
	}
});

document.getElementById("blue").addEventListener('change',function(){
  if(local_color){
	  console.log("blue");
	  if(document.getElementById("blue").checked){
		  $("#mainheader").css("background-color","#455a64");
		  $("#mainheader").css("color","white");
		  $("core-toolbar paper-icon-button").css("color","white");
		  
		  $(".header-item").css("background-color","#455a64");
		  $(".header-item").css("color","white");
		  $(".header-item paper-icon-button").css("color","white");
		  
		  $(".search-input").css("background-color","#78909c");
		  
		  localStorage.setItem("color","blue");
	  }
  }
  else{
	  local_color = true;
  }
});

document.getElementById("gray").addEventListener('change',function(){
  console.log("gray");
  if(document.getElementById("gray").checked){
	  $("#mainheader").css("background-color","#fafafa");
	  $("#mainheader").css("color","black");
	  $("core-toolbar paper-icon-button").css("color","black");
	  
	  $(".header-item").css("background-color","#fafafa");
	  $(".header-item").css("color","black");
	  $(".header-item paper-icon-button").css("color","black");
	  
	  $(".search-input").css("background-color","#e0e0e0");
	  
	  localStorage.setItem("color","gray");
  }
});

document.getElementById("red").addEventListener('change',function(){
  console.log("red");
  if(document.getElementById("red").checked){
	  $("#mainheader").css("background-color","#e51c23");
	  $("#mainheader").css("color","white");
	  $("core-toolbar paper-icon-button").css("color","white");
	  
	  $(".header-item").css("background-color","#e51c23");
	  $(".header-item").css("color","white");
	  $(".header-item paper-icon-button").css("color","white");
	  
	  $(".search-input").css("background-color","#f36c60");
	  
	  localStorage.setItem("color","red");
  }
});

document.getElementById("green").addEventListener('change',function(){
  console.log("green");
  if(document.getElementById("green").checked){
	  $("#mainheader").css("background-color","#1de9b6");
	  $("#mainheader").css("color","white");
	  $("core-toolbar paper-icon-button").css("color","white");
	  
	  $(".header-item").css("background-color","#1de9b6");
	  $(".header-item").css("color","white");
	  $(".header-item paper-icon-button").css("color","white");
	  
	  $(".search-input").css("background-color","#64ffda");
	  
	  localStorage.setItem("color","green");
  }
});

document.addEventListener('polymer-ready', function() {
  getPrefs();
});

function getPrefs(){
	//get values
	if(localStorage.getItem("color") === null){
		//nothing yet
		localStorage.setItem("color","blue");
	}
	else{
		var color = localStorage.getItem("color");
		if(color === "blue"){
			//good
		}
		else if(color === "gray"){
			document.getElementById("gray").checked = true;
			document.getElementById("blue").checked = false;
		}
		else if(color === "red"){
			document.getElementById("red").checked = true;
			document.getElementById("blue").checked = false;
		}
		else if(color === "green"){
			document.getElementById("green").checked = true;
			document.getElementById("blue").checked = false;
		}
	}
	
	if(localStorage.getItem("tags") === null){
		localStorage.setItem("tags","true");
	}
	else{
		var value = localStorage.getItem("tags") == "true"; //true or false
		if(!value){
			$(".tag-div").css("display","none");
			document.getElementById("tag_toggle").checked = false;
		}
		else{
		}
	}
}