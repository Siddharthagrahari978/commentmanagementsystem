<?php  
 $message = '';  
 $error = ''; 
 $array_data = "";
 $ref=0;
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
      else if(empty($_POST["first_name"]))  
      {  
           $error = "<label class='text-danger'>Enter First Name</label>";  
      }
	 else if(empty($_POST["last_name"]))  
      {  
           $error = "<label class='text-danger'>Enter Last Name</label>";  
      }
      else  
      {  
           if(file_exists('database.json'))  
           {  
                $current_data = file_get_contents('database.json');  
                $array_data = json_decode($current_data, true);
                for( $i = 0 ; $i < count($array_data) ; $i++){
	               if($array_data[$i]['username'] == $_POST["username"]){
                         $error='<div class="alert alert-warning" role="alert">User Already Exists.</div>';
                         $ref=1;
                         break;
                    }
               }
               if($ref==0){
                    $extra = array(  
                         'username'           =>     $_POST['username'],
                         'first_name'		  =>	    $_POST['first_name'],
                         'last_name'		  =>	    $_POST['last_name'],
                         'password'           =>     $_POST["password"],
                         'phone'			  =>	    $_POST["phone"],
                         'address'		  =>	    $_POST["address"],
                         'comment'		  =>     array()
                    );  
                    $array_data[] = $extra;  
                    $final_data = json_encode($array_data);  
                    if(file_put_contents('database.json', $final_data))  
                    {  
                         $message = "<div class='alert alert-success' role='alert'>Signed up Successfully</div>";  
                    }  
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
           <title>Webslesson Tutorial | Append Data to JSON File using PHP</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:500px;">  
                <h3 align="">Sign Up!!!</h3><br />   
                <?php if(isset($message)) { echo $message."\n"; } ?>
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
				 <label>First Name</label>  
                     <input type="text" name="first_name" class="form-control" /><br />
				 <label>Last Name</label>  
                     <input type="text" name="last_name" class="form-control" /><br />
                     <label>Password</label>  
                     <input type="text" name="password" class="form-control" /><br />  
				 <label>Phone</label>  
                     <input type="text" name="phone" class="form-control" /><br />
				 <label>Address</label>  
                     <input type="text" name="address" class="form-control" /><br />
				 
                     <input type="submit" name="submit" value="Signup" class="btn btn-success" /><br />  
                     
			   	<br />
			   	<a class="btn btn-info" href="index.php?info=1">&lt; Back to sign in page</a>
                      
                </form>  
           </div>  
           <br />  
      </body>  
 </html>
