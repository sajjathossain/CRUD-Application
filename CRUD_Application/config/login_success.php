
<!-----------------------------------------Code For User Being Redirected to user Page Starts Here!------------------------------------>

<?php
    # Importing db connection!
    require '../config/mysql_conn.php';
    
   # Getting Logger Info!
   if(isset($_GET['user_email']) or isset($_GET['account_user'])){
   $user_email = mysqli_real_escape_string($conn,$_GET['user_email']);
   $account_user = mysqli_real_escape_string($conn,$_GET['account_user']);
   }

   # Importing Contact Deletion Code
    include "../config/delete_contact.php";


?>
<!--------------------------------------------------------Head Section Starts Here!--------------------------------------------------------->

<head>
    <title>Logged In!</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>

    <style>
    #navs{
        background-color: aquamarine;
        border: 3px solid teal;
        display:grid;
        grid-template-columns: 2fr 2fr 1fr;
        border-bottom: none;
    }
    
    #wlec{
        color: teal;
        justify-items: stretch;
        text-align: center;
    }

    #search_field{
        text-align: right;
        margin-right:10%;
        margin-top: 2%;
    }

    #log_out{
        text-align: right;
        margin-right:10%;
        margin-top: 3%;
    }

    .actions{
    display:grid;
    grid-template-columns: 1fr 3fr;
    grid-gap: 1em;
    grid-auto-rows: minmax(100px,auto);
    justify-items: stretch;
    }

    .actions > div{
        background: aquamarine;
        padding:1em;
        color: teal;
    }

    .actions > div:nth-child(even){
        background: white;
        padding:1em;
    }

    </style>
</head>
<!-----------------------------------------------------------Head Section Ends Here!-------------------------------------------------------->

<!------------------------------------------------------------Body Section Starts Here!------------------------------------------------------>

<div id="navs">
    <div id="wlec">
        <h1><b>Welcome <?php echo strtoupper($account_user); ?></b></h1> 
    </div>
    <div id="search_field">
        <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
            <input type="search" name="search_contact" id="" placeholder="Enter word(s) to search for*" >
            <input type="submit" value="Search" name="search_submit" class="btn btn-danger btn-sm">
        </form>
    </div>
    <div id="log_out"> 
        <a href="../config/home.php?Logged_out" class="btn btn-danger btn-sm">Logout</a>
    </div>
</div> 

<div class="jumbotron col-md-12" style="border:3px solid teal;text-align: center; float: center; color:teal; margin-bottom: 0%; border-bottom: none;">
    
    <div class="actions">
        <!-----------------------------------------Importing Contact Showing Code!------------------------------------>
        <div class="col-md-12">
        <?php include "create_contact.php";?>
        </div>
        <div class="col-md-12">
        <?php if (isset($_POST['search_submit'])) {    
         include "../includes/search_contact.php";
        }else{
         include "../config/show_all_contacts.php";
        }?>
        </div>
        <!-----------------------------------------Importing Contact Creating Code!------------------------------------>
        
    </div>
</div>

<!-----------------------------------------------------------Body Section Ends Here!--------------------------------------------------------->


<!------------------------------------------Down below is the footer including php cod---------------------------------------------------------->

<?php
    include "../includes/footer.php";
?>

<!-----------------------------------------Code For User Being Redirected to user Page Starts Here!------------------------------------>
