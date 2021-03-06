//validates the email before being validated again in the php

function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 


//logs out
function logout(){
	$.ajax({
	  url: 'http://harvardp4-harvardp3.rhcloud.com/logout',
	  type: 'post',
	  data: {},
	  success: function(data, status) {
	    if(data === "ok"){
		    window.location = "http://harvardp4-harvardp3.rhcloud.com/";
	    }
	  },
	  error: function(xhr, desc, err) {
	  }
	});
}



function new_snip(){
	$.ajax({
	  url: 'http://harvardp4-harvardp3.rhcloud.com/add-snip',
	  type: 'post',
	  data: {},
	  success: function(data, status) {
		  //console.log(data);
		  var to_go = data.replace(".txt",""); //go here
		  window.location = to_go;
	  },
	  error: function(xhr, desc, err) {
	  }
	});
}

//redirects to editor
$(".edit-button").each(function(index){
	$(this).click(function(){
		var path = $(this).attr("data-path").replace(".txt","");
		window.location = path;
	});
});

//for syntax highlighting in prism "language-markup" NOT "language-html"
$(".language-html").each(function(index){
	$(this).addClass("language-markup");
	$(this).removeClass("language-html");
});

Prism.highlightAll(); //redoes it

function removeSnip(p){
	$("[data-id='"+p+"'").fadeOut("slow",function(){
		$("[data-id='"+p+"'").remove();	
		$("[data-goto='"+p+"'").remove();	
		
		bind();
		
		if($(".snip-item").length === 0){
			$("#insert").after("<h2 class='none'><paper-shadow z='2'></paper-shadow>You have no snippets. Make Some!</h2>");
		}
	});
	
	var file = p.replace("editor","store");
	
	$.ajax({
	  url: 'http://harvardp4-harvardp3.rhcloud.com/remove-snip',
	  type: 'post',
	  data: {'path':p, 'file': file},
	  success: function(data, status) {
		  
	  },
	  error: function(xhr, desc, err) {
	  }
	});
}


//onchange, changes search
$('.search-input').keyup(function(e){
	search($('.search-input').val());
});

function search(query){
	$('.snip-item').each(function(){
		var c = $(this).html().toLowerCase();
		c = c + $(this).attr("data-tag");
		c = c + $(this).attr("data-title");
		var q = query.toLowerCase(); 
		
		if(c.indexOf(q) !== -1){
			$(this).fadeIn();
		}
		else{
			$(this).fadeOut();
		}
	});

}

function downloadFile(url){
	var r_path = url + "?t=" + Date.now();

	var txtFile = new XMLHttpRequest();
	txtFile.open("GET", r_path, true);
	txtFile.onreadystatechange = function()
	{
		if (txtFile.readyState === 4) {  // document is ready to parse.
			if (txtFile.status === 200) {  // file is found
				var allText = txtFile.responseText; 
				var array = allText.split("\n");
				content = array.slice(3).join("\n");
				
				document.location = 'data:Application/octet-stream,' +encodeURIComponent(content);
				document.querySelector('#toast').show();
			}
		}
	}
	txtFile.send(null);
}

function pdf(url){
	var r_path = url + "?t=" + Date.now();

	var txtFile = new XMLHttpRequest();
	txtFile.open("GET", r_path, true);
	txtFile.onreadystatechange = function()
	{
		if (txtFile.readyState === 4) {  // document is ready to parse.
			if (txtFile.status === 200) {  // file is found
				var allText = txtFile.responseText; 
				var array = allText.split("\n");
				content = array.slice(3);
				
				
				//adds each line
				var doc = new jsPDF();
				for(var i = 0; i < content.length; i++){
					doc.text(20, 20 + (10 * i), content[i]);
				}
				doc.save('Snippet.pdf');
				document.querySelector('#toast').show();
			}
		}
	}
	txtFile.send(null);
}

function settings(){
	if($(".detect").css("display") === "none"){
		$(".detect").fadeIn("slow",function(){
			$(".setting-panel").slideDown("fast",function(){
				
			});
		});
	}
	else{
		$(".detect").fadeOut("slow",function(){
			$(".setting-panel").slideUp("fast",function(){
				
			});
		});
	}
}

$(".detect").click(function(){
	settings();
});

function upload(){
	if($(".upload-detect").css("display") === "none"){
		$(".upload-detect").fadeIn("slow",function(){

			$(".upload-panel").slideDown("fast",function(){

			});
		});
	}
	else{
		$(".upload-detect").fadeOut("slow",function(){
			//$(".upload-panel h4").css("border","none");
			$(".upload-panel").slideUp("fast",function(){

			});
		});
	}
}

$(".upload-detect").click(function(){
	upload();
});


//resizes the search input
$(".search-input").blur(function(){
	$(".search-input").animate({
		width: "90px"
	}, 1000, function(){
		
	});
});

$(".search-input").focus(function(){
	$(".search-input").animate({
		width: "300px"
	}, 1000, function(){
		
	});
});

bind();


//binds the "quick view" to respective items
function bind(){
	$(".goto-item").each(function(index){
		$(this).click(function(){
			var path = $(this).attr("data-goto");
			var a = $("[data-id='"+path+"'");
			
			
			$('.snipbar').animate({
	        	scrollTop: a.offset().top
			}, {
				duration: 300,
				queue: false
			});
		});
	});
}