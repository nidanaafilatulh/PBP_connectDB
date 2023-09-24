<?php
require_once('./lib/db_login.php');

// Get form inputs
$searchKeyword = $db->real_escape_string($_POST['search']);
$category = $db->real_escape_string($_POST['category']);
$minPrice = $db->real_escape_string($_POST['minprice']);
$maxPrice = $db->real_escape_string($_POST['maxprice']);

// Build SQL query based on form inputs
$query = "SELECT * FROM books b LEFT JOIN categories c ON b.categoryid = c.categoryid WHERE 1=1";

if (!empty($searchKeyword)) {
    $query .= " AND (title LIKE '%$searchKeyword%' OR author LIKE '%$searchKeyword%' OR isbn LIKE '%$searchKeyword%')";
}

if (!empty($category)) {
    $query .= " AND 'name' = '$category'";
    echo $query;
}

if (!empty($minPrice)) {
    $query .= " AND price >= $minPrice";
}

if (!empty($maxPrice)) {
    $query .= " AND price <= $maxPrice";
}

$query .= " ORDER BY isbn";

// Execute the query and return the filtered results as HTML
$result = $db->query($query);
if (!$result) {
    die("Could not query the database: <br />" . $db->error . "<br>Query: " . $query);
}

?>

<table class="table table-striped">
            <tr>
                <th>ISBN</th>
                <th>Title</th>
                <th>Category</th>
                <th>Author</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            <?php
            // Fetch and display the results
            $i = 1;
            while ($row = $result->fetch_object()) {
                echo '<tr>';
                echo '<td>' . $row->isbn . '</td>';
                echo '<td><a href="detail.php?isbn='.$row->isbn.'">' . $row->title . '</a></td>';
                echo '<td>' . $row->name . '</td>';
                echo '<td>' . $row->author . '</td>';
                echo '<td>$' . $row->price . '</td>';
                echo '<td><a class="btn btn-warning btn-sm" href="edit_book.php?isbn='.$row->isbn.'">Edit</a> '.' <a class="btn btn-danger btn-sm" href="delete_book.php?isbn='.$row->isbn.'">Delete</a></td>';
                echo '</tr>';
                $i++;
            }
            echo '</table>';
            echo '<br />';
            echo 'Total Rows = ' . $result->num_rows;

            $result->free();
            $db->close();
            ?>
</table> 
