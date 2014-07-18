<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::post('edit-snip', function() {
	$title = $_POST['title'];
	$path = $_POST['path'];
	$content = $_POST['content'];
	
	DB::update('update snips set title = ? where path = ?', array($title, $path));
	
	$relative_path = str_replace("http://harvardp4-harvardp3.rhcloud.com/editor/","store/",$path);
	
	file_put_contents($relative_path, $content);
	
	echo("ok");
});

Route::post('remove-snip', function() {
	$path = $_POST['path'];
	
	$relative_path = str_replace("http://harvardp4-harvardp3.rhcloud.com/editor/","store/",$path);
	
	DB::delete('delete from snips where path = ?', array($path));
	
	unlink($relative_path);
});


Route::get('editor/{userid}/{itemid}', function(){
	if (Auth::guest()) {
		return Redirect::to('/');
	}
	else{
		return View::make('editor');
	}
});


Route::post('add-snip', function() {
	$title = "New Snippet";
	$email = Auth::user()->email;
	$path = "http://harvardp4-harvardp3.rhcloud.com/editor/".$email."/"; //still have to add id
	
	$results = DB::select('select * from snips where email = ?', array($email));
	
	$size = sizeof($results);
	
	if($size == 0){
		$path = $path."0";
	}
	else{
		$last_element = $results[$size-1];
		$last_element_id = $last_element->id;
		$this_id = $last_element_id + 1;
		
		$path = $path.$this_id;
	}
	
	$path = $path.".txt";
	
	
	DB::insert('insert into snips (title, email, path) values (?, ?, ?)', array($title, $email, $path));
	
	$default_text = "New Snippet\njavascript\nsnippet\n//Start writing here";
	
	$relative_path = str_replace("http://harvardp4-harvardp3.rhcloud.com/editor/","store/",$path);
	
	$myfile = fopen($relative_path, "w");
	fwrite($myfile, $default_text);
	
	echo($path);
});

//=============================================

Route::get('/', function(){
	if (Auth::guest()) {
		return View::make('landing');
	}
	else{
		return Redirect::to('all');
	}
});


Route::get('changepass', function(){
	if (Auth::guest()) {
		return Redirect::to('/');
	}
	else{
		return View::make('changepass');
	}
});

Route::get('all', function(){
	if (Auth::guest()) {
		return Redirect::to('/');
	}
	else{
		return View::make('all');
	}
});






Route::post('add-user', function() {

	$email = $_POST['email'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];

	$results = DB::select('select * from users where email = ?', array($email));
	
	if(sizeof($results) == 0){
	
		
		if($password1 == $password2 && filter_var( $email, FILTER_VALIDATE_EMAIL )){
		
			$user = new User;
			$user->username = $email;
			$user->password = Hash::make($password1);
			$user->email = $email;
			$user->save();
			
			mkdir("store/".$email, 0700);
			
			if( Auth::attempt( array( 'email'=>$email, 'username'=>$email, 'password'=>$password1 ) ) ) {
				echo("ok");
			} 
	    
	    }
	    else{
		    echo("error");
	    }
    }
});


Route::post('change-password', function() {
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	$old = $_POST['old'];
	
	
	$user = User::find(Auth::user()->id);
	
	
	if($password1 == $password2 && $password1 != "" && Hash::check($old, $user->getAuthPassword())){
	
	    $user->password = Hash::make($password1);
	    $user->save();
	    
	    echo("ok");
	    
	}
    else{
	    echo("error");
    }
});

Route::post('login', function(){
	if( Auth::attempt( array( 'email'=>$_POST['email'], 'username'=>$_POST['email'], 'password'=>$_POST['password'] ) ) ) {
    	echo("ok");
	} 
	else {
		echo("error");
	}
});


Route::post('logout', function(){
	Auth::logout();
	
	echo("ok");
});