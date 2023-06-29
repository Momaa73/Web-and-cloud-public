<?php 
    // create a mySQL DB connection:
    include "db.php";

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    // testing connection success
    if(mysqli_connect_errno()) {
        die("DB connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")" );
    }
?>

<?php 
    // get data from DB
    $bookId = $_GET["bookId"];
    $query  = "SELECT * FROM tbl_77_books where book_id=" . $bookId;
    // echo $query;

    $result = mysqli_query($connection, $query);
    if($result) {
        $row = mysqli_fetch_assoc($result); // there is only 1 item with id=X
    }
    else die("DB query failed.");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">  
        <title>form for new or update</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php
        echo    '<div class="container"> ';
        echo    '<div class="card" style="width: 30rem;">';
        echo        '<img src="' .$row["first_image"].'"class="card-img-top" alt="...">';
        echo        '<img src="' .$row["second_image"].'"class="card-img-top" alt="...">';
        echo        '<div class="card-body">';
        echo            '<h2 class="card-title">' .$row["book_name"]. '</h2>';
        echo            '<h4 class="list-group-item">Price: ' .$row["price"]. '</h4>';
        echo            '<h4 class="list-group-item">Author: ' .$row["author"]. '</h4>';
        echo            '<h4 class="list-group-item">Category: ' .$row["category"]. '</h4>';
        echo            '<a href="bookstore.php" class="btn btn-primary">Back to store</a>';
        echo        '</div>';
        echo    '</div>';
    ?>
            <?php 
                // release returned data
                mysqli_free_result($result);
            ?>
        </div>
    </body>
</html>

<?php
    // close DB connection
    mysqli_close($connection);
?>
