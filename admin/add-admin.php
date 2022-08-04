<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/><br/>
        <?php 
        if(isset($_SESSION['add'])) //Checking whether the Session is set or not
        {

            echo $_SESSION['add']; //Display the Session  Message  if set
            unset($_SESSION['add']); ////Remove Session Message

        }
        ?>

        <form action="" method="Post">
        <table class="tbl-30">
            <tr>
                <td>FullName </td>
                <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
            </tr>
            <tr>
                <td>UserName </td>
                <td><input type="text" name="username" placeholder="Enter Your Username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" placeholder="Enter Your Password"></td>
            </tr>

            <tr>
                <td colspan="2">
                <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
            </td>
            </tr>
        </form>

        <table>
   </div>
</div>   

<?php include('partials/footer.php')?>
<?php 
//process the value from Form and save it in Database
//check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    //button clicked
   // echo "Button Clicked";

    //get the data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password =md5( $_POST['password']);//password encryption with MD5

     //2. SQL querry to save the database into database
     $sql = "INSERT INTO tbl_admin SET
     full_name = '$full_name',
     username = '$username',
     password = '$password'
    ";



  // Executing query and saving data into database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //4. check whether the(query is executed) data is inserted or not and display appropirate message
    if($res==TRUE)
    {
        //data inserted
    //echo "Data inserted";

    //create a session variable to display message

    $_SESSION['add'] = "<div class ='success'>Admin Added Successfully.</div>";

    //Redirect page to Manage Admin
    header("location:".SITEURL.'admin/manage-admin.php');

    }else{

    //echo "Failed to insert data ";

    //create a session variable to display message
    
    $_SESSION['add'] = "Failed to Add Admin";

    //Redirect page to Manage admin

    header("location:".SITEURL.'admin/add-admin.php');

    } 
}
?>