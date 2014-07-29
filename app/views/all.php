<!doctype html>
<html lang="en">
<head>
  <script src="poly/platform/platform.js"></script>

  <link rel="import" href="poly/polymer/polymer.html">
  <link rel="import" href="poly/core-collapse/core-collapse.html">
  <link rel="import" href="poly/core-drawer-panel/core-drawer-panel.html">
  <link rel="import" href="poly/core-header-panel/core-header-panel.html">
  <link rel="import" href="poly/core-icon-button/core-icon-button.html">
  <link rel="import" href="poly/core-icons/core-icons.html">
  <link rel="import" href="poly/core-input/core-input.html">
  <link rel="import" href="poly/core-item/core-item.html">
  <link rel="import" href="poly/core-meta/core-meta.html">
  <link rel="import" href="poly/core-overlay/core-overlay.html">
  <link rel="import" href="poly/core-scaffold/core-scaffold.html">
  <link rel="import" href="poly/core-scroll-header-panel/core-scroll-header-panel.html">
  <link rel="import" href="poly/core-style/core-style.html">
  <link rel="import" href="poly/core-tooltip/core-tooltip.html">
  <link rel="import" href="poly/core-toolbar/core-toolbar.html">

  <link rel="import" href="poly/polymer/polymer.html">
  <link rel="import" href="roboto.html">
  <link rel="import" href="poly/paper-button/paper-button.html">
  <link rel="import" href="poly/paper-checkbox/paper-checkbox.html">
  <link rel="import" href="poly/paper-dialog/paper-dialog.html">
  <link rel="import" href="poly/paper-fab/paper-fab.html">
  <link rel="import" href="poly/paper-icon-button/paper-icon-button.html">
  <link rel="import" href="poly/paper-input/paper-input.html">
  <link rel="import" href="poly/paper-menu-button/paper-menu-button.html">
  <link rel="import" href="poly/paper-progress/paper-progress.html">
  <link rel="import" href="poly/paper-radio-button/paper-radio-button.html">
  <link rel="import" href="poly/paper-radio-group/paper-radio-group.html">
  <link rel="import" href="poly/paper-ripple/paper-ripple.html">
  <link rel="import" href="poly/paper-shadow/paper-shadow.html">
  <link rel="import" href="poly/paper-slider/paper-slider.html">
  <link rel="import" href="poly/paper-tabs/paper-tabs.html">
  <link rel="import" href="poly/paper-toast/paper-toast.html">
  <link rel="import" href="poly/paper-toggle-button/paper-toggle-button.html">
	<meta charset="UTF-8">
	<title>SnipSafe</title>

  <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="js/jquery.js"></script>

  <link rel="stylesheet" href="main/css/style.css">
  <link rel="stylesheet" href="main/css/upload.css">
  <link rel="stylesheet" href="lib/prism/prism.css">

  <link rel="shortcut icon" type="image/png" href="favicon.png"/>
  <link rel="shortcut icon" type="image/png" href="http://harvardp4-harvardp3.rhcloud.com/favicon.png"/>
  
  <link rel="stylesheet" href="http://harvardp4-harvardp3.rhcloud.com/lib/tag/tag.css">">
  

</head>

