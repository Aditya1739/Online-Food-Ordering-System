<?php include('partials/menu.php');?>
  

  <!--Main Content  Section starts-->
  <div class="main-content">
  <div class = "wrapper">
         <h1>DASHBOARD</h1>
         <br>
         <?php 
         if(isset($_SESSION['login'])){

            echo $_SESSION['login'];
            unset($_SESSION['login']);
           }
         
         ?>
          <br>

         <div class= "col-4 text-center">
         <?php

         //sql query
           $sql="SELECT * FROM tbl_categories";

           //Execute the query
           $res=mysqli_query($conn,$sql);

           //count the rows
           $count=mysqli_num_rows($res);
         ?>
             <h1><?php echo $count;?></h1>
             <br/>
            Total Categories
         </div>

         <div class= "col-4 text-center">
         <?php

         //sql query
           $sql5="SELECT * FROM tbl_categories WHERE active='Yes'";

           //Execute the query
           $res5=mysqli_query($conn,$sql5);

           //count the rows
           $count5=mysqli_num_rows($res5);
         ?>
             <h1><?php echo $count5;?></h1>
             <br/>
            Active Categories
         </div>

         <div class= "col-4 text-center">
         <?php

         //sql query
           $sql2="SELECT * FROM tbl_food";

           //Execute the query
           $res2=mysqli_query($conn,$sql2);

           //count the rows
           $count2=mysqli_num_rows($res2);
         ?>
             <h1><?php echo $count2; ?></h1>
             <br/>
            Total Food Items
         </div>

         <div class= "col-4 text-center">
         <?php

         //sql query
           $sql6="SELECT * FROM tbl_food WHERE active='Yes'";

           //Execute the query
           $res6=mysqli_query($conn,$sql6);

           //count the rows
           $count6=mysqli_num_rows($res6);
         ?>
             <h1><?php echo $count6; ?></h1>
             <br/>
            Active Food Items
         </div>


         <div class= "col-4 text-center">
         <?php

         //sql query
           $sql3="SELECT * FROM tbl_order";

           //Execute the query
           $res3=mysqli_query($conn,$sql3);

           //count the rows
           $count3=mysqli_num_rows($res3);
         ?>
             <h1><?php echo $count3; ?></h1>
            <br/>
             Total Orders
         </div>

         <div class= "col-4 text-center">
         <?php

         //sql query
           $sql3="SELECT * FROM tbl_order WHERE status='On Delivery'";

           //Execute the query
           $res3=mysqli_query($conn,$sql3);

           //count the rows
           $count3=mysqli_num_rows($res3);
         ?>
             <h1><?php echo $count3; ?></h1>
            <br/>
              On Delivery
         </div>

         <div class= "col-4 text-center">
         <?php

         //sql query
           $sql3="SELECT * FROM tbl_order WHERE status='Delivered'";

           //Execute the query
           $res3=mysqli_query($conn,$sql3);

           //count the rows
           $count3=mysqli_num_rows($res3);
         ?>
             <h1><?php echo $count3; ?></h1>
            <br/>
             Delivered Orders
         </div>

         <div class= "col-4 text-center">
         <?php

         //sql query
           $sql3="SELECT * FROM tbl_order WHERE status='Canceled'";

           //Execute the query
           $res3=mysqli_query($conn,$sql3);

           //count the rows
           $count3=mysqli_num_rows($res3);
         ?>
             <h1><?php echo $count3; ?></h1>
            <br/>
             Canceled Orders
         </div>





         

         <div class= "col-4 text-center">
         <?php
         //create sql query to get total revenue generated
         //aggregate function in sql
         $sql4="SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";

         //execute the query
         $res4=mysqli_query($conn,$sql4);

         //get the value
         $row4=mysqli_fetch_assoc($res4);

         //get the total revenue
         $total_revenue=$row4['Total'];
         ?>
         
             <h1>₹<?php echo $total_revenue;?></h1>
             <br/>
             Total Revenue
         </div>
         <div class= "clearfix"> 

         </div>

    </div>
    </div>
    <!--Main Content  Section ends-->
    
    <?php include('partials/footer.php');?>

  

 

  
  