<?php include('../config/constants.php');?>
<html>
       <head>
            <title> Login-Food Order System</title>
            <link rel="stylesheet" href="../css/admin.css">
       </head>

       <body>

          <div class="login">
              <h1 class ='text-center'>Login</h1>
              <br><br>
              <?php 

               if(isset($_SESSION['login'])){

                echo $_SESSION['login'];
                unset($_SESSION['login']);
               }
              

               if(isset($_SESSION['no-login-message'])){
                
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);

               }
              ?>
              <br><br>
              <!-- Login form starts here-->
              <form action="" method="POST" class="text-center">
              Username:<br>
              <input type="text" name="username" placeholder="Enter Username"><br><br>

              Password:<br>
              <input type="password" name="password" placeholder="Enter Password"><br><br>

              <input type="submit" name="submit" value="login" class="btn-secondary">

              </form>



              <!-- Login form end here-->



              <p class ='text-center' >Created By-<a href=""> Aditya Chauhan</a></p>
            </div>
        </body>           

</html>
<?php 
  //check whether the submit button is clicked or not
  if(isset($_POST['submit'])){
    //echo "clicked";
    //process for login
    //1. Get the data from login form
     $username = $_POST['username'];
     $password =md5( $_POST['password']);

     //2.SQl to check whether the user with password is exist or not
     $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

     //3. Execute th query
     $res= mysqli_query($conn,$sql);

     //4. count rows to check whether the user exists or not
     $count=mysqli_num_rows($res);

     if($count==1){
       
      //User Avaliable ad login successful
      $_SESSION['login'] ="<div class='success'>Login Successful.</div>";
      $_SESSION['user'] = $username; //to check whether the user is logged in or not and logout will unset it

      //Redirct to home page/dashboard
      header('location:'.SITEURL.'admin/');
     }else{
       //user not Avaliable and Login Fail
       $_SESSION['login'] ="<div class='error text-center'>Username or Password did not match</div>";
      //Redirct to home page/dahgboard
      header('location:'.SITEURL.'admin/login.php');
     }

  }
?>