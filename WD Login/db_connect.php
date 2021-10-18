<?php

    $serverName = "localhost";
    $username = "root";
    $password = "";


    $connection = mysqli_connect($serverName,$username,$password);


    //check if the connection is working
    if((!$connection) || mysqli_connect_errno()){
        echo "Connection Failed" . mysqli_connect_error();
    }

    //create database if does not exist
    $sql_db = "CREATE DATABASE userdata_db";

    $db_name = "userdata_db"; //assign db name to the variable

    //create database
    if (mysqli_query($connection, $sql_db)) {
        echo "Database created successfully! <br/>";
        $connection = mysqli_connect($serverName,$username,$password,$db_name);
    } 
    else { // if cannot create database, then we try to connect to database to confirm its existence
        $connection = mysqli_connect($serverName,$username,$password,$db_name);
    }   
    
    //check connection
    if ($connection) { 
        echo "Database connected successfully! <br/>";     
    } 
    else {
        echo "Error connecting to database: " . mysqli_error($connection) ."<br/>";
    }

    //create table and columns for the database
    $sql_column = "CREATE TABLE `userdata_db`.`users` ( `id` INT NOT NULL AUTO_INCREMENT , `user_name` VARCHAR(100) NOT NULL , `email` VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

    if (mysqli_query($connection, $sql_column)) {
        echo "Table and columns created successfully! <br/>";
    } 
    else { 
        echo "Error creating table: " . mysqli_error($connection) ."<br/>";
    }

//create a default login value for admin

//Setup to fetch data "user_name" from database // from table "users" in MYSQL DB
$sqlUsernameExistCheck = "SELECT * FROM users WHERE user_name='admin'"; 

// Execute the query and store the result set
$resultUsernameExistCheck = mysqli_query($connection,$sqlUsernameExistCheck);

//To prevent duplication of the login value, we check if the value exists.
if(mysqli_num_rows($resultUsernameExistCheck) === 1) {
  echo "Error: Duplicate login value! <br/>";
}
else{ // if the login value does not exist, then we add it
    $sql_admin = "INSERT INTO users (user_name,email,password) VALUES ('admin','admin@email.com','admin')";

    if (mysqli_query($connection, $sql_admin)) {
        echo "Login information added successfully! <br/>";
    } 
    else { 
        echo "Error creating table: " . mysqli_error($connection) ."<br/>";
    }
}

// final checking
if ($connection) 
echo "<br/> <b> Everything is good to go! </b> <br/>";
?>