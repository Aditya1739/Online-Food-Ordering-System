<?php include('partials/menu.php')?>

    <div class ="main-content">
         <div class ="wrapper">
             <h1>Add Food</h1>
             
             <br<br>
             <?php
      
                if(isset($_SESSION['upload']))
                {
                  echo $_SESSION['upload'];
                  unset($_SESSION['upload']);
                }  
      ?>

             <form action="" method="POST" enctype="multipart/form-data">
             <table class="tbl-30">

              <tr>
                 <td> Title: </td>
                 <td>
                   <input type="text" name="title" placeholder="Title of the Food">
                 </td>
               </tr>
               <tr>
                  <td> Description: </td>
                  <td>
                     <textarea name="description" cols="30" rows="5" placeholder="description of the food"></textarea>
                  </td>
                 </tr>

                 <tr>
                    <td> Price: </td>
                   <td>
                    <input type="number" name="price">
                     </td>
                 </tr>

                 <tr>
                    <td> Select Image: </td>
                   <td>
                       <input type="file" name="image">
                   </td>
                </tr>

                <tr>
                  <td>Caetgory:</td>
                  <td>
                     <select type="radio" name="category" value="Yes">

                    <?php

                    //create php code to display categories from database
                    //1.Create Sql to get all active categories from database
                    $sql="SELECT * FROM tbl_categories WHERE active='Yes'";

                    $res=mysqli_query($conn,$sql);

                    //count rows to check whether we have categories or not
                    $count=mysqli_num_rows($res);
               
                     //if count is greater than zero, we have categories else we dont have categories
                    if($count>0)
                    {
                       //we have categories
                       while($row=mysqli_fetch_assoc($res))
                       {
                            // get the details of categories
                            $id = $row['id'];
                            $title=$row['title'];
                            ?>

                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                            <?php
                       }
                    }else
                    {
                        //we dont have categories
                        ?>
                        <option value="0"> No Category Found </option>
                        <?php

                    }


                    //2.Display on Dropdown
                 
                    ?>

                     </select>
                     
                  </td>
                </tr>
              
                <tr>
                   <td>Featured:</td>
                   <td>
                     <input type="radio" name="featured" value="Yes">Yes
                     <input type="radio" name="featured" value="No">No
                   </td>
               </tr>
        
               <tr>
                  <td>Active:</td>
                  <td>
                     <input type="radio" name="active" value="Yes">Yes
                     <input type="radio" name="active" value="No">No
                  </td>
            
               </tr>

               <tr>
                   <td colspan="2">
                      <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                   </td>
               </tr>
             </table>
            </form>


            <?php
                 //check whether the button is clicked or not
                 if(isset($_POST['submit']))
                 {
                     //Add the food in database
                     //echo "clicked";

                     //1. Get the data from form 
                     $title = $_POST['title'];
                     $description=$_POST['description'];
                     $price=$_POST['price'];
                     $category=$_POST['category'];

                     //check whether the radio button for featured and active are checked or not
                     if(isset($_POST['featured']))
                     {
                         $featured=$_POST['featured'];
                     }else
                     {
                        $featured="No"; //Setting the default value
                     }

                     if(isset($_POST['active']))
                     {
                         $active=$_POST['active'];
                     }else
                     {
                        $active="No"; //Setting the default value
                     }


                     //2. Upload the image if selected
                     //check whether the select image is clicked or not and upload the image only if the image is selected
                     if(isset($_FILES['image']['name']))
                     {
                         //Get the details of the selected image
                         $image_name= $_FILES['image']['name'];

                         //check whether the Image is selected or not and upload image only if selected
                         if($image_name!="")
                         {
                             //image selecte
                             //A. rename the image
                             //get the extension of selected image(jpg,png,gif,etc)
                             $ext=end(explode('.',$image_name));

                             //create new name for image
                             $image_name="Food-Name-".rand(0000,9999).".".$ext; //this will create new image name
                    
                             //B. Upload the image
                             //get the source path and destination path

                             //src path is the current location of the image
                             $src=$_FILES['image']['tmp_name'];

                             //destination path for image to be uploaded
                             $dst="../images/food/".$image_name;

                             //finally upload the foo image
                             $upload= move_uploaded_file($src,$dst);
                             //check whether the image is uploaded or not
                             if($upload==false)
                             {
                                 //failed to upload image
                                 //redirect to Add food page with error message
                                 $_SESSION['upload']= "<div class='error'>Failed to Upload Image.</div>";
                                 header('location:'.SITEURL.'admin/add-food.php');
                                 //stop message
                                 die();
                             }

                         }

                     }else
                     {
                         $image_name=""; //Setting default value as blank
                     }

                     //3. Insert into database

                     //create sql query to save or add food
                     //for numrical value we do not need to pass values inside quotes '' but for string value it is compoulsory to add quotes
                     $sql2="INSERT INTO tbl_food SET
                      title='$title',
                      description='$description',
                      price=$price,
                      image_name='$image_name',
                      category_id =$category,
                      featured='$featured',
                      active='$active'
                     ";

                     //Execute the query
                     $res2=mysqli_query($conn,$sql2);

                     //check whether data insertes or not
                     //4. Redirect with message to manage food page
                     if($res2 == true)
                     {
                         //data inserted seccessfully
                         $_SESSION['add'] ="<div class='success'>Food Added Successfully.</div>";
                         header('location:'.SITEURL.'admin/manage-food.php');
                     }else
                     {
                         //failed to insert data
                         $_SESSION['add'] ="<div class='error'>Failed to Add Food.</div>";
                         header('location:'.SITEURL.'admin/manage-food.php');
                     }
                     

                     


                 }

            ?>


         </div>
    </div>
 

<?php include('partials/footer.php')?>