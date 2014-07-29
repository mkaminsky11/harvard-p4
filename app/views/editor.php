<!doctype html>
<html lang="en">
<head>
  		
  	<script src="http://harvardp4-harvardp3.rhcloud.com/poly/platform/platform.js"></script>

  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/polymer/polymer.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/core-collapse/core-collapse.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/core-drawer-panel/core-drawer-panel.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/core-header-panel/core-header-panel.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/core-icon-button/core-icon-button.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/core-icons/core-icons.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/core-input/core-input.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/core-item/core-item.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/core-meta/core-meta.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/core-overlay/core-overlay.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/core-scaffold/core-scaffold.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/core-scroll-header-panel/core-scroll-header-panel.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/core-style/core-style.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/core-toolbar/core-toolbar.html">

  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/polymer/polymer.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/roboto.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/paper-button/paper-button.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/paper-checkbox/paper-checkbox.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/paper-dialog/paper-dialog.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/paper-fab/paper-fab.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/paper-icon-button/paper-icon-button.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/paper-input/paper-input.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/paper-menu-button/paper-menu-button.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/paper-progress/paper-progress.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/paper-radio-button/paper-radio-button.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/paper-radio-group/paper-radio-group.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/paper-ripple/paper-ripple.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/paper-shadow/paper-shadow.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/paper-slider/paper-slider.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/paper-tabs/paper-tabs.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/paper-toast/paper-toast.html">
  <link rel="import" href="http://harvardp4-harvardp3.rhcloud.com/poly/paper-toggle-button/paper-toggle-button.html">	
  	
	 <meta charset="UTF-8">
	 <title>SnipSafe</title>

  <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="http://harvardp4-harvardp3.rhcloud.com/js/jquery.js"></script>
  
  <link rel="stylesheet" href="http://harvardp4-harvardp3.rhcloud.com/editor/css/style.css">
  
  <link rel="shortcut icon" type="image/png" href="favicon.png"/>
  <link rel="shortcut icon" type="image/png" href="http://harvardp4-harvardp3.rhcloud.com/favicon.png"/>
  
  <link rel="stylesheet" href="http://harvardp4-harvardp3.rhcloud.com/lib/tag/tag.css">
</head>

<body>

	<script src="http://harvardp4-harvardp3.rhcloud.com/editor/js/global.js"></script>
	
    <core-toolbar id="mainheader">
      <img src="http://harvardp4-harvardp3.rhcloud.com/img/lock.svg" height="24px" class="logo"><span flex>SnipSafe</span>
      
      <input type="text" placeholder="Title" class="search-input">
      <span class="close-btn btn" onclick="cancel()"><core-icon icon="close"></core-icon></span>
      <span class="save-btn btn" onclick="save()"><core-icon icon="check"></core-icon></span>
    </core-toolbar>
    
   
    
    <div class="lang-div">
    
    	<div id="select">
	    	<select>
	    		<option value="text">Text</option>
	    		<option value="javascript">Javascript</option>
	    		<option value="php">PHP</option>
	    		<option value="html">HTML</option>
	    		<option value="css">CSS</option>
	    		<option value="java">Java</option>
	    		<option value="c">C</option>
	    		<option value="cpp">C++</option>
	    		<option value="csharp">C#</option>
	    		<option value="coffeescript">Coffeescript</option>
	    		<option value="python">Python</option>
	    		<option value="aspnet">ASP.net</option>
	    		<option value="http">HTTP</option>
	    		<option value="ruby">Ruby</option>
	    	</select>
	    	<i class="fa fa-angle-down"></i>
    	</div>
    </div>
    
    <div class="tags-div t-div">
    	<div data-tags-input-name="tag" id="tagBox"></div>
    </div>
    
    <div class="main-content">
    	<div id="editor"></div>
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
	
	<script src="http://harvardp4-harvardp3.rhcloud.com/editor/js/main.js"></script>
</body>
</html>