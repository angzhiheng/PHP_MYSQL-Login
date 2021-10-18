<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
</head>
<body>
    <form action="register.php" method="post">
        <table>
            <a class="back" href="index.php"><image class="back-btn" src="svg/arrow-left.svg"/><p class="pback">Back</p></a>
            <h2 class="logintxt">Create an account</h2>
            <?php if(isset($_GET['error'])) { ?>
                <p class="error" id="error"> <?php echo $_GET['error']; ?></p>
            <?php } ?>
            
                <label> Username </label>
                <input type="text" name="username" placeholder="Enter username"><br/>
            
                <label> Email </label>
                <input type="email" name="email" id="email" placeholder="Enter email"><br/>
            
                <label> Password </label>
                <input type="password" name="password" id="password" placeholder="Enter password"><br/>

                <label> Re-enter Password </label>
                <input type="password" name="repassword" id="repassword" placeholder="Re-enter password"><br/>
            
            <button type="submit">Register</button>
        </table>

    </form>
    
</body>
</html>