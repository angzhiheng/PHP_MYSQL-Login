<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="login.php" method="post">
        <table>
            <a class="back" href="index.php"><image class="back-btn" src="svg/arrow-left.svg"/><p class="pback">Back</p></a>
            <h2 class="logintxt">Login</h2>
            <?php if(isset($_GET['error'])) { ?>
                <p class="error"> <?php echo $_GET['error']; ?></p>
            <?php } ?>
            
                <label> Username </label>
                <input type="text" name="username" placeholder="Enter username"><br/>
            
            
                <label> Password </label>
                <input type="password" name="password" placeholder="Enter password"><br/>
            
            <button type="submit">Login</button>
        </table>

    </form>
    
</body>
</html>