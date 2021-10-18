<?php
session_start();
include "db_connect.php"; //connect this page with the database page

if(isset($_POST['username']) && isset($_POST['password'])){

    //validate the data entered in the form
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        return $data;
    }
}

//create variables for username and password to validate the data
$username = validate($_POST['username']);
$password = validate($_POST['password']);

//if $username and or $password is empty, it will display the error message
if(empty($username) || empty($password)){
    header ("Location: loginform.php?error=Username and password is required!");
    exit();
}

//Setup to fetch data from database // from table "users" in MYSQL DB
$sql = "SELECT * FROM users WHERE user_name='$username' AND password='$password'"; 

// Execute the query and store the result set
$result = mysqli_query($connection,$sql);

//If user try to perform an SQL Injector using SQL syntax such as (' --"), they will receive this message
if(gettype($result) === 'boolean' ){
    header("Location: loginform.php?error=Please do not try to bypass!");
    exit();
}

if(mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    
    //If user name and password IS matched with data in the database, It will display a message as "Logged In!"
    if ($row['user_name'] === $username && $row['password'] === $password) {
        echo "Logged In!";

        //create login session
        $_SESSION['user_name'] = $row['user_name'];
        // $_SESSION['name'] = $row['name'];
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