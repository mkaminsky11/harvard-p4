

function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 

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

$(".edit-button").each(function(index){
	$(this).click(function(){
		var path = $(this).attr("data-path").replace(".txt","");
		window.location = path;
	});
});

$(".language-html").each(function(index){
	$(this).addClass("language-markup");
	$(this).removeClass("language-html");
});

Prism.highlightAll();

function removeSnip(p){
	$("[data-id='"+p+"'").slideUp("slow",function(){
		$("[data-id='"+p+"'").remove();	
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
			$(this).slideDown();
		}
		else{
			$(this).slideUp();
		}
	});

}