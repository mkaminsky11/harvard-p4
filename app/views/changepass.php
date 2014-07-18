<!doctype html>
<html lang="en">
<head>
  
	 <meta charset="UTF-8">
	 <title>SnipSafe</title>

  <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="change/css/style.css">
  <script src="js/jquery.js"></script>
  
  <link rel="shortcut icon" type="image/png" href="favicon.png"/>
  <link rel="shortcut icon" type="image/png" href="http://harvardp4-harvardp3.rhcloud.com/favicon.png"/>
</head>

<body>
  
  <div class="overlay"></div>
  <div class="main-content">
	  	<h1>Change Password</h1>
		<br>
		<input type="password" placeholder="Enter you old password" class="regular-input" id="old">
		<input type="password" placeholder="Choose New Password" class="regular-input" id="p1">
		<input type="password" placeholder="Confirm New Password" class="regular-input" id="p2">
	    
		<button class="go-button" onclick="ok()">OK</button>
		<button class="cancel-button" onclick="cancel()">CANCEL</button>
		
		<span class="error error-change" style="display:none">Your email or password was incorrect</span>
	</div>
	
	<script src="change/js/main.js"></script>
</body>
</html>