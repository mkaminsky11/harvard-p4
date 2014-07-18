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
  <link rel="stylesheet" href="lib/prism/prism.css">

  <link rel="shortcut icon" type="image/png" href="favicon.png"/>
  <link rel="shortcut icon" type="image/png" href="http://harvardp4-harvardp3.rhcloud.com/favicon.png"/>
  
  <link rel="stylesheet" href="http://harvardp4-harvardp3.rhcloud.com/lib/tag/tag.css">
</head>

<body>
	<div class="overlay" style="display:none"></div>
	<div id="modal" style="display:none">
		<div class="header-item">
			<paper-icon-button icon="send" onclick="confirmSend()"></paper-icon-button>
			<paper-icon-button icon="close" onclick="cancelSend()"></paper-icon-button>
		</div>
		<div class="send-item">
			<div id="editor"></div>
			
			<div class="email-div t-div">
				<div data-tags-input-name="tag" id="tagBox"></div>
			</div>
			
		</div>
	</div>
	
    <core-toolbar id="mainheader">
      <img src="img/lock.svg" height="24px" class="logo"><span flex>SnipSafe</span>
      
      
      <paper-icon-button icon="add" onclick="new_snip()"></paper-icon-button>
      <input type="text" placeholder="Search" class="search-input">
      <span class="email"><?php echo(Auth::user()->email); ?></span>
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
	    		echo("<h2 class='none'>You have no snippets. Make Some!</h2>");
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
		    		
		    		
		    		echo('<div class="snip-item" data-tag="'.$data_tag.'" data-id="'.$path.'" data-title="'.$title.'"><paper-shadow z="2"></paper-shadow><div class="header-item"><h4>'.$title.'</h4><paper-icon-button icon="close" onclick="removeSnip(\''.$path.'\')"></paper-icon-button><paper-icon-button class="edit-button" icon="create" data-path="'.$path.'"></paper-icon-button></div><div class="message-item"><pre><code class="language-'.$lang.'">'.$content.'</code></pre>'.$tags.'</div></div>');
	    		}
    		}
    	?>
    	
    </div>
    
    <script src="http://harvardp4-harvardp3.rhcloud.com/lib/codemirror/lib/codemirror.js"></script>
	<link rel="stylesheet" href="http://harvardp4-harvardp3.rhcloud.com/lib/codemirror/lib/codemirror.css">
	<script src = 'http://harvardp4-harvardp3.rhcloud.com/lib/codemirror/mode/css/css.js'></script>
	<script src = "http://harvardp4-harvardp3.rhcloud.com/lib/codemirror/mode/mode.js"></script>
	<script src = "http://harvardp4-harvardp3.rhcloud.com/lib/codemirror/mode/swift.js"></script>
	<link rel='stylesheet' type='text/css' href='http://harvardp4-harvardp3.rhcloud.com/lib/codemirror/theme/theme.css'>
	<link rel='stylesheet' type='text/css' href='http://harvardp4-harvardp3.rhcloud.com/lib/codemirror/theme/code-your-cloud.css'>
    <link rel="stylesheet" href="http://harvardp4-harvardp3.rhcloud.com/lib/codemirror/addon/dialog/dialog.css" >
	<script src="http://harvardp4-harvardp3.rhcloud.com/lib/codemirror/addon/comment/comment.js" ></script>
	<script src="http://harvardp4-harvardp3.rhcloud.com/lib/codemirror/addon/dialog/dialog.js" ></script>
	<script src="http://harvardp4-harvardp3.rhcloud.com/lib/codemirror/addon/search/search.all.js" ></script>
	<script src="http://harvardp4-harvardp3.rhcloud.com/lib/codemirror/addon/edit/edit.min.js"></script>
    
    <script src="http://harvardp4-harvardp3.rhcloud.com/lib/tag/tag.js"></script>
    
    <script src="lib/prism/prism.js"></script>
	<script src="main/js/main.js"></script>
</body>
</html>