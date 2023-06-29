<?php
	include "db.php";

	$query = "SELECT * FROM tbl_77_books";
	$result = mysqli_query($connection, $query);
	if (!$result) {
		die("Can't connect to the database");
	}

	$jsonData = file_get_contents('data/books.json');
	$data = json_decode($jsonData, true);
	if ($data) {
		$categories = $data['category'];
	} else {
		echo 'Unable to decode JSON data.';
		exit;
	}

	$category_filter = isset($_GET['category']) ? $_GET['category'] : 'all';
	$filtered_bookslist = [];

    if ($category_filter && $category_filter !== 'all' && isset($categories[$category_filter])) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['category'] === $categories[$category_filter]) {
                $filtered_bookslist[] = $row;
            }
        }
    }
    else {
        while ($row = mysqli_fetch_assoc($result)) {
            $filtered_bookslist[] = $row;
        }
    }
    
?>

<!DOCTYPE html>
<html>
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	<title>Books List</title>
</head>
<body>
	<div class="container col-md-9">
		<h1>Moran's Books Store</h1>
		<h2>My Favorite Books</h2>

		<div class="dropdown">
			<button class="btn btn-secondary dropdown-toggle" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
				Select Category
			</button>
			<ul class="dropdown-menu" aria-labelledby="categoryDropdown" id="categoryList">
				<li><a class="dropdown-item" href="?category=all">All</a></li>
				<?php
					foreach ($categories as $category => $categoryName) {
						echo '<li><a class="dropdown-item" href="?category='.$category.'">'.$categoryName.'</a></li>';
					}
				?>
			</ul>
		</div>

		<div id="filtered_bookslist$filtered_bookslistContainer">
			<?php
				foreach ($filtered_bookslist as $row) {
					echo '<div class="card" style="width: 30rem;">';
					echo '<img src="'.$row["first_image"].'" class="card-img-top" alt="...">';
					echo '<div class="card-body">';
					echo '<h5 class="card-title">'.$row["book_name"].'</h5>';
					echo '</div>';
					echo '<ul class="list-group list-group-flush">';
					echo '<li class="list-group-item">Price: '.$row["price"].'</li>';
					echo '</ul>';
					echo '<div class="card-body">';
					echo '<a href="bookpage.php?bookId='.$row["book_id"].'" class="card-link">See Book Details</a>';
					echo '</div>';
					echo '</div>';
				}
			?>
		</div>
	</div>
</body>
</html>
<?php
	mysqli_close($connection)
?>