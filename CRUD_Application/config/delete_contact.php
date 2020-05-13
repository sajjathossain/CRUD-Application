<?php 

    require '../config/mysql_conn.php';
    if (isset($_REQUEST['delete_contact'])) {

        # Getting id because its primary key
        $del_id = mysqli_real_escape_string($conn,$_REQUEST['del_id']);
        # Selecting Database
        $delete_contact_db = "DELETE FROM $account_user WHERE id = $del_id";
        # Performing Query
        $delete_contact_db_query = mysqli_query($conn,$delete_contact_db);
        
        if ($delete_contact_db_query) {
        header ("Location: ../config/login_success.php?user_email=$user_email & account_user=$account_user");
        }else{
        echo '<p style="color: red;">Unable to delete data!</p>' . mysqli_errno($delete_contact_db);
        }
    }
    
?>