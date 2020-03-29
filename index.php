<?php

$usernameInput = "";
$passwordInput = "";
if(isset($_POST["loginbtn"])){

$xmlusers = simplexml_load_file("xml/users.xml");

$usernameInput = $_POST["username"];
$passwordInput = $_POST["password"];

for($i = 0; $i < sizeof($xmlusers); $i++){
	
	if($xmlusers->user[$i]->logininfo->username == $usernameInput && $xmlusers->user[$i]->logininfo->password == $passwordInput){
		
		//var_dump($xmlusers->user[$i]['id']);
		session_start();
		$_SESSION['userid'] = (string)$xmlusers->user[$i]['id'];
		if($xmlusers->user[$i]['type'] == 'client'){
			header("Location:client.php");
		}
		
		else{
			header("Location:staff.php");
		}
			
	}
	
	else{
		echo "Wrong username or password";
	}

}
}
?>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>Ticketing System</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <form id="loginform" method="post" action=""> 
           
			<div class="form-group row">
				<label for="username" class="col-sm-3 col-form-label">User Name : </label>
				<div class="col-sm-6">
				  <input type="text" class="form-control" id="username" name="username" />
				</div>
			</div>
            
			<div class="form-group row">
				<label for="password" class="col-sm-3 col-form-label">Password : </label>
				<div class="col-sm-6">
				  <input type="text" class="form-control" id="password" name="password" />
				</div>
			</div>

			<div class="form-group row">
				<div class="col-sm-10">
				 <button type="submit" class="btn btn-primary" id="loginbtn" Name="loginbtn">Log In</button>
				</div>
			</div>
  
        </form>
    </body>
</html>