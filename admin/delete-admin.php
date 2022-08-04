<?php
     
     //include constant.php file here
     include('../config/constants.php');
      
     // 1. get the id of Admin to be delelted
    $id = $_GET['id'];

     //2. create SQL query to delete admin 

     $sql = "DELETE FROM tbl_admin WHERE id = $id";

     //execute the query
     $res = mysqli_query($conn,$sql);

     // check whether the query is executed or not
     if($res == true){

        //query executed sucessfully and admin deleted
        //echo"Admin deleted";

        //create session variable to display message
        $_SESSION['delete'] = "<div class ='success'>Admin Deleted Successfully.</div>";

        // Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
     }else{
         //Failed to delete admin
         //echo "Failed to delete admin";

         $_SESSION ['delete'] ="<div class = 'error'>Failed to Delete Admin. Try Again Later.</div>"; 
         header('location:'.SITEURL.'admin/manage-admin.php');

     }

     //3, Redirect to manage Admin pge with message(success/error) 

?>