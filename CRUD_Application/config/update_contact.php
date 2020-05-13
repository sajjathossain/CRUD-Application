<!------------------------------------------------------Contact Updating PHP Code Starts Here!-------------------------------------------------->
<?php
    # Importing DB connection!
    require '../config/mysql_conn.php';
    
    # Getting Logger Info!
    if(isset($_GET['user_email']) or isset($_GET['account_user']) and isset($_GET['id'])){
    $user_email = $_GET['user_email'];
    $account_user = $_GET['account_user'];
    $update_row = $_GET['id'];
    }
 

    if(isset($_POST['edit_contact'])) {

        $show_sql = "SELECT * FROM $account_user WHERE $account_user.`id` = '$update_row'";
        $show_sql_result = mysqli_query($conn,$show_sql);
        $row = mysqli_fetch_assoc($show_sql_result);
    }

        if (isset($_POST['update_contact'])) {
                if(empty($_POST['contact_name']) and empty($_POST['contact_number']) and empty($_POST['contact_email']) and empty($_POST['additionals'])){
                    echo '<p class="alert alert-danger">Please fill in atleast one field!</p>';
                }else{
                $up_name = mysqli_real_escape_string($conn,$_POST['contact_name']);
                $up_contact = mysqli_real_escape_string($conn,$_POST['contact_number']);
                $up_email =  mysqli_real_escape_string($conn,$_POST['contact_email']);
                $up_additionals = mysqli_real_escape_string($conn,$_POST['additionals']);
                $update_contact_sql = "UPDATE $account_user SET `contact_name` = '$up_name', `contact` = '$up_contact', `email` = '$up_email' , `additionals` = '$up_additionals' WHERE $account_user.`id` = $update_row";
                $update_contact_sql_query = mysqli_query($conn,$update_contact_sql);

                if($update_contact_sql_query){
                    header ("Location: ../config/login_success.php?user_email=$user_email & account_user=$account_user");
                }else{
                    $error_msg = "Unable To Update Contact!";
                }
            }
        }
?>
<!------------------------------------------------------Contact Updating PHP Code Ends Here!-------------------------------------------------->

<!--------------------------------------------------------Head Section Starts Here!--------------------------------------------------------->

<head>
    <title>Update!</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>

    <style>

    #navs{
        background-color: aquamarine;
        border: 3px solid teal;
        display:grid;
        grid-template-columns: 3fr 1fr;
        border-bottom: none;
    }
    
    #wlec{
        color: teal;
        justify-items: stretch;
        text-align: center;
    }

    #log_out{
        text-align: right;
        margin-right:10%;
        margin-top: 3%;
    }

    .actions{
    display:grid;
    grid-template-columns: 2fr 1fr;
    grid-gap: 1em;
    grid-auto-rows: minmax(100px,auto);    
    justify: stretch;
    }

    .actions > div{
        background: white;
        padding:1em;
        color: teal;
    }
    
    .actions > div:nth-child(even){
        background: aquamarine;
        padding:1em;
        color: teal;
        font-weight: bold;
    }

    </style>
</head>
<!-----------------------------------------------------------Head Section Ends Here!-------------------------------------------------------->

<!------------------------------------------------------Contact Updating HTML Code Starts Here!-------------------------------------------------->

<div id="navs">
    <div id="wlec">
        <h1><b>Update Contact</b></h1>
    </div>
    <div id="log_out"> 
        <a href="../config/login_success.php?user_email=<?php echo $user_email;?> & account_user=<?php echo $account_user; ?>" class="btn btn-danger btn-sm">Back</a>
    </div>
</div>
<div class="jumbotron col-md-12" style="border:3px solid teal;text-align: center; float: center; color:teal; margin-bottom: 0%; border-bottom: none;">
<div class="actions">
    <div>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">

            <?php
                if (isset($_POST['update_contact']) and (!$update_contact_sql_query)) {
                    echo '<p class="alert alert-danger">Unable To Update Contact!</p>';
                }
            ?>

            <table style="text-align: center; width: 100%; color: teal;">
            <tr>
                <h4><b>Update Contact: <?php if (isset($row["contact_name"])) { echo $row["contact_name"]; } ?></b></h4>
            </tr>
            <tr>
                <th>Enter Contact Name:</th>
            </tr>
            <tr>
                <td><input type="text" name="contact_name" id="" placeholder="Enter Contact Name*" value='<?php if(isset($row["contact_name"])){
                    echo $row["contact_name"];
                }  ?>' required></td>
            </tr>
            <tr>
                <th>Enter Contact Number:</th>
            </tr>
            <tr>
                <td><input type="text" name="contact_number" id="" placeholder="Enter Contact Number*" value='<?php if(isset($row["contact"])){
                    echo $row["contact"];
                }  ?>'></td>
            </tr>
            <tr>
                <th>Enter Email:</th>
            </tr>
            <tr>
                <td><input type="email" name="contact_email" id="" placeholder="Enter Contact Email*" value='<?php if(isset($row["email"])){
                    echo $row["email"];
                }  ?>'></td>
            </tr>
            <tr>
                <th>Additional Informations:</th>
            </tr>
            <tr>
                <td><input type="text" name="additionals" placeholder="Enter Additonal Informations*" value='<?php if(isset($row["additionals"])){
                    echo $row["additionals"];
                }  ?>'></td>
            </tr>
            <tr>
                <td>
                <input type="submit" value="Update Contact" name="update_contact" class="btn btn-danger btn-sm">
                </td>
            </tr>
            </table>
        </form> 
    </div>
    <div>
        <h4><b>Instructions For Updating Contact:</b></h4>
        <ul>
            <li>Atleast One Field Must Be Filled.</li>
            <li>Name Field Must Not Be Empty</li>
            <li>Name Must Start With A Character</li>
        </ul>
    </div>
    
</div>       
</div>

<!------------------------------------------------------Contact Updating HTML Code Ends Here!-------------------------------------------------->
<div>
    <?php
        include '../includes/footer.php';
    ?>
</div>
