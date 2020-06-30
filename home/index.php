<?php
session_start();
date_default_timezone_set("Asia/Calcutta");
$datetime = new DateTime();
$message = '';  
$error = ''; 
$array_data="";

$comments="";

if( !isset($_SESSION['username']) || !isset($_SESSION['password'])){
  header("Location: ../../CariKture India Private Limited/");
}
	
if(file_exists('../database.json')){
	$current = file_get_contents('../database.json');
	$array = json_decode($current, true);
}
for( $i = 0 ; $i < count($array) ; $i++){
	if($array[$i]['username'] == $_SESSION["username"] && $array[$i]['password'] == $_SESSION["password"]){
		for($j = (count($array[$i]['comment'])-1); $j >= 0; $j--){
			if($j==(count($array[$i]['comment'])-8)){break;}
			/*$comments .= "Comment: ".implode($array[$i]['comment'][$j]);
			$comments .= "Time: ".array_search(implode($array[$i]['comment'][$j]),$array[$i]['comment'][$j]);
			*/
			
			$comments .= '<div style="border-left: 1px grey solid;
			margin:15px; padding:10px;"> <span style="font-size:15px; font-weight:bold">'.implode($array[$i]['comment'][$j]).'</span><br><br>-'.$array[$i]['username'].' at '.array_search(implode($array[$i]['comment'][$j]),$array[$i]['comment'][$j]).'</div>';
				
			
			
			
		}
	}
}









	
	 if(isset($_POST["addComment"]))  
	 {  
		 
		 if(empty($_POST["comment"]))
		 {  
			 $error = "<label class='text-danger'>Enter Comment.</label>";  
		 }
		 else  
		 {  
			 if(file_exists('../database.json'))  
			 {  
				 $current_data = file_get_contents('../database.json');  
				 $array_data = json_decode($current_data, true);  
				 $extra=array(
					$datetime->format('Y-m-d H:i:s') => $_POST['comment'],
				 );
				 for( $i = 0 ; $i < count($array_data) ; $i++){
					 if($array_data[$i]['username'] == $_SESSION["username"] && $array_data[$i]['password'] == $_SESSION["password"]){
					 array_push($array_data[$i]['comment'], $extra);
			 	 }
			 }
			 $final_data = json_encode($array_data);  
			 if(file_put_contents('../database.json', $final_data))  
			 {  
				 header("Location: #");  
			 }  
		 }  
		 else  
		 {  
			 $error = 'JSON File not exits';  
		 }  
	 }  
 }




?>

<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Comments Wall</title>
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
          <a href="profile">My Profile</a>
          <a href="../index.php?logout=1">Logout</a>
        </div>
      </div> 
      </div>
    </div>
    <!-- Nav Bar End Here -->
    
    <!-- Side navigation -->
    <div class="sidenav">
      <a href="#" style="color:#007bff;"><i class="fa fa-home" style="height:20px" aria-hidden="true"></i>Home</a>
      <a href="profile/"><i class="fa fa-user" style="height:20px" aria-hidden="true"></i>My Profile</a>
      <a href="../index.php?logout=1"><i class="fa fa-sign-out" style="height:20px" aria-hidden="true"></i>Logout</a>
      
    </div>

    <!-- Page content -->
    <div class="main">
			<p><span style="font-size:40px; margin-right:10px;">Comments Wall</span> Last 7 posts</p>
			
			<div class="comments"><?php echo $comments; ?></div>
			
			<form method="post">
			 
			<label><strong>Leave Comment</strong></label><br />
			<textarea type="text" name="comment" class="form-control"></textarea><br />
				 
				<button type="submit" name="addComment" value="" class="btn"><i class="fa fa-comment" style="height:20px; width:25px" aria-hidden="true"></i>Comment</button>
			<br />  
			</form>
                     
			   	<br />
                     <?php  
                     if(isset($message))  
                     {  
                          echo $message."\n";
				   	 print_r($array_data);
                     }  
                     ?> 
			
			
			
			
    </div>
    
    
    <!-- End Here -->
    
    <script type="text/javascript" src="../jquery.min.js"></script>
    <script src="script.js" type="text/javascript"></script>
    <script>
    </script>
  </body>
  
</html>

