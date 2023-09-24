<?php 
    include('./header.php');
    require_once('./lib/db_login.php');
?>

<div class="card mt-5">
    <ul class="nav nav-pills">    
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
            <a class="nav-link" href="order.php">Order</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="statistik.php">Statistik</a>
        </li>
    </ul>
    <div class="card-header">Books Data</div>
    <div class="card-body">
        <div class="d-flex align-items-center mb-3">
            <a href="add_book.php" class="btn btn-primary">+ Add Book Data</a>
            <!-- <form action="" class="form-groupm mx-z" method="post">
                <input type="text" name="search" id="search" class="form-check" autofocus placeholder="Masukkan keyword"><br>
                <select id="categoryFilter">
                    <option value="">--Select a Category--</option>
                    <option value="Romance">Romance</option>
                    <option value="Motivation">Motivation</option>
                    <option value="Education">Education</option>
                </select>
                <div id="filteredResults"></div>
                <input 
                    type="number" id="form1" class="form-control" 
                    style="min-width: 100px;" 
                    name="minprice" id="minprice" placeholder="Minimum Price" min="0" 
                    step="0.01"  pattern="^\d+(?:\.\d{1,2})?$" 
                    value=""/>

                <input 
                    type="number" 
                    id="form1" 
                    class="form-control" 
                    style="min-width: 100px;" 
                    name="maxprice" id="maxprice" 
                    placeholder="Maximum Price" min="0" step="0.01"  
                    pattern="^\d+(?:\.\d{1,2})?$" 
                    value=""/>
                <button type="submit" class="btn btn-primary" value="submit">Submit
            </form> -->
            <form action="filter_books.php" method="post" id="filterForm">
                <input type="text" name="search" id="search" class="form-check" autofocus placeholder="Masukkan keyword"><br>
                <select id="categoryFilter" name="category">
                    <option value="">--Select a Category--</option>
                    <option value="Romance">Romance</option>
                    <option value="Motivation">Motivation</option>
                    <option value="Education">Education</option>
                </select>
                <input
                    type="number"
                    class="form-control"
                    style="min-width: 100px;"
                    name="minprice"
                    id="minprice"
                    placeholder="Minimum Price"
                    min="0"
                    step="0.01"
                    pattern="^\d+(?:\.\d{1,2})?$"
                    value=""
                />
                <input
                    type="number"
                    class="form-control"
                    style="min-width: 100px;"
                    name="maxprice"
                    id="maxprice"
                    placeholder="Maximum Price"
                    min="0"
                    step="0.01"
                    pattern="^\d+(?:\.\d{1,2})?$"
                    value=""
                />
                <button type="submit" class="btn btn-primary" value="submit">Submit</button>
            </form>
        </div>
        <div id="container">
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
            $query = "SELECT * FROM categories c LEFT JOIN books b ON c.categoryid = b.categoryid ORDER BY b.isbn";
            
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
                echo '<td>' . $row->name . '</td>';
                echo '<td>' . $row->author . '</td>';
                echo '<td>$' . $row->price . '</td>';
                echo '<td><a class="btn btn-warning btn-sm m-1" href="edit_book.php?isbn='.$row->isbn.'">Edit</a> '.' <a class="btn btn-danger btn-sm" href="delete_book.php?isbn='.$row->isbn.'">Delete</a></td>';
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
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<!-- <script src="ajax.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="script.js"></script>
<?php include('./footer.php') ?>