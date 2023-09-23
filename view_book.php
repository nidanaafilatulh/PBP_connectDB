<?php 
    include('./header.php');
    require_once('./lib/db_login.php');
?>
<div class="card mt-5">
    <div class="card-header">Books Data</div>
    <div class="card-body">'
        <div class="d-flex align-items-center mb-3">
            <a href="add_book.php" class="btn btn-primary">+ Add Book Data</a>
            <form action="" class="form-groupm mx-2">
                <label for="">cari</label>
                <input type="text" name="search" id="search" class="form-check">
            </form>
        </div>
        
            
        </form>
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
            $query = "SELECT * FROM books ORDER BY isbn";
            
            $result = $db->query($query);
            if (!$result) {
                die("Could not query the database: <br />" . $db->error . "<br>Query: " . $query);
            }

            // Fetch and display the results
            $i = 1;
            while ($row = $result->fetch_object()) {
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
            echo 'Total Rows = ' . $result->num_rows;

            $result->free();
            $db->close();
            ?>
    </div>
</div>
<?php include('./footer.php') ?>