<style type="text/css">
	.cell {
		float: left;
		width: 15%;
		border: 1px solid black;
	}
</style>
<html>
    <body>
        <div>Users Report</div>        
		<a href="<?= $_SERVER['SCRIPT_NAME']; ?>?download=1&<?= $_SERVER["QUERY_STRING"]; ?>">Download Report</a><br><br>	 

        <div>
            <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="GET">
                Filter: 
                <select name="filterColumn">
                    <option value="username">User Name</option>
                    <option value="user_level">User level</option>                 
                </select>
                &nbsp;<input type="text" name="filterText"/>
                &nbsp;<input type="submit" name="btnViewReport" value="View Report"/>
            </form>
        </div>

        <?php if (count($userList) > 0){ ?>

        <div>
            <table border="1">
                <tr>
                    <th>User Name</th>
                    <th>User Password</th>
                    <th>User Level</th>
                    <th>User Image</th>  
                </tr>
                <?php foreach ($userList as $userData) { ?>
                    <tr>
                        <td><?php echo $userData['username']; ?></td>                
                        <td><?php echo $userData['userpassword']; ?></td>                
                        <td><?php echo $userData['user_level']; ?></td> 
                        <td><img src="images/<?php echo $userData['username'] ?>_user.jpg" alt="Userimage"><br></td>                           
                    </tr>
                <?php } ?>                
            </table>
            <a href="<?= $_SERVER['SCRIPT_NAME']; ?>?<?= $backPageLink; ?>">Back</a>
			
            &nbsp;|&nbsp;
            <a href="<?= $_SERVER['SCRIPT_NAME']; ?>?<?= $nextPageLink; ?>">Next Page</a>				
        </div>
		<?php } ?>
                
    </body>
    
</html>