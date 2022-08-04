<?php include('partials/menu.php');?>
<div class="main-content">
    <div class = "wrapper">
       <h1>Update Admin</h1>

       <br><br>

       <?php
       //1.Get the ID of Selected Admin
       $id = $_GET['id'];
       //2. Create SQL query to get details
       $sql = "SELECT * FROM tbl_admin WHERE id =$id";

       //3.Execute the query

       $res= mysqli_query($conn,$sql);

       // check whether the query is executed or not

       if($res == true)
       {
         //chech whether the data  is avaliable or not
         $count = mysqli_num_rows($res);
         //check wheter we have admin data or not
         if($count==1)
         {
           //Get the details
           //echo "Admin Avaliable";

           $row = mysqli_fetch_assoc($res);

           $full_name = $row['full_name'];
           $username = $row['username'];
            
         }else{

           //Redirect to manage Admin page
           header('location'.SITEURL.'admin/manage-admin-php');
         }
       
        }
       ?>
       <form action = "" method="POST">

         <table class = "table-30">
           <tr>
              <td>FullName:</td>
              <td>
                <input type ="text" name ="full_name" value ="<?php echo $full_name; ?>"> 
                </td>
           </tr>    
           <tr>
              <td>UserName:</td>
              <td>
                <input type = "text" name ="username" value = "<?php echo $username;?>">
                </td>
           </tr>

           <tr>
              <td colspan = "2">
              <input type = "hidden" name = "id" value = "<?php echo $id;?> ">
              <input type = "submit" name ="submit" value="Update Admin" class = "btn-secondary">
              </td>

           </tr> 
           </table>     
    </div>

  </div>  
  <?php 
   
        //check whether the submit button is clicked or not

        if(isset($_POST ['submit'])){

          //echo 'Button Clicked';  
          //get all the values from form to update  
           $id = $_POST['id'];
           $full_name = $_POST['full_name'];
           $username =  $_POST['username'];

           //creating sql query to update admin

           $sql = "UPDATE tbl_admin SET
           full_name = '$full_name',
           username = '$username'
           WHERE id= '$id'
           ";

           //Executing the query
           $res = mysqli_query($conn, $sql);

           //check wheteher the query is executed sucessfully or not
           if($res==true)
           {

            //query executed and admin updated
            $_SESSION['update']= "<div class='success'>Admin Updated Successfully.</div>";
            //Redirect to update Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
          
           }else{

            //Failed to update
            $_SESSION['update']= "<div class='error'>Failed to Update Admin  .</div>";
            //Redirect to update Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');


           }
        }



  ?>   




<?php include('partials/footer.php'); ?>