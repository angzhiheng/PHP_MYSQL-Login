<?php
session_start();
include "db_connect.php"; //connect this page with the database page

if(isset($_POST['usernameOrEmail']) && isset($_POST['password'])){

    //validate the data entered in the form
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        return $data;
    }
}

//create variables for usernameOrEmail and password to validate the data
$usernameOrEmail = validate($_POST['usernameOrEmail']);
$password = validate($_POST['password']);

//if $usernameOrEmail and or $password is empty, it will display the error message
if(empty($usernameOrEmail) || empty($password)){
    header ("Location: loginform.php?error=All fields must be entered!");
    exit();
}

//Setup to fetch data from database // from table "users" in MYSQL DB
$sqlUsernameOrEmail = "SELECT * FROM users WHERE user_name='$usernameOrEmail' OR email='$usernameOrEmail'"; 

//Setup to fetch data from database // from table "users" in MYSQL DB
$sqlPassword = "SELECT * FROM users WHERE password='$password'"; 

// Execute the query and store the result set
$resultUsernameOrEmail = mysqli_query($connection,$sqlUsernameOrEmail);

// Execute the query and store the result set
$resultPassword = mysqli_query($connection,$sqlPassword);

//If user try to perform an SQL Injector using SQL syntax such as ( -- "), they will receive this message
if(gettype($resultPassword) === 'boolean' ){
    header("Location: loginform.php?error=Please do not try to bypass!");
    exit();
}

if(mysqli_num_rows($resultPassword) === 1 && mysqli_num_rows($resultUsernameOrEmail) === 1) {
    $rowUsernameOrEmail = mysqli_fetch_assoc($resultUsernameOrEmail);
    $rowPassword = mysqli_fetch_assoc($resultPassword);
    
    //If user name and password IS matched with data in the database, It will display a message as "Logged In!"
    if (($rowUsernameOrEmail['user_name'] === $usernameOrEmail || $rowUsernameOrEmail['email'] === $usernameOrEmail ) && $rowPassword['password'] === $password) {
        echo "Logged In!";

        //create login session
        $_SESSION['user_name'] = $row['user_name'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['id'] = $row['id']; //id will also be a field in the database that would be auto incremented and work as a primary key.
        header("Location: home.php");
        exit();
    }
    else{
        header("Location: index.php");
        exit();
    }
    
}  
//If user name and password is NOT matched with data in the database, It will display a message as "Incorrect username or password!"
else{
    header("Location: loginform.php?error=Incorrect username or password");
    exit();
}

?>