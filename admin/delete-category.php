<?php 
    //Include Constants file
    include('../config/constants.php');
  //echo "Delete page";
    //check wheter the id and image name_value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the value and delete
        //echo "Get Value And Delete";
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];
        //Removing the physical image filer is avaliable
        if($image_name!=""){
            //Image is avaliable. So remove it
            $path="../images/category/" .$image_name;
            //Remove the image
            $remove= unlink($path);

            //If failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                //set the session message
                $_SESSION['remove']="<div class='error'>Failed to remove Categotry Image.</div>";
                //Redirect to Manage category Page
                header('location:'>SITEURL.'admin.manage-category.php') ; 
                //Stop the process
                die();
            
            }
        }

        //Delete data from database
        //Sql query delete data from database
        $sql="DELETE FROM tbl_categories WHERE id=$id";

        //Execute the query
        $res=mysqli_query($conn,$sql);

        //Check whether the data is delete from database or not
        if($res==true){
            //Set success message and redirect
            $_SESSION['delete']="<div class='success'>Category Deleted Successfully.</div>";
            //REdirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }else{

            //set fail message and redirect
            $_SESSION['delete']="<div class='error'>Failed to Deleted Category.</div>";
            //REdirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }


        //Redirect to Manage Category Page with message


    }
    else
    {
       //redirect to Manage Category Page
       header('location:'.SITEURL.'admin/manage-category.php');

    }
?>