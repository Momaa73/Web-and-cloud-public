<!DOCTYPE html>
<html lang="en">
    <head>
        <title>form sent</title>
    </head>
    <body>
        <h2>You chose the  name "<?php echo $_GET["playlistName"]; ?>" for your playlist</h2>
        <?php
            $fn = $_GET["rate"];
            if($fn != 1 && $fn != 2 && $fn != 3 && $fn != 4 && $fn != 5){
                echo "<h2>You needed to pick a number between 1-5</h2>"; 
            }
            else{
                echo "<h2>Your rate is " .$fn . "</h2>";
            }
            $fl = $_GET["liked"];
            if($fl == 1){
                echo "<h2>You liked this song!</h2>";
            }
            else if($fl == 2){
                echo "<h2>You didn't like this song!</h2>";
            }
            else{
                echo "<h2>you needed to choose if you liked this song</h2>";
            }
        ?>
    </body>
</html>