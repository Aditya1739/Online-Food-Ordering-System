   <?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
     <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
     ?>




    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            
            <?php

                 //create sql query to display categories from database
                 $sql=" SELECT * FROM tbl_categories WHERE feaTured='Yes' AND active='Yes'  LIMIT 3  ";
                 //Execute the query
                 $res=mysqli_query($conn,$sql);

                  //count rows to check whether the category isavaliable or not
                 $count=mysqli_num_rows($res);

                 if($count>0)
                 {
                     //category Avaliable
                     while($row=mysqli_fetch_assoc($res))
                     {
                         //Get the values like id, title,image name
                         $id=$row['id'];
                         $title = $row['title']; 
                         $image_name=$row['image_name'];
                         ?>
                         
                         <a href="<?php echo SITEURL?>category-foods.php?category_id=<?php echo $id; ?>">
                         <div class="box-3 float-container">
                            <?php
                            //check whether the image is avaliable or not
                            if($image_name=="")
                            {
                                //Display Image
                                echo "<div class='error'>Image Not Avaliable.</div>";
                            }else
                            {
                                //Image is Avaliable
                                ?>
                                <img src="<?php echo SITEURL ;?>images/category/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">

                               
                                <?php

                            }
                            
                            
                            ?>
                         

                         <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                        </a>

                        <?php
                         

                     }
                 }else
                 {
                     //category not avaliable
                     echo"<div class ='error'>Category not Added.</div>";
                 }


            ?>


            

            <div class="clearfix"></div>
        </div>
        <p class="text-center">
            <a href="categories.php">See All Categories</a>
        </p>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //Displaying all the categories that are active
                //sql query
                $sql2="SELECT * FROM tbl_food WHERE featured='Yes' LIMIT 6";

                //Execute the query
                $res2=mysqli_query($conn,$sql2);

                //count rows
                $count2=mysqli_num_rows($res2);

                //check whether categories avaliable
                if($count2>0)
                {
                    //Categories avaliable
                    while($row=mysqli_fetch_assoc($res2))
                     {
                         //Get the values like id, title,image name
                         $id= $row['id'];
                         $title = $row['title'];
                         $description=$row['description'];
                         $price = $row['price'];
                         $image_name = $row['image_name'];
                        
                         ?>
                         
                           <div class="food-menu-box">
                           <div class="food-menu-img">
                                 <?php
                                //check whether the image is avaliable or not
                                     if($image_name=="")
                                     {
                                       //Display Image
                                        echo "<div class='error'>Image Not Avaliable.</div>";
                                     }else
                                        {
                                         //Image is Avaliable
                                          ?>
                                           <img src="<?php echo SITEURL ;?>images/food/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">

                                          <?php

                                          }
                            
                            
                            ?>

                             </div>

                                <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">₹<?php echo $price;?></phph> </p>
                                <p class="food-detail">
                                <?php echo $description; ?>
                           </p>
                            <br>
                               <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                           </div>
                         </div>

                          <?php
                }

            }else
                {
                    //Categories not avaliable
                    echo "<div class='error'>Food Not Avaliable.</div>";
                }
            
            
            ?>

                    


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->
    <?php include('partials-front/footer.php'); ?>
      