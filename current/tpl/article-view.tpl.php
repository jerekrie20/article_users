<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article View</title>

    <style>
        div{
            margin: auto;
            font-size: 18px;
        }
    </style>

</head>


<body>
    <div>
        title: <?php echo (isset($dataArray['articleTitle']) ? $dataArray['articleTitle'] : ''); ?><br>
        content: <?php echo (isset($dataArray['articleContent']) ? $dataArray['articleContent'] : ''); ?><br>
        author: <?php echo (isset($dataArray['articleAuthor']) ? $dataArray['articleAuthor'] : ''); ?><br>
        date: <?php echo (isset($dataArray['articleDate']) ? $dataArray['articleDate'] : ''); ?><br>
    </div>
       
    
    
</body>

</html>


