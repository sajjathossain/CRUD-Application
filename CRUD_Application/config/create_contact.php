<!------------------------------------------------Contact adding php code starts here!---------------------------------------------------->
<?php
    #Importing db connection
    require '../config/mysql_conn.php';

    if (isset($_POST['add_contact'])) {
            if(!empty($_POST['contact_number']) or !empty($_POST['contact_email']) or !empty($_POST['additionals'])){
                if (isset($_POST['contact_name']) and isset($_POST['contact_number']) and isset($_POST['contact_email']) and isset($_POST['additionals'])) {

                    # collecting user inputs
                        $create_contact_name = mysqli_real_escape_string($conn,$_POST['contact_name']);
                        $create_contact_number = mysqli_real_escape_string($conn,$_POST['contact_number']);
                        $create_contact_email = mysqli_real_escape_string($conn,$_POST['contact_email']);
                        $create_contact_additionals = mysqli_real_escape_string($conn,$_POST['additionals']);

                        # Checking for same contact name! 
                        $check_for_contact_name = mysqli_query($conn,"SELECT * FROM `$account_user` WHERE `contact_name` = '$create_contact_name'");
                                        
                        if(mysqli_num_rows($check_for_contact_name) > 0)
                        {
                            echo '<p class="alert alert-danger" style="text-align: center; font-weight: bolder;">There is a contact by the same conatct name!</p>';
                        }else {

                        # selecting database
                        $choose_db = "INSERT INTO `$account_user` (`contact_name`,`contact`,`email`,`additionals`) 
                        VALUES ('$create_contact_name','$create_contact_number','$create_contact_email','$create_contact_additionals')";
        
                        # inserting into database
                        $create_contact_query = mysqli_query($conn,$choose_db);
                        
                        #checking if inserted then redirecting the page!
                        if ($create_contact_query) {
                            header("Location: ../config/login_success.php?user_email=$user_email & account_user=$account_user");
                        }else{
                            echo '<p style="color: red;">Unable to insert data!</p>' . mysqli_errno($conn);
                        }
                    }
                }else{
                echo '<p class="alert alert-danger">Please fill in atleast one field!</p>';
            }
        }
    }
    

    

?>

<!------------------------------------------------Contact adding php code starts here!---------------------------------------------------->


<!---------------------------------------------Contact Adding HTML Code Starts Here!------------------------------------------------------>

<div class="insert_data">
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <table style="text-align: center; width: 100%; color: teal;">
        <tr>
            <h4><b>Add Contact</b></h4>
        </tr>
        <tr>
            <th>Enter Contact Name:</th>
        </tr>
        <tr>
            <td><input type="text" name="contact_name" id="" placeholder="Enter Contact Name*"  required></td>
        </tr>
        <tr>
            <th>Enter Contact Number:</th>
        </tr>
        <tr>
            <td><input type="text" name="contact_number" id="" placeholder="Enter Contact Number*" ></td>
        </tr>
        <tr>
            <th>Enter Email:</th>
        </tr>
        <tr>
            <td><input type="email" name="contact_email" id="" placeholder="Enter Contact Email*" ></td>
        </tr>
        <tr>
            <th>Additional Informations:</th>
        </tr>
        <tr>
            <td><textarea name="additionals" id="" cols="30" rows="10" placeholder="Enter Additonal Informations*" ></textarea></td>
        </tr>
        <tr>
            <td><input type="submit" value="Add Contact" name="add_contact" class="btn btn-success btn-sm">
            </td>
        </tr>
        </table>
    </form>        
</div>

<!-----------------------------------------------------Contact Adding HTML Code Ends Here!------------------------------------------------>
