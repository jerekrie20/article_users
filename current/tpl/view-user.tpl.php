<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>

    <style>
        div{
            margin: auto;
            font-size: 18px;
            margin-bottom: 2em;
            border: 2px solid black;
        }
    </style>

</head>


<body>
    <?php
        foreach($dataArray as $row){
    ?>
        <div>
        <!-- --> 
        
            UserName: <?php echo (isset($row['username']) ? $row['username'] : ''); ?><br>
            Password: <?php echo (isset($row['userpassword']) ? $row['userpassword'] : ''); ?><br>
            Level: <?php echo (isset($row['user_level']) ? $row['user_level'] : ''); ?><br>
            Image: <img src="images/<?php echo $row['username'] ?>_user.jpg" alt="Userimage"><br>
        </div>
    <?php
        }
    ?>
       
    
    
</body>

</html>


