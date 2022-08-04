<?php
include('partials/menu.php'); ?>

<?php 
       
       //check whether the id is set or not

       if(isset($_GET['id']))
       {
         //Get the id and all other details
         //echo "Getting the data";
         $id=$_GET['id'];
         //create sql query to get all other details
         $sql2="SELECT * FROM tbl_food WHERE id=$id";

         //Execute the query
         $res2=mysqli_query($conn, $sql2);

         //Get the value base on query executed
         $row2=mysqli_fetch_assoc($res2);

         //get the individual values of selected food
           $title = $row2['title'];
           $description = $row2['description'];
           $price = $row2['price'];
           $current_image=$row2['image_name'];
           $current_category=$row2['category_id'];
           $featured=$row2['featured'];
           $active=$row2['active'];

        /*
         //count  the rows to check whether the id is valid or not
         $count = mysqli_num_rows($res);

         if($count==1)
         {
           //Get all the Data
           $row=mysqli_fetch_assoc($res2);
           $title = $row['title'];
           $description = $row['description'];
           $price = $row['price'];
           $current_image=$row['image_name'];
           $featured=$row['featured'];
           $active=$row['active'];

         }else
         {
             //redirect to manage food with sesion message
             $_SESSION['no-food-found']="<div class='error'>Food Not Found.</div>";
             header('location:'.SITEURL.'admin/manage-food.php');
         } */

       }else{
           //redirect to manage food
           header('location:'.SITEURL.'admin/manage-food.php');
       }
   
   ?>


<div class="main-content">
    <div class="wrapper">
      <h1> Update Food</h1>
      <br><br>

      <form action="" method="POST" enctype="multipart/form-data">
      <table class="tbl-30">
        <tr>
            <td> Title: </td>
            <td>
              <input type="text" name="title" value="<?php echo $title ;?>">
            </td>
        </tr>
         <tr>
            <td> Description: </td>
            <td>
              <textarea name="description" cols="30" rows="5" ><?php echo $description; ?></textarea>
            </td>
         </tr>

         <tr>
              <td> Price: </td>
              <td>
                  
                 <input type="number" name="price" value="<?php echo $price; ?>">
             </td>
          </tr>


         <tr>
         <td>Current Image </td>
         <td><?php 
            if($current_image == "")
            {

                //display message 
                echo "<div class='error'>Image Not Added.</div>";  

            }else{

                //display image if avaliable
                ?>
                <img src="<?php echo SITEURL ;?>images/food/<?php echo $current_image; ?>" width="150px">
                <?php
                
            }
         ?>
        </td>
      </tr>

      <tr>
          <td>Select New Image: </td>
          <td>
              <input type="file" name="image">
          </td>
      </tr>
      

       <tr>
         <td>Caetgory:</td>
          <td>
            <select  name="category" >
                <?php 
                  //query to get active categories
                   $sql= "SELECT * FROM tbl_categories WHERE active='Yes'";
                   ////Execute query
                   $res=mysqli_query($conn,$sql);
                   //count rows
                   $count= mysqli_num_rows($res);

                   //check whether the categories is avaliable or not
                   if($count>0)
                   {
                       //Category Avaliable
                       while($row = mysqli_fetch_assoc($res)){
                           $category_title = $row['title'];
                           $category_id=$row['id'];
                           

                          // echo "<option value='$category_id'> $category_title</option>";
                          ?>
                           <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
                
                          <?php
                       }
                   }else{
                       //Food not Avaliable
                       echo "<option value='0'>Food Not Avaliable.</option>";
                   }
                ?>
                
        </select>

        </td>
        </tr>

        <tr>
           <td>Featured:</td>
           <td>
               <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
               <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
           </td>
       </tr>



       <tr>
           <td>Active:</td>
           <td>
               <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
               <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
           </td>
       </tr>
      
        <tr>
              <td colspan="2">
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                  <input type="submit" name="submit" value="Update Food" class="btn-secondary">
              </td>
        </tr>
      
      </table>
      </form>

      <?php
      
          if(isset($_POST['submit']))
          {
              //echo "clicked";
              //1. get all the values from  our form
              $id= $_POST['id'];
              $title = $_POST['title'];
              $description=$_POST['description'];
              $price = $_POST['price'];
              $current_image = $_POST['current_image'];
              $category=$_POST['category'];

              $featured = $_POST['featured'];
              $active = $_POST['active'];

              //2.updating new image if selected

              //check whether the image is selected or not
              if(isset($_FILES['image']['name']))
              {
                     //Get the image data
                     $image_name=$_FILES['image']['name'];

                     //check whether the image name is avaliable or not
                     if($image_name != "")
                     {
                         //Image Avaliable

                         //A.Upload the new image
                         //Auto Rename the image
                         //Get the extension of our image(.jpeg, png, gif,etc..)e.g. "food.gif"
                        $ext = end(explode('.', $image_name));

                        //Rename the image
                         $image_name = "Food-Name-".rand(0000,9999).'.'.$ext; // image name will be Food_Category_834.jpg" 


                         $src_path = $_FILES['image']['tmp_name'];
   
                         $dest_path="../images/food/".$image_name;
 
                         //Finally upload the image
                          $upload= move_uploaded_file($src_path,$dest_path);
  
                         //check whether the image is uploaded or not
  
                         //And if image is not uploaded then we willstop the proces and redirect with error message
                         if($upload==false){
   
                        //set message
                        $_SESSION['upload'] ="<div class='error'>Failed to Upload Image.</div>";
 
                         //Redirect to Add category page
                        header('location:'.SITEURL.'admin/manage-food.php');
              
                         //Stop the process
                         die();
                         }
                         
                         
                         
                       //B.Remove the current image if avaliable
                       if($current_image !="")
                       {
                        $remove_path="../images/food/".$current_image;
                        $remove = unlink($remove_path);

                        //check wheter the image is removed or not
                        //if failed to remove then display message and stop the process
                        if($remove==false){
                            //failed to remove image
                            $_SESSION['remove-failed']="<dic class='error'>Failed to Remove Current Image.</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                            die(); //stop the process
                        }

                       
                       }
                         
                    }else
                    {
                         $image_name=$current_image; //default image when image is not selected
                    }

                }else
                     {
                          $image_name=$current_image; //Default image when button is not clicked
                     }

              //3. Update the database
                $sql3 ="UPDATE tbl_food SET
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id='$category',
                featured='$featured',
                active='$active'
                WHERE id='$id'
               ";

               //Execute the query
               $res3 = mysqli_query($conn, $sql3);


              //4. Redirect to manage food with message
              //check whether the query is executed or not
              if($res3==true)
              {
                  //fod updated
                  $_SESSION['update'] ="<div class='success'>Food Updated Succesfully.</div>";
                  header('location:'.SITEURL.'admin/manage-food.php');

              }else
              {
                  //failed to update food
                  $_SESSION['update'] ="<div class='error'> Failed to Update Food .</div>";
                  header('location:'.SITEURL.'admin/manage-food.php');

              }



          }
      
      ?>
    
    </div>  

</div>


<?php include('partials/footer.php');?>