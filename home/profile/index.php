<?php
session_start();
date_default_timezone_set("Asia/Calcutta");
$datetime = new DateTime();
$message = '';  
$error = ''; 
$array_data="";

$first_name="";
$last_name="";
$phone="";
$address="";
$password="";

$alert="";
$password_changer="";

$index=0;

if( !isset($_SESSION['username']) || !isset($_SESSION['password'])){
  header("Location: ../../CariKture India Private Limited/");
}
else{
	
	if(file_exists('../../database.json')){
		$current = file_get_contents('../../database.json');
		$array = json_decode($current, true);

		for( $i = 0 ; $i < count($array) ; $i++){
			if($array[$i]['username'] == $_SESSION["username"] && $array[$i]['password'] == $_SESSION["password"]){
				$first_name = $array[$i]["first_name"];
				$last_name = $array[$i]["last_name"];
				$phone = $array[$i]["phone"];
				$address = $array[$i]["address"];
				$password = $array[$i]["password"];
				break;
			}
			
		}
		
		if($_SESSION["username"]=="admin"){$alert.='<div class="alert alert-warning" role="alert"><strong>Note!</strong> Administrator password cannot be changed in demo.</div>';}
		else{
			$password_changer.='<label><strong>Password</strong></label><br /><input type="password" name="password" class="form-control"><br />';
			if(isset($_POST["password"]) && $_POST["password"] != "") {
			$password = $_POST["password"];
			}
		}
		
		
		if(isset($_POST["updateProfile"])){
			for( $i = 0 ; $i < count($array) ; $i++){
			if($array[$i]['username'] == $_SESSION["username"] && $array[$i]['password'] == $_SESSION["password"]){
				$array[$i]['first_name']=$_POST["first_name"];
				$array[$i]['last_name']=$_POST["last_name"];
				$array[$i]['address']=$_POST["address"];
				$array[$i]['phone']=$_POST["phone"];
				$array[$i]['password']=$password;

				$final_data = json_encode($array);  
				if(file_put_contents('../../database.json', $final_data))  
				{ 
					$_SESSION['password'] = $password;
					$message = '<div class="alert alert-success" role="alert">Update Successfull.</div>';
					header("Location: #");
					
				}
			}
			}
		}
	}

}






	
	 
?>

<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    
    
  </head>
  <body>
    <!-- Start your project here-->
    
    <!-- For Nav Bar -->
    <div class="navbar">
      <div style="margin:0 8% 0 8%;">
      <a href="#">Advanced Security</a>
      <div class="dropdown">
				<button class="dropbtn"><span id="dropdowntext">Welcome, <?php echo $_SESSION['username'];  ?></span> 
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="#">My Profile</a>
          <a href="../../index.php?logout=1">Logout</a>
        </div>
      </div> 
      </div>
    </div>
    <!-- Nav Bar End Here -->
    
    <!-- Side navigation -->
    <div class="sidenav">
      <a href="../"><i class="fa fa-home" style="height:20px" aria-hidden="true"></i>Home</a>
      <a href="#" style="color:#007bff;"><i class="fa fa-user" style="height:20px" aria-hidden="true"></i>My Profile</a>
      <a href="../../index.php?logout=1"><i class="fa fa-sign-out" style="height:20px" aria-hidden="true"></i>Logout</a>
      
    </div>

    <!-- Page content -->
    <div class="main">
			<div><?php echo $alert; ?></div>
			
			<div style="border: 1px gainsboro solid; height:auto; border-radius:8px;">
				
				<div id="detail">Your Details</div>
				<form method="post" style="padding-left:25px;padding-top:10px;">
					<label><strong>First Name</strong></label><br />
					<input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>"><br />
					<label><strong>Last Name</strong></label><br />
					<input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>"><br />
					<label><strong>Address</strong></label><br />
					<input type="text" name="address" class="form-control" value="<?php echo $address; ?>"><br />
					<label><strong>Phone</strong></label><br />
					<input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>"><br />
					<?php echo $password_changer; ?>
					
					<button type="submit" name="updateProfile" style="padding-left:15px" value="" class="btn">Update</button>
					<br />  
					<?php echo $message; ?>
				</form>
			</div>
    </div>
    
    
    <!-- End Here -->
    
    <script type="text/javascript" src="../../jquery.min.js"></script>
    <script src="script.js" type="text/javascript"></script>
    <script>
    </script>
  </body>
  
</html>

