<?php

    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'login';
    $db_table_name = 'users';

    if (isset($db_host) and isset($db_user) and isset($db_pass) and isset($db_name) and isset($db_table_name)) {

        $connection = mysqli_connect($db_host,$db_user,$db_pass);
        # Selecting DataBase!
        $select_data_base = mysqli_select_db($connection,$db_name);

        if (!$connection) {
            die("Connection Error".mysqli_error($connection));
        }else {
            

            # Checking if database is available or not!
            if (empty($select_data_base)) {
                
                $ctreated_database = mysqli_query($connection,"CREATE DATABASE $db_name");

                # Creating database Connection!
                $Connection_after_creating_database = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
                # Creating Database Table
                $create_database_table = "CREATE TABLE $db_table_name(id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                                                        username varchar(255) NOT NULL,
                                                                        email varchar(255) NOT NULL,
                                                                        pass varchar(255) NOT NULL
                );";

                $created_database_table = mysqli_query($Connection_after_creating_database,$create_database_table);

                # Redirecting To Home Page!
                if (!empty($ctreated_database) and !empty($created_database_table)) {
                    header ("Location: config/home.php");
                }else{
                    echo '<p class="alert alert-danger" style="text-align: center;">Unable To Create Database!</p>';
                }
                

            }elseif (!empty($select_data_base) and empty($check_table)) {
                
                # After creating connection
                $after_creation_database = mysqli_connect($db_host,$db_user,$db_pass,$db_name); 
                # Checking For Table
                $check_table = mysqli_query($after_creation_database,"SELECT * FROM `$db_name`");

                # Creating Table
                $create_database_table = "CREATE TABLE $db_table_name(id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                                                        username varchar(255) NOT NULL,
                                                                        email varchar(255) NOT NULL,
                                                                        pass varchar(255) NOT NULL
                );";

                # Performing Creating Table Query!
                $tab_query = mysqli_query($after_creation_database,$create_database_table);

                if (!empty($check_table)) {
                    echo '<p class="alert alert-danger" style="text-align: center;">Unable To Create Database Table!</p>';
                }else {
                    header ("Location: config/home.php");
                }

            }elseif (!empty($select_data_base) and !empty(mysqli_query($after_creation_database,"SELECT * FROM `$db_name`"))) {
                header("Location: ../config/home.php");
            }
        }
    }
    
?>