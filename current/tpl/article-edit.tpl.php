


<html>
    <body>
        <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
            <?php if (isset($errorsArray['articleTitle'])) { ?>
                <div><?php echo $errorsArray['articleTitle']; ?></div>
            <?php } ?>
            title: <input type="text" name="articleTitle" value="<?php echo (isset($dataArray['articleTitle']) ? $dataArray['articleTitle'] : ''); ?>"/><br>
            content: <textarea name="articleContent"><?php echo (isset($dataArray['articleContent']) ? $dataArray['articleContent'] : ''); ?></textarea><br>
            author: <input type="text" name="articleAuthor" value="<?php echo (isset($dataArray['articleAuthor']) ? $dataArray['articleAuthor'] : ''); ?>"/><br>
            date: <input type="text" name="articleDate" value="<?php echo (isset($dataArray['articleDate']) ? $dataArray['articleDate'] : ''); ?>"/><br>
            <input type="hidden" name="articleID" value="<?php echo (isset($dataArray['articleID']) ? $dataArray['articleID'] : ''); ?>"/>
            <input type="submit" name="Save" value="Save"/>
            <input type="submit" name="Cancel" value="Cancel"/>            
        </form>        
    </body>
</html>