<?php
session_start();
include "db_connect.php"; //connect this page with the database page

if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['repassword'])){

    //validate the data entered in the form
    function validate($data) {
        $data = trim($data); //remove white space
        return $data;
    }
}

//create variables for username and password to validate the data
$username = validate($_POST['username']);
$email = validate($_POST['email']);
$password = validate($_POST['password']);
$repassword = validate($_POST['repassword']);

//if either field is empty, it will display the error message
if(empty($username) || empty($email) || empty($password) || empty($repassword)){
    header ("Location: registerform.php?error=All fields must be filled!");
    exit();
}

//if $password and or $repassword is different, it will display the error message
if($password !== $repassword){
    header ("Location: registerform.php?error=Both password must be the same!");
    exit();
}

//Setup to fetch data "user_name" from database // from table "users" in MYSQL DB
$sqlUsernameExistCheck = "SELECT * FROM users WHERE user_name='$username'"; 

// Execute the query and store the result set
$resultUsernameExistCheck = mysqli_query($connection,$sqlUsernameExistCheck);

//Setup to fetch data "email" from database // from table "users" in MYSQL DB
$sqlEmailExistCheck = "SELECT * FROM users WHERE email='$email'"; 

// Execute the query and store the result set
$resultEmailExistCheck = mysqli_query($connection,$sqlEmailExistCheck);

if(mysqli_num_rows($resultUsernameExistCheck) === 1 && mysqli_num_rows($resultEmailExistCheck) === 1) {
    header("Location: registerform.php?error=Both username and email has been used! Try another one.");
    exit();
}

if(mysqli_num_rows($resultUsernameExistCheck) === 1) {
    header("Location: registerform.php?error=Username has been used! Try another one.");
    exit();
}

if(mysqli_num_rows($resultEmailExistCheck) === 1) {
    header("Location: registerform.php?error=Email has been used! Try another one.");
    exit();
}


//Setup to insert data into database // into table "users" in MYSQL DB
$sql = "INSERT INTO users (user_name,email,password) VALUES ('$username','$email','$password')"; 

if ($connection->query($sql) === TRUE) {
    header("Location: registerform.php?error=New record created successfully");
} else {
    header("Location: registerform.php?error=Error: " . $sql . "<br>" . $connection->error);
}

?>