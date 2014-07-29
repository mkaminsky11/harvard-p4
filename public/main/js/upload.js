function replaceAll(find, replace, str) {
  return str.replace(new RegExp(find, 'g'), replace);
}

function handleFileSelect(evt) {


	$("#drop_zone").css("border","none");
	$("#drop_zone").find("h4").remove();

	evt.stopPropagation();
    evt.preventDefault();

    var files = evt.dataTransfer.files; // FileList object.
	
	console.log(files);
	
	for(var i = 0; i < files.length; i++){
		var f = files[i];
		
		var reader = new FileReader();

	    // Closure to capture the file information.
	    reader.onload = (function(theFile) {
	      return function(e) {
	      
	      
	      	
			  	
	      	var imageType = /text.*/;
		  	console.log(theFile.type);
		  	var base = "<div class='result-div'><h6>"+theFile.name;
		  	
		  	var icon = "<i class='fa fa-check'></i>";
		  	
		  	var lang = "none";
		  	
		  	if(theFile.type === "text/javascript"){
			  	lang = "javascript";
		  	}
		  	else if(theFile.type === "text/html"){
			  	lang = "markup";
		  	}
		  	else if(theFile.type === "text/php"){
			  	lang = "php";
		  	}
		  	else if(theFile.type === "text/css"){
			  	lang = "css";
		  	}
		  	
			if (theFile.type.match(imageType)) {
	        	var text = e.target.result;
				
				var final_text = "New Snippet\n"+lang+"\ntag\n" + text;
				//show the output
				
				final_text = replaceAll("<","&lt;", final_text);
				final_text = replaceAll(">","&gt;", final_text);
				  	
				text = replaceAll("<","&lt;", text);
				text = replaceAll(">","&gt;", text);
				  	
				
				$.ajax({
				  url: 'http://harvardp4-harvardp3.rhcloud.com/uploadFile',
				  type: 'post',
				  data: {'content': final_text},
				  success: function(data, status) {
				    console.log(data);
				    
					
		    		var tags = "<div class='tag-div'><span>tag</span></div>";
		    		//$tags = "<div class='tag-div'><span>".implode("</span><span>", $tag_array)."</span></div>";
		    		
		    		var to_push = "<div class='snip-item' data-tag='tag' data-id='"+data+"' data-title='New Snippet'>";
		    		to_push = to_push + "<div class='header-item'><h4>New Snippet</h4>";
		    		to_push = to_push + "<core-tooltip label='Remove' class='fancy' position='top'>";
		    		to_push = to_push + "<paper-icon-button icon='close' onclick='removeSnip(\""+data+"\")'></paper-icon-button></core-tooltip>";
		    		to_push = to_push + "<core-tooltip label='Create' class='fancy' position='top'>";
		    		to_push = to_push + "<paper-icon-button icon='create' data-path='"+data+"'></paper-icon-button></core-tooltip>";
		    		
		    		var relative_path = data.replace("editor","store");
		    		
		    		to_push = to_push + "<core-tooltip label='Download as text file' class='fancy' position='top'>";
		    		to_push = to_push + "<paper-icon-button icon='file-download' onclick='downloadFile(\""+relative_path+"\")'></paper-icon-button></core-tooltip>";
		    		
		    		to_push = to_push + "<core-tooltip label='Download as PDF' class='fancy' position='top'>";
		    		to_push = to_push + "<paper-icon-button icon='drive-pdf' onclick='pdf(\""+relative_path+"\")'></paper-icon-button></core-tooltip></div>	";
		    		
		    		to_push = to_push + "<div class='message-item'><pre><code class='language-"+lang+"'>" + text + "</code></pre>" + tags + "</div></div>";
		    		
		    		$(".main-container").html($(".main-container").html() + to_push);
		    		
		    		Prism.highlightAll();
		    		
				  },
				  error: function(xhr, desc, err) {
				  }
				});
				
			}
			else{
				console.log("not ok!");
				icon = "<i class='fa fa-ban'></i>";
			}
			
			base = base + "</h6>" + icon + "</div>";
			
			$("#drop_zone").html($("#drop_zone").html() + base);
	      };
	    })(f);
	
	    reader.readAsText(f);
	}
}

function handleDragOver(evt) {
	evt.stopPropagation();
    evt.preventDefault();
    evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
}

// Setup the dnd listeners.
var dropZone = document.getElementById('drop_zone');
dropZone.addEventListener('dragover', handleDragOver, false);
dropZone.addEventListener('drop', handleFileSelect, false);

