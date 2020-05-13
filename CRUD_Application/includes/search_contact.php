
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

<!--------------------------------------------------Internal CSS Code For Table Ends Here!---------------------------------------------------->

<!--------------------------------------------------Contact Searching HTML Code Start Here!---------------------------------------------------->


<div>
        <table style="text-align: center;table-layout: auto;" id="show_all">
            <tr>
                <h4><b>Search Contact</b><sub style="font-size: 10px;"><a href="../config/login_success.php?user_email=<?php echo $user_email;?> & account_user=<?php echo $account_user; ?>"><b>Show All Contacts</b></a></sub></h4>
            </tr>
            <tr>
                <th>Contact Name</th>
                <th>Contact Number</th>
                <th>Contact Email</th>
                <th>Additional Information</th>
                <th style="column-span: initial;">Actions</th>
                <th></th>
            </tr>
            
<!--------------------------------------------------Contact Searching PHPL Code Starts Here!---------------------------------------------------->


            <?php
                include '../config/mysql_conn.php';
                        
                    $search = mysqli_real_escape_string($conn,$_POST['search_contact']);
                    $search_sqli = "SELECT * FROM `$account_user` WHERE `contact_name` LIKE '%$search%' OR `contact` LIKE '%$search%' OR `email` LIKE '%$search%' OR `additionals` LIKE '%$search%'";
                    $search_sqli_result = mysqli_query($conn,$search_sqli);
                    
                    if (mysqli_num_rows($search_sqli_result) > 0) {
                        while($s_row = mysqli_fetch_assoc($search_sqli_result)){
                            echo "<tr>";
                                    echo "<td>".$s_row["contact_name"]."</td>";
                                    echo "<td>".$s_row["contact"]."</td>";
                                    echo "<td>".$s_row["email"]."</td>";
                                    echo "<td>".$s_row["additionals"]."</td>";
                                    echo '<td><form action="" method="post"><input type="hidden" name="del_id" value='.$s_row["id"].'><input type="submit" value="Delete" name="delete_contact" class="btn btn-danger btn-sm"></form></td>';
                                    echo '<td><form action="../config/update_contact.php?user_email='.$user_email.'& account_user='.$account_user.'&id='.$s_row["id"].'" method="post"><input type="hidden" name="edit_id" value='.$s_row["id"].'><input type="submit" value="Edit" name="edit_contact" class="btn btn-success btn-sm"></form></td></tr>';                    }
                            echo "</tr>";
                        
                    } else {
                        echo '<p class="alert alert danger"><b>'.$_POST['search_contact'].' :Match Not Found!</b></p>';
                    }
                    
            ?>
            
<!--------------------------------------------------Contact Searching PHP Code Ends Here!---------------------------------------------------->


            </table>
</div>

<!--------------------------------------------------Contact Searching HTML Code Ends Here!---------------------------------------------------->

