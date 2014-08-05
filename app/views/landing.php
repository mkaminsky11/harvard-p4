<!doctype html>
<html lang="en">
<head>
  
	 <meta charset="UTF-8">
	 <title>SnipSafe</title>

  <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="js/jquery.js"></script>
  <link rel="stylesheet" href="lib/scroll/scroll.css">

  <link rel="stylesheet" href="landing/css/style.css">
  
  <link rel="shortcut icon" type="image/png" href="favicon.png"/>
  <link rel="shortcut icon" type="image/png" href="http://harvardp4-harvardp3.rhcloud.com/favicon.png"/>
</head>

<body>
    <div class="overlay"></div>
    <div class="main">
      <section>
        <h1 class="ghost-header title">SNIPSAFE</h1>
        <hr style="width: 30%;">
        <img src="img/lock.svg" height="100px" style="margin-left:calc(50% - 50px)"><br>
        <h1 class="ghost-header">Cloud-based storage for code snippets</h1><br>
<a class="ghost-button-green goto" onclick="$('.main').moveTo(5);">GET STARTED</a>
      </section>
      
      <section>
        <!--features-->
        <div class="desc-container">
          <h3 class="ghost-desc">SnipSafe is a site for storing and editing code snippets. Forgot how to animate using jQuery? Need to keep a Java cheatsheet handy? With SnipSafe, all of your tips, tricks, and reminders are available anywhere, anytime, on any computer or mobile device.</h3>
        </div>
      </section>
      
      <section>
        <!--features-->
        <div class="desc-container">
          <h3 class="ghost-desc">SnipSafe allows you to create, update, delete, and upload snippets. It only takes seconds to get started, and is a useful resource for the occasionally forgetful (that's everybody).</h3>
        </div>
      </section>
      
      <section>
        <!--about-->
        <div class="desc-container">
          <h2 class="ghost-header">Check out the source on GitHub</h2>
          <br><a class="github-button" href="https://github.com/mkaminsky11/harvard-p4"><i class="fa fa-github"></i> Github</a>
        </div>
      </section>
      
      <section>
        
        <div class="login-container-left">
          <h1 class="ghost-header">SIGN IN</h1> 
          <input type="text" class="ghost-input email-input" placeholder="Email" id="sign_in_email">
          <input type="password" class="ghost-input" placeholder="Password" id="sign_in_password">
          
          
          <a class="ghost-button-green" onclick="signIn()">GO</a>
          
          <span class="error error-signin" style="display:none">Your email or password was incorrect</span>
        </div>
        <div class="login-container-right">
          <h1 class="ghost-header">SIGN UP</h1>
          <input type="text" class="ghost-input email-input" placeholder="Your Email" id="sign_up_email">
          <input type="password" class="ghost-input" placeholder="Choose Password" id="sign_up_password">
          <input type="password" class="ghost-input" placeholder="Confirm Password" id="sign_up_confirm">
          <a class="ghost-button-green" onclick="signUp()" style="calc(100% - 40px)">GO</a>
          
          <span class="error error-signup" style="display:none">There was an error in your inputs</span>
        </div>
      
      </section>
      	
      <section>
      	<img src="img/s1.png" class="image">
      </section>
      	
      <section>
      	<img src="img/s2.png" class="image">
      </section>
      
      
    </div>
      
    </div>
    <script src="lib/scroll/scroll.js"></script>
    <script src="landing/js/main.js"></script>
</body>
</html>