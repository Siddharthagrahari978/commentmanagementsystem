<?php

session_start();

if(isset($_GET["logout"])){
  unset($_SESSION['username']);
	unset($_SESSION['password']);
}

if(isset($_SESSION['username']) && isset($_SESSION['password'])){
  header("Location: home");
}

else{
$alert="";

if($_POST){
  
  $alert='<div class="alert alert-danger" style="margin-top:10px;margin-bottom:10px;" role="alert"><strong>There were error(s) in your form:</strong><br>';
  
  if($_POST['username'] != "" && $_POST['password'] != ""){
    
    $alert="";
    
		if(file_exists('database.json')){
			$current_data = file_get_contents('database.json');
			$array_data = json_decode($current_data, true);
			$temp=0;
			for( $i = 0 ; $i < count($array_data) ; $i++){
				if($array_data[$i]['username'] == $_POST["username"] && $array_data[$i]['password'] == $_POST["password"])
				{
					$temp=1;
					$_SESSION['username'] = $_POST["username"];
					$_SESSION['password'] = $_POST["password"];
					header("Location: home");
					break;
			 	}
			}
			if($temp==0){
				$alert='<div class="alert alert-danger" role="alert">This Email/Password combination doesn\'t exists.</div>';
			}
		}
		else  
		{$alert = '<div class="alert alert-danger" style="margin-top:10px;margin-bottom:10px;" role="alert">JSON File not exits</div>';}
    	
  }
    
  else if($_POST['username'] == "" && $_POST['password'] != ""){
    $alert.="An username is required.<br></div>";
  }
  else if($_POST['username'] != "" && $_POST['password'] == ""){
    $alert.="A password is required.<br></div>";
  }
  else{
    $alert.="An username is required.<br>";
    $alert.="A password is required.<br></div>";
  }
}

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CariKture India Private Limited</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    
    <div id="index-page">
      <!-- Start your project here-->  
      <h2 id="heading">Advanced Security</h2>
      <div id="signInFormContainer" class="container" style="margin-top:5vh">


        <form class="form-group border border-light p-4" method="post">

            <h3 style="margin-bottom:2.7rem">LOGIN</h3>


            <?php echo $alert;?>


            <!-- username -->
            <label for="username">Username</label>
            <input type="text" id="username" class="form-control mb-4" name="username">

            <!-- Password -->
            <label for="password">Password</label>
            <input type="password" id="password" class="form-control mb-4" name="password">

            <div style="margin-bottom: 3rem;">
              <!-- Forgot password -->
              <a href="">Forgot password?</a>
            </div>


            <!-- Sign in button -->
            <button class="btn btn-success btn-block" type="submit">Login</button>


            <!-- Social login -->
            <p class="text-center">or connect with</p>
            <div style="text-align:center">
            <a type="button">
              <i class="fa fa-facebook"></i>
            </a>
            <a type="button">
              <i class="fa fa-twitter"></i>
            </a>
            <a type="button">
              <i class="fa fa-google"></i>
            </a>
            </div>

          </form>
        
      </div>
      
      <div style="text-align:center ;margin:20px 0 50px 0;">Don't have an account?
        <a href="">Sign Up</a>
      </div>

    </div>
    
    
    <script type="text/javascript" src="jquery.min.js"></script>
    
    
  </body>
</html>
