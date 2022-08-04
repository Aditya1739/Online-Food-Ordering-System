<?php 
    //Include Constants file
    include('../config/constants.php');
   //echo "Delete page";
    //check wheter the id and image name_value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the value and delete
        //echo "Get Value And Delete";

        //1Get id and image name
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        //2.Removing the  image if avaliable
        //check whether the image is avaliable or not and delete only if avaliable
        if($image_name!=""){
            //Image is avaliable. So remove it
            //get image path
            $path="../images/food/".$image_name;
            //Remove the image from folder
            $remove= unlink($path);

            //If failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                //set the session message
                $_SESSION['update']="<div class='error'>Failed to remove Food Image.</div>";
                //Redirect to Manage Food Page
                header('location:'>SITEURL.'admin.manage-food.php') ; 
                //Stop the process of deleting food
                die();
            
            }
        }

        //3.Delete data from database
        //Sql query delete data from database
        $sql="DELETE FROM tbl_food WHERE id=$id";

        //Execute the query
        $res=mysqli_query($conn,$sql);

        //Check whether the data is delete from database or not
        if($res==true){
            //Set success message and redirect
            $_SESSION['delete']="<div class='success'>Food Deleted Successfully.</div>";
            //REdirect to manage food
            header('location:'.SITEURL.'admin/manage-food.php');
        }else{

            //set fail message and redirect
            $_SESSION['delete']="<div class='error'>Failed to Deleted Category.</div>";
            //REdirect to manage food
            header('location:'.SITEURL.'admin/manage-food.php');
        }


        //Redirect to Manage food Page with message


    }
    else
    {
       //redirect to Manage Food Page
       $_SESSION['unauthorize']="<div class='error'>Unauthorized Access.</div>";
       header('location:'.SITEURL.'admin/manage-food.php');

    }
?>