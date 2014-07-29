var title = "";
var lang = "";
var content = "";
var r_path = "";
var tags = "";


var t, $tag_box;
t = $( "#tagBox" ).tagging();
$tag_box = t[0];


editor = CodeMirror(document.getElementById("editor"),{
  lineNumbers: true,
  mode: "text",
  theme: "monokai",
  lineWrapping: true,
  indentUnit: 4,
  indentWithTabs: true
});
$(".CodeMirror").css("height","100%");
$(".CodeMirror").css("line-height", "1");
editor.refresh();

var path = document.URL;
r_path = path.replace("editor","store");
r_path = r_path + ".txt?t=" + Date.now();

var txtFile = new XMLHttpRequest();
txtFile.open("GET", r_path, true);
txtFile.onreadystatechange = function()
{
	if (txtFile.readyState === 4) {  // document is ready to parse.
		if (txtFile.status === 200) {  // file is found
			var allText = txtFile.responseText; 
			var array = allText.split("\n");
			title = array[0];
			lang = array[1];
			tags = array[2].split(" ");
			$tag_box.tagging( "add", tags );
			content = array.slice(3).join("\n");
			editor.setValue(content);
			$(".search-input").val(title);
			
			
			setLang(lang);
		}
	}
}
txtFile.send(null);


function js(){
	lang = "javascript";
	editor.setOption("mode","text/javascript");
}
function html(){
	lang = "html";
	editor.setOption("mode","text/html");
}
function php(){
	lang = "php";
	editor.setOption("mode","application/x-httpd-php");
}
function css(){
	lang = "css";
	editor.setOption("mode","text/css");
}
function text(){
	lang = "text";
	editor.setOption("mode","text");
}

function cancel(){
	window.location = "http://harvardp4-harvardp3.rhcloud.com/";
}

function save(){
	title = $(".search-input").val();
	var the_tags = $tag_box.tagging( "getTags" ).join(" ");
	var c = title + "\n" + lang + "\n" + the_tags + "\n" + editor.getValue();
	$.ajax({
	  url: 'http://harvardp4-harvardp3.rhcloud.com/edit-snip',
	  type: 'post',
	  data: {'title': title, 'content': c, 'path': document.URL + ".txt"},
	  success: function(data, status) {
		  if(data === "ok"){
			  window.location = "http://harvardp4-harvardp3.rhcloud.com/";
		  }
	  },
	  error: function(xhr, desc, err) {
	  }
	});
}

function setLang(l){
	if(l === "javascript"){
		editor.setOption("mode","text/javascript");
	}
	else if(l === "php"){
		editor.setOption("mode","application/x-httpd-php");
	}
	else if(l === "css"){
		editor.setOption("mode","text/css");
	}
	else if(l === "html"){
		editor.setOption("mode","text/html");
	}
	else if(l === "java"){
		editor.setOption("mode","text/x-java");
	}
	else if(l === "c"){
		editor.setOption("mode","text/x-csrc");
	}
	else if(l === "cpp"){
		editor.setOption("mode","text/x-c++src");
	}
	else if(l === "csharp"){
		editor.setOption("mode","text/x-csharp");
	}
	else if(l === "coffeescript"){
		editor.setOption("mode","text/x-coffeescript");
	}
	else if(l === "python"){
		editor.setOption("mode","text/x-python");
	}
	else if(l === "aspnet"){
		editor.setOption("mode","text/x-aspx");
	}
	else if(l === "http"){
		editor.setOption("mode","message/http");
	}
	else if(l === "ruby"){
		editor.setOption("mode","text/x-ruby");
	}
	else if(l === "text"){
		editor.setOption("mode","text");
	}
	
	lang = l;
	
	$("#select select").val(l);
}

$("#select select").on('change', function(){
	setLang(this.value);
});