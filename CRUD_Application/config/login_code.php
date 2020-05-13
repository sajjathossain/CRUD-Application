<!----------------------------------Login Php code starts here--------------------------------------------------------------------->
<?php
    # Importing DataBase Connection!
    require('mysql_conn.php');

    if(isset($_POST['sub']) and isset($_POST['mail']) and isset($_POST['pass'])){
    
    # collecting user inputs!
    $name = mysqli_real_escape_string($conn,$_POST['mail']);
    $pass = mysqli_real_escape_string($conn,MD5($_POST['pass']));
    
    # selecting database!
    $lg_sql = "SELECT * FROM `users` WHERE  `email` = '$name' and `pass` = '$pass'";
    
    # connecting to the database!
    $result = mysqli_query($conn,$lg_sql);

    $lg_email = "";
    $lg_user = "";

    # matching the results!
    if (mysqli_num_rows($result) > 0) {
        while($rows = mysqli_fetch_assoc($result)){
            $lg_email = $rows['email'];
            $id = $rows['id'];
            $lg_user = $rows['username'];
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['email'] = $email;
        }
        header ("Location: ../config/login_success.php?user_email=$lg_email & account_user=$lg_user");
    } else {
        $err_msg = "Invalid Email Or Password!";
    }
    
    }
?>
<!------------------------------------------Login Php code ends here----------------------------------------------------------------->




<style>
    
    .actions{
    display:grid;
    grid-template-columns: 3fr 2fr;
    grid-gap: 1em;
    grid-auto-rows: minmax(100px,auto);    
    justify: stretch;
    }

    .actions > div{
        background: white;
        padding:1em;
    }
      
    
    .actions > div:nth-child(even){
        background: aquamarine;
        padding:1em;
        color: teal;
        font-weight: bold;
    }

    #welcome{
    }

</style>


<!------------------------------------------Login HTML code starts here----------------------------------------------------------------->
<link rel="stylesheet" href="../css/bootstrap.min.css">
<div class="jumbotron col-md-12  actions" style="border:3px solid teal;text-align: center; margin-bottom: 0%; border-bottom: none; border-top: none; float: center;">
    <div>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <?php
                if (isset($_POST['sub']) and (mysqli_num_rows($result) < 1)) { 
                    echo '<p class="alert alert-danger" style="text-align: center;">'.$err_msg.'</p>';
                }
            ?>

            <table  style="text-align: center; width: 100%; color: teal;">
                <tr>
                    <td>
                        <h3><b>Log In:</b></h3>
                    </td>
                </tr>
                <tr>
                    <th>Email: </th>
                </tr>
                <tr>
                    <td><input type="email" name="mail" id="" placeholder="Enter your email*" required><br></td>
                </tr>

                <tr>
                    <th>Password: </th>
                </tr>
                <tr>
                    <td><input type="password" name="pass" id="" placeholder="Enter your password*" required></td>
                </tr>
                
                <tr>
                    <td><input type="submit" value="Login" name="sub" class="btn btn-success"><br></td>
                </tr>
                <tr>
                <td><b style="color: red;">Don't have any Account! <a href="../config/account_create_code.php">Click Here To Create An Account!</a></b></td>
                </tr>
            </table>
        </form>
    </div>
    <div id="welcome">
        <h3><b>Welcome To The CRUD Application</b></h3>
        <ul>
            <li>An Web Based Application To Store Informations!</li>
            <li>You Can Store Contacts,Email etc.</li>
            <li>All You Need Is Just An Account And We'll Handle The Rest!</li>
        </ul>
    </div>
</div>

<!------------------------------------------Login HTML code ends here----------------------------------------------------------------->