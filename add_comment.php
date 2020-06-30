<?php  
 date_default_timezone_set("Asia/Calcutta");
 $datetime = new DateTime();
 $message = '';  
 $error = ''; 
 $array_data="";
 if(isset($_POST["submit"]))  
 {  
      if(empty($_POST["username"]))  
      {  
           $error = "<label class='text-danger'>Enter username</label>";  
      }  
      else if(empty($_POST["password"]))  
      {  
           $error = "<label class='text-danger'>Enter Password</label>";  
      }
	 else if(empty($_POST["comment"]))
      {  
           $error = "<label class='text-danger'>Enter Comment.</label>";  
      }
      else  
      {  
           if(file_exists('database.json'))  
           {  
                $current_data = file_get_contents('database.json');  
                $array_data = json_decode($current_data, true);  
                $extra=array(
			 	$datetime->format('Y-m-d H:i:s') => $_POST['comment'],
			 );
			 for( $i = 0 ; $i < count($array_data) ; $i++){
				 if($array_data[$i]['username'] == $_POST["username"] && $array_data[$i]['password'] == $_POST["password"]){
					 array_push($array_data[$i]['comment'], $extra);
				 }
			 }
                $final_data = json_encode($array_data);  
                if(file_put_contents('database.json', $final_data))  
                {  
                     $message = "<label class='text-success'>File Appended Success fully</p>";  
                }  
           }  
           else  
           {  
                $error = 'JSON File not exits';  
           }  
      }  
 }

 ?>  


<!DOCTYPE html>  
 <html>  
      <head>  
           <title>Append Data to JSON File using PHP</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  -->
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:500px;">  
                <h3 align="">Append Comment to JSON File</h3><br />                 
                <form method="post">  
                     <?php   
                     if(isset($error))  
                     {  
                          echo $error;  
                     }  
                     ?>  
                     <br />  
                     <label>username</label>
                     <input type="text" name="username" class="form-control" /><br />
                     <label>Password</label>  
                     <input type="text" name="password" class="form-control" /><br />  
				 <label>Comment</label>  
				 <textarea type="text" name="comment" class="form-control"></textarea><br />
				 
                     <input type="submit" name="submit" value="Append" class="btn btn-success" /><br />  
                     
			   	<br />
                     <?php  
                     if(isset($message))  
                     {  
                          echo $message."\n";
				   	 print_r($array_data);
                     }  
                     ?>  
                </form>  
           </div>  
           <br />  
      </body>  
 </html>