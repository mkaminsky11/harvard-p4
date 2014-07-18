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
			
			if(lang === "javascript"){
				editor.setOption("mode","text/javascript");
			}
			else if(lang === "php"){
				editor.setOption("mode","application/x-httpd-php");
			}
			else if(lang === "css"){
				editor.setOption("mode","text/css");
			}
			else if(lang === "html"){
				editor.setOption("mode","text/html");
			}
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