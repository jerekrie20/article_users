<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login in</title>

    <style>
        h1{
            text-align: center;
            margin-top: 10em;
        }
        section{
            margin: auto;
            text-align: center;
        }
        a{
            text-align: center;
            margin: auto;
            margin-left: 48%;
        }
    </style>
</head>
<body>
    <h1>Sign UP</h1>
    <a href="../public/user-login.php"><button>Login</button></a>
    <section>
    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post" enctype="multipart/form-data">
        <p>
            <label for="userName">UserName</label>
            <input type="text" name="userName" id="user_name" value="" required maxlength="50">
        </p>
        <p>
            <label for="password">PassWord</label>
            <input type="password" id="password" name="password" value="" required maxlength="50">
        </p>
        <p>
            upload file: <input type="file" name="upload_file">
        </p>
        <p>
            <label for="loginKey">Login Key</label>
            <input type="number" name="loginKey" id="login_key" value="">
        </p>
        <p>
            <input type="submit" name="signup" value="signup">
            <input type="reset" name="reset" value="reset">
        </p>

    </form>
    </section>
    
</body>
</html>