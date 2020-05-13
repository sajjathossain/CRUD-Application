

<!--------------------------------------------------Contact Showing HTML Code Starts Here!---------------------------------------------------->

<!--------------------------------------------------Internal CSS Code For Table Ends Here!---------------------------------------------------->

<style>

#show_all{
    border-collapse: collapse;
    width: 100%;
    color: teal;
    font-family: monospace;
    text-align: center;
    font-size: 20px;
    row-gap: 10px;
}

#show_all th{
    background-color: teal;
    color: white;
}
#show_all tr:nth-child(odd){
    background-color: #eee;
}

</style>


<!------------------------------------------------Internal CSS Code For Table Ends Here!--------------------------------------------------->


<div>
        <table style="text-align: center;table-layout: auto;" id="show_all">
            <tr>
                <h4><b>Show All Contacts</b></h4>
            </tr>
            <tr>
                <th>Contact Name</th>
                <th>Contact Number</th>
                <th>Contact Email</th>
                <th>Additional Information</th>
                <th style="column-span: initial;">Actions</th>
                <th></th>
            </tr>
<!----------------------------------------------------Contact Table Php code starts here!---------------------------------------------------->
            <?php
                require "../config/mysql_conn.php";
                if(mysqli_connect_error($conn)){
                    die("Connection Failed".mysqli_connect_error($conn));
                }

                # Slecting desiresd fields!
                $select_db = "SELECT `id`,`contact_name`,`contact`,`email`,`additionals` FROM $account_user";
                $res = mysqli_query($conn,$select_db);

                $row = 0;
                # Checking if there is any data available!If any then showing it!
                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<tr>";
                        echo "<td>".$row["contact_name"]."</td>";
                        echo "<td>".$row["contact"]."</td>";
                        echo "<td>".$row["email"]."</td>";
                        echo "<td>".$row["additionals"]."</td>";
                        echo '<td><form action="" method="post"><input type="hidden" name="del_id" value='.$row["id"].'><input type="submit" value="Delete" name="delete_contact" class="btn btn-danger btn-sm"></form></td>';
                        echo '<td><form action="../config/update_contact.php?user_email='.$user_email.' & account_user='.$account_user.' & id='.$row["id"].'" method="post"><input type="hidden" name="edit_id" value='.$row["id"].'><input type="submit" value="Edit" name="edit_contact" class="btn btn-success btn-sm"></form></td></tr>';                    }
                    echo "</table>";
                }
                # If no data is available then showing error message!
                else{
                    echo '<p class="alert alert danger"><b>Nothig To Show!Add Some</b></p>';
                }

            ?>

<!----------------------------------------------------Contact Table Php code ends here!---------------------------------------------------->
</div>

<!---------------------------------------------------Contact Showing HTML Code Ends Here!-------------------------------------------------->
