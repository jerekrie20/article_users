<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get User</title>
</head>
<body>
    <h1>Get User(s)</h1>
    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
            <select name="getUserList" id="getUserList">
                <option value="one">My User Only</option>
                <option value="all">All Users Only</option>
            </select>
            <input type="submit" name="Save" value="Save"/>
            <input type="submit" name="Cancel" value="Cancel"/>            
    </form> 
    <br>
    <h3>
        <?php // convert the array to json
            echo json_encode($userArray); 
        ?>
    </h3>       
</body>
</html>