
<!------------------------------------------Account Creating Php code starts here---------------------------------------------------------->
<?php
    # Importing DataBase Connection!
    require('../config/mysql_conn.php');
    
    if(isset($_POST['cre_acc']) and isset($_POST['acc_pass']) and isset($_POST['acc_name']) and isset($_POST['acc_pass_again'])){
            
            # collecting user inputs!
            $accName = $accPass = $accPassAgain = $pwd = $user =  " ";
           
            $accName = mysqli_real_escape_string($conn,$_POST['acc_name']);
            $pwd = mysqli_real_escape_string($conn,$_POST['acc_pass']); 
            $accPassAgain = mysqli_real_escape_string($conn,$_POST['acc_pass_again']);
            $user_name = mysqli_real_escape_string($conn,strtolower($conn,$_POST['Uname']));

            
            # Checking for same contact name! 
            $check_for_user_name = "SELECT * FROM `users` WHERE `username` = '$user_name'";
            $check_for_email = "SELECT * FROM `users` WHERE `email` = '$accName'";
            $res_usr = mysqli_query($conn,$check_for_user_name);
            $res_email = mysqli_query($conn,$check_for_email);
            if(mysqli_num_rows($res_usr)>0)
            {
                echo '<p class="alert alert-danger" style="text-align: center; font-weight: bolder;">There is a user by the same user name!Please,choose another one!</p>';
            }elseif(mysqli_num_rows($res_email)>0)
            {
                echo '<p class="alert alert-danger" style="text-align: center; font-weight: bolder;">There is a user by the same eamil!Please,choose another one!</p>';
            }else {
            
            # Checking if passwords match!
            if($pwd == $accPassAgain){
                
            # Encrypting Password!
            $accPass = MD5($pwd);
            # checking if connecting is made!
            if($conn){
                
                # selecting database
                $sql = "INSERT INTO `users` (`username`,`email`,`pass`) 
                VALUES ('$user_name','$accName','$accPass')";

                # inserting into database
                $query = mysqli_query($conn,$sql);

/********************************************************Table Creating Code Starts Here*****************************************************/
                # Table info!
                $create_db_table = "CREATE TABLE $user_name(id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                    contact_name varchar(128) NOT NULL,
                                    contact varchar(128),
                                    email varchar(128),
                                    additionals varchar(56)
                );";

                #Creating Table!
                $tab_query = mysqli_query($conn,$create_db_table);

/********************************************************Table Creating Code Ends Here*****************************************************/
                
                #checking if inserted then redirecting the page!
                if ($query && $tab_query) {
                    header ('Location: ../config/home.php?SignUp=Success');
                }else{
                    echo '<p style="color: red;">Unable to insert data!</p>' . mysqli_errno($conn);
                }
            }

        }elseif($pwd != $accPassAgain){
            $msg = "Invalid Email Or Password";
            echo '<p class="alert alert-danger" style="text-align:center; float:center; border:3px solid #DC3545">'.$msg.'</p>';
        }
    }
}

?>
<!------------------------------------------Account Creating Php code ends here---------------------------------------------------------->








<!------------------------------------------Account Creating html code starts here---------------------------------------------------------->
<!------------------------------------------------------------Title Part Starts Here----------------------------------------------------->
<head>
    <title>Create Account</title>
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
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>
</head>
<!--------------------------------------------Title part Ends Here------------------------------------------------------------------->

<!---------------------------------------------------Body starts here---------------------------------------------------------------->

<div id="navs">
    <div id="wlec">
        <h1><b>Create Account</b></h1>
    </div>
    <div id="log_out"> 
        <a href="../config/home.php?Login = Successful" class="btn btn-danger btn-sm">Back To Login</a>
    </div>
</div>
<!--------------------------------------------------Account creation form is down below--------------------------------------------->
<div class="jumbotron col-md-12 actions" style="border:3px solid teal; text-align: center; float: center; margin-bottom: 0%; border-bottom: none;">
    <div>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post" >

            <table  style="text-align: center; width: 100%; color: teal;">
                <tr>
                    <td><h2><b>Create Account:</b></h2></td>
                </tr>
                <tr>
                    <td>
                    <b>User Name: </b>
                    </td>
                </tr>
                <tr>
                    <td><input type="text" name="Uname" id="" placeholder="Enter Your User Name*" required></td>
                </tr>
                <tr>
                    <td>
                    <b>Enter Your email:</b>
                    </td>
                </tr>
                <tr>
                    <td><input type="email" name="acc_name" id="" placeholder="Enter your Email*" required></td>
                </tr>
                
                <tr>
                    <td><b>Enter Password:</b></td>
                </tr>
                <tr>
                    <td><input type="password" name="acc_pass" id="" placeholder="Enter your Password*" required></td>
                </tr>
                <tr>
                    <td><b>Enter Password Again: </b></td>
                </tr>
                <tr>
                    <td><input type="password" name="acc_pass_again" id="" placeholder="Enter your Password Again*" required> </td>
                </tr>
                <tr>
                    <td><input type="submit" value="Create Account" name="cre_acc" class="btn btn-danger"></td>
                </tr>
            </table>

        </form>

    </div>

    <div>
            <h4><b>Instructions For Creating Account:</b></h4>
            <ul>
                <li>Atleast One Field Must Be Filled</li>
                <li>Name Field Must Not Be Empty</li>
                <li>Name Must Start With A Character</li>
            </ul>
    </div>
        
</div>

<!------------------------------------------------------------Body ends here---------------------------------------------------------->

<!------------------------------------------Account Creating Php code ends here---------------------------------------------------------->

<!------------------------------------------Down below is the footer including php cod---------------------------------------------------------->

<?php
    include '../includes/footer.php';

?>