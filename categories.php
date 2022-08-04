<?php include('partials-front/menu.php'); ?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                //Displaying all the categories that are active
                //sql query
                $sql="SELECT * FROM tbl_categories WHERE active='Yes'";

                //Execute the query
                $res=mysqli_query($conn,$sql);

                //count rows
                $count=mysqli_num_rows($res);

                //check whether categories avaliable
                if($count>0)
                {
                    //Categories avaliable
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
                    //Categories not avaliable
                    echo "<div class='error'>Category Not Found.</div>";
                }
            
            
            ?>


          
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php'); ?>
</body>
</html>