<body>
	<div class="upload-panel" style="display:none">
		<div id="drop_zone">
			<h4>Drop Files Here</h4>
		</div>
	</div>
	
	<div class="upload-detect" style="display:none"></div>
	
	<div class="setting-panel" style="display:none">
		<paper-icon-button icon="close" class="close-settings" onclick="settings()"></paper-icon-button>
		<h3>Color Scheme</h3>
		<paper-radio-group selected="blue">
			<paper-radio-button name="blue" label="Dark" id="blue"></paper-radio-button>
			<paper-radio-button name="gray" label="Light" id="gray"></paper-radio-button>
			<paper-radio-button name="red" label="Angry" id="red"></paper-radio-button>
			<paper-radio-button name="green" label="Calm" id="green"></paper-radio-button>
		</paper-radio-group>
		
		<br/>
		
		<h3>Other</h3>
		<div center horizontal layout>
	      <div flex>Use Tags</div>
	      <paper-toggle-button id="tag_toggle" checked></paper-toggle-button>
	    </div>
		
		
	</div>
    <div class="detect" style="display:none"></div>

	
    <core-toolbar id="mainheader">
      <img src="img/lock.svg" height="24px" class="logo"><span flex>SnipSafe</span>
      
      
      <paper-icon-button icon="add" onclick="new_snip()"></paper-icon-button>
      <input type="text" placeholder="Search" class="search-input">
      <span class="email"><?php echo(Auth::user()->email); ?></span>
      <paper-icon-button icon="file-upload" onclick="upload()"></paper-icon-button>
      <paper-icon-button icon="settings" onclick="settings()"></paper-icon-button>
      <paper-icon-button icon="exit-to-app" onclick="logout()"></paper-icon-button>
      
    </core-toolbar>
    
    <a class="change-div" href="http://harvardp4-harvardp3.rhcloud.com/changepass">
	    <h5>
	    	Change Password
	    </h5>
    </a>
    
    <div class="main-container">
    	
    	<?php
    		$email = Auth::user()->email;
    		$results = DB::select('select * from snips where email = ?', array($email));
    		
    		$size = sizeof($results);
    		
    		if($size == 0){
	    		echo("<h2 class='none'><paper-shadow z='2'></paper-shadow>You have no snippets. Make Some!</h2>");
    		}
    		else{
	    		for($i = 0; $i < $size; $i++){
		    		$path = $results[$i]->path;

					$relative_path = str_replace("editor","store",$path);
					
		    		$content_all = file_get_contents($relative_path);
		    		$content_all = str_replace("<", "&lt;", $content_all);
		    		$content_all = str_replace(">", "&gt;", $content_all);
		    		
		    		$array = explode("\n",$content_all);
		    		
		    		$lang = $array[1];
		    		
		    		if($lang == "text"){
			    		$lang == "none";
		    		}
		    		
		    		if($lang == "html"){
			    		$lang == "markup";
		    		}
		    		
		    		$title = $array[0];
		    		
		    		$tag_array = explode(" ", $array[2]);
		    		$data_tag = $array[2];
		    		$tags = "<div class='tag-div'><span>".implode("</span><span>", $tag_array)."</span></div>";
		    		if($data_tag == ''){
			    		$tags = '';
		    		}
		    		
		    		$array = array_slice($array, 3);
		    		
		    		$content = implode("\n", $array);
		    		
		    		
		    		echo('<div class="snip-item" data-tag="'.$data_tag.'" data-id="'.$path.'" data-title="'.$title.'">
		    				<!--paper-shadow z="2"></paper-shadow-->
		    				<div class="header-item">
		    					<h4>'.$title.'</h4>
		    				
		    				<core-tooltip label="Remove" class="fancy" position="top">	
								<paper-icon-button icon="close" onclick="removeSnip(\''.$path.'\')"></paper-icon-button>
							</core-tooltip>
							
							<core-tooltip label="Edit" class="fancy" position="top">		
		    					<paper-icon-button class="edit-button" icon="create" data-path="'.$path.'"></paper-icon-button>
		    				</core-tooltip>
		    				
		    				<core-tooltip label="Download as text file" class="fancy" position="top">	
		    					<paper-icon-button icon="file-download" onclick="downloadFile(\''.$relative_path.'\')"></paper-icon-button>
		    				</core-tooltip>
		    				
		    				<core-tooltip label="Download as PDF" class="fancy" position="top">	
								<paper-icon-button icon="drive-pdf" onclick="pdf(\''.$relative_path.'\')"></paper-icon-button>
							</core-tooltip>
		    			</div>
		    			<div class="message-item">
		    				<pre><code class="language-'.$lang.'">'.$content.'</code></pre>'.$tags.'</div>
		    		</div>');
	    		}
    		}
    	?>
    	
    </div>
    
    <paper-toast id="toast" text="File Downloaded!" style="padding-right: 60px;"></paper-toast>
    
    <script src="lib/codemirror/lib/codemirror.js"></script>
	<link rel="stylesheet" href="lib/codemirror/lib/codemirror.css">
	<script src = 'lib/codemirror/mode/css/css.js'></script>
	<script src = "lib/codemirror/mode/mode.js"></script>
	<script src = "lib/codemirror/mode/swift.js"></script>
	<link rel='stylesheet' type='text/css' href='lib/codemirror/theme/theme.css'>
	<link rel='stylesheet' type='text/css' href='lib/codemirror/theme/code-your-cloud.css'>
    <link rel="stylesheet" href="lib/codemirror/addon/dialog/dialog.css" >
	<script src="lib/codemirror/addon/comment/comment.js" ></script>
	<script src="lib/codemirror/addon/dialog/dialog.js" ></script>
	<script src="lib/codemirror/addon/search/search.all.js" ></script>
	<script src="lib/codemirror/addon/edit/edit.min.js"></script>
    
    <script src="lib/tag/tag.js"></script>
    <script src="lib/pdf/pdf.js"></script>

    
    <script src="lib/prism/prism.js"></script>
	<script src="main/js/main.js"></script>
	<script src="main/js/visual.js"></script>
	<script src="main/js/upload.js"></script>
</body>
</html>