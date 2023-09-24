<?php 
    require_once('./lib/db_login.php');
    $category = $_POST['category'];
    $query1 = "SELECT * FROM books WHERE category LIKE '%$category%' ORDER BY isbn";
    $result1 = $db->query($query1);
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
            while ($row = $result1->fetch_object()) {
                echo '<tr>';
                echo '<td>' . $row->isbn . '</td>';
                echo '<td><a href="detail.php?isbn='.$row->isbn.'">' . $row->title . '</a></td>';
                echo '<td>' . $row->category . '</td>';
                echo '<td>' . $row->author . '</td>';
                echo '<td>$' . $row->price . '</td>';
                echo '<td><a class="btn btn-warning btn-sm" href="edit_book.php?isbn='.$row->isbn.'">Edit</a> '.' <a class="btn btn-danger btn-sm" href="delete_book.php?isbn='.$row->isbn.'">Delete</a></td>';
                echo '</tr>';
                $i++;
            }
            echo '</table>';
            echo '<br />';
            echo 'Total Rows = ' . $result1->num_rows;

            $result1->free();
            $db->close();
            ?>
</table>