<?php 
    include('./header.php'); 
    require_once('./lib/db_login.php');
?>
<div class="card mt-5">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" href="view_book.php">Data</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="kategori.php">Kategori</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="catalog.php">Katalog</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="show_cart.php">Keranjang</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="statistik.php">Statistik</a>
        </li>
    </ul>
    <div class="card-header">Data Kategories</div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Category</th>
                <th>ISBN</th>
                <th>Title</th>
                <th>Author</th>
                <th>Price</th>
            </tr>
            <?php
            $countQuery = "SELECT category, COUNT(*) AS count FROM books GROUP BY category ORDER BY category";
            $resultCount = $db->query($countQuery);
            if (!$resultCount) {
                die("Could not query the database: <br />" . $db->error . "<br>Query: " . $countQuery);
            }

            while ($rowCategory = $resultCount->fetch_assoc()) {
                $category = $rowCategory['category'];
                $count = $rowCategory['count'];

                $dataQuery = "SELECT isbn, title, author, price FROM books WHERE category = '$category'";
                $resultData = $db->query($dataQuery);

                if (!$resultData) {
                    die("Could not query the database: <br />" . $db->error . "<br>Query: " . $dataQuery);
                }

                echo '<tr>';
                echo '<td rowspan="' . $count . '">' . $category . '</td>';

                while ($rowData = $resultData->fetch_object()) {
                    echo '<td>' . $rowData->isbn . '</td>';
                    echo '<td><a href="detail.php?isbn=' . $rowData->isbn . '">' . $rowData->title . '</a></td>';
                    echo '<td>' . $rowData->author . '</td>';
                    echo '<td>$' . $rowData->price . '</td>';
                    echo '</tr>';
                }
            }

            $resultCount->free();
            ?>
        </table>
        <br />
        <?php
        echo 'Total Groups = ' . $resultData->num_rows-1;
        ?>
    </div>
</div>
<?php include('./footer.php') ?>
