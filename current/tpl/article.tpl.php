<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Results</title>
    <style>
       .cell {
		float: left;
		width: 15%;
		border: 1px solid black;
	}
        a{
            margin-right: 1em;
        }
    </style>
</head>
<body>
    <h1><a href="article-edit.php">Add An Article</a> </h1>
    <div style="display: block;">
            <!-- header info -->
            <div>
                <div class="cell">Article Title</div>
                <div class="cell">Article Author</div>
                <div class="cell">Article Date</div>
                <div class="cell">&nbsp;</div>
                <div class="cell">&nbsp;</div>
            </div>
    <?php
    foreach($allArticles as $row){
        ?>
    
    <!--
      
    -->
        <div style="clear:both;">
                    <div class="cell"><?php echo $row['articleTitle']; ?></div>
                    <div class="cell"><?php echo $row['articleAuthor']; ?></div>
                    <div class="cell"><?php echo $row['articleDate']; ?></div>
                    <div class="cell"><a href="article-edit.php?articleID=<?php echo $row['articleID']; ?>">Edit</a></div>
                    <div class="cell"><a href="article-view.php?articleID=<?php echo $row['articleID']; ?>">View</a></div>
        </div>
    <?php
    }
    ?>
    </div>
    
</body>
</html>