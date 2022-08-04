<?php
include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
      <h1> Update Order</h1>
      <br><br>
             
     
      <?php 
       
       //check whether the id is set or not

       if(isset($_GET['id']))
       {
         //Get the id and all other details
         //echo "Getting the data";
         $id=$_GET['id'];
        //create sql query to get all other details
         $sql="SELECT * FROM tbl_order WHERE id=$id";

         //Execute the query
         $res=mysqli_query($conn, $sql);

       /*  //Get the value base on query executed
         $row=mysqli_fetch_assoc($res);

         //get the individual values of selected food
           $title = $row2['title'];
           $description = $row2['description'];
           $price = $row2['price'];
           $current_image=$row2['image_name'];
           $current_category=$row2['category_id'];
           $featured=$row2['featured'];
           $active=$row2['active'];

        */
 
         //count  the rows to check whether the id is valid or not
        $count = mysqli_num_rows($res);

         if($count==1)
         {
           //Get all the Data
           $row=mysqli_fetch_assoc($res);

           $food = $row['food'];
           $price = $row['price'];
           $qty=$row['qty'];
           $status=$row['status'];
           $customer_name=$row['customer_name'];
           $customer_contact=$row['customer_contact'];
           $customer_email=$row['customer_email'];
           $customer_address=$row['customer_address'];

           

         }else
         {
             //redirect to manage food with sesion message
                         header('location:'.SITEURL.'admin/manage-order.php');
         } 

         }else{
           //redirect to manage food
       
           header('location:'.SITEURL.'admin/manage-order.php');
       }
   
       ?>

      <form action="" method="POST" enctype="multipart/form-data">
      <table class="tbl-30">
        <tr>
            <td> Food Name: </td>
            <td>
              <?php echo $food ;?>
            </td>
        </tr>

        <td> Price: </td>
            <td> <?php echo "₹ " ?>
              <?php echo $price ;?>
            </td>
        </tr>


         <tr>
            <td> Quantity: </td>
            <td>
            <input type="number" name="qty" value="<?php echo $qty ;?>">
            </td>
         </tr>

                 
         <tr>
              <td> Status </td>
              <td>
                  <select name="status">
                      <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                      <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                      <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                      <option <?php if($status=="Canceled"){echo "selected";} ?> value="Canceled">Canceled</option>
                    </select>
             </td>
          </tr>

          
         <tr>
              <td>Name: </td>
              <td>
                 <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
             </td>
          </tr>

          
         <tr>
              <td>Contact: </td>
              <td>
                 <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
             </td>
          </tr>

          
         <tr>
              <td> Email: </td>
              <td>
                 <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
             </td>
          </tr>

          
         <tr>
              <td> Address: </td>
              <td>
                 <textarea name="customer_address"  cols="30" rows="5"><?php echo $customer_address; ?></textarea>
             </td>
          </tr>

          <tr>  
              <td clospan="2">
                 <input type="hidden" name="id" value="<?php echo $id; ?>">
                 <input type="hidden" name="price" value="<?php echo $price ;?>">
                  <input type="submit" name="submit" value="Update Order" class="btn-secondary">

               </td>
          </tr>
;



        

      
      </table>
      </form>

      <?php
      //check whether update button is cliced or not
      if(isset($_POST['submit']))
      {
          echo "clicked";
         //1. get all the values from  our form
          $id= $_POST['id'];
          $price = $_POST['price'];
          $qty = $_POST['qty'];
          $total = $price * $qty;
          $status=$_POST['status'];
          $customer_name = $_POST['customer_name'];
          $customer_contact = $_POST['customer_contact'];
          $customer_email = $_POST['customer_email'];
          $customer_address = $_POST['customer_address'];


          
                     
                   

          //3. Update the database
            $sql2 ="UPDATE tbl_order SET
            qty='$qty',
            total='$total',
            status='$status',
            customer_name='$customer_name',
            customer_contact='$customer_contact',
            customer_email='$customer_email',
            customer_address='$customer_address'
            WHERE id='$id'
           ";

           //Execute the query
           $res2 = mysqli_query($conn, $sql2);


          //4. Redirect to manage food with message
          //check whether the query is executed or not
          if($res2==true)
          {
              //fod updated
              $_SESSION['update'] ="<div class='success'>Order Updated Succesfully.</div>";
              header('location:'.SITEURL.'admin/manage-order.php');

          }else
          {
              //failed to update food
              $_SESSION['update'] ="<div class='error'> Failed to Update Order .</div>";
              header('location:'.SITEURL.'admin/manage-order.php');

          }



      }
  
  ?>

     
    
    </div>  

</div>


<?php include('partials/footer.php');?>