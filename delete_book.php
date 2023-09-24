<?php

include('./header.php');   
// TODO 1: Lakukan koneksi dengan database
require_once('./lib/db_login.php');

// TODO 2: Buat variabel $id yang diambil dari query string parameter
$isbn = $_GET['isbn'];

// Memeriksa apakah user belum menekan tombol submit
if (!isset($_POST["submit"]))  {
  $query = "SELECT * FROM categories c LEFT JOIN books b ON c.categoryid = b.categoryid WHERE b.isbn='$isbn'";
    $result = $db->query($query);
    if(!$result) {
        die("Could not query the database: <br />".$db->error);
    } else {
        while($row = $result->fetch_object()){
            $isbn = $row->isbn;
            $title = $row->title;
            $category = $row->name;
            $author = $row->author;
            $price = $row->price;
        }
    }
} else {
    $query = "DELETE FROM books WHERE isbn='$isbn'";
    $result = $db->query($query);
    if(!$result) {
        die("Could not query the database: <br />".$db->error."<br>Query: ".$query);
    } else {
        $db->close();
        header('Location: view_book.php');
    }
    
}
?>
<?php include('./header.php') ?>
<br>
<div class="card mt-4">
    <div class="card-header">Delete Book Data</div>
    <div class="card-body">
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . '?isbn=' . $isbn ?>" method="POST" autocomplete="on">
            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <input type="text" class="form-control" id="isbn" name="isbn" value="<?= $isbn; ?>" disabled>
                <div class="text-danger"><?php if (isset($error_isbn)) echo $error_isbn ?></div>
            </div>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $title; ?>" disabled>
                <div class="text-danger"><?php if (isset($error_title)) echo $error_title ?></div>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select name="category" id="category" class="form-control" required disabled>
                    <option value="none" <?php if (!isset($category)) echo 'selected' ?>>--Select a Category--</option>
                    <option value="Education" <?php if (isset($category) && $category == "Education") echo 'selected' ?>>Education</option>
                    <option value="Motivation" <?php if (isset($category) && $category == "Motivation") echo 'selected' ?>>Motivation</option>
                    <option value="Romance" <?php if (isset($category) && $category == "Romance") echo 'selected' ?>>Romance</option>
                </select>
                <div class="text-danger"><?php if (isset($error_category)) echo $error_category ?></div>
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" class="form-control" id="author" name="author" value="<?= $author; ?>" disabled>
                <div class="text-dannger"><?php if (isset($error_author)) echo $error_author ?></div>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="price" name="price" value="<?= $price; ?>" disabled>
                <div class="text-dannger"><?php if (isset($error_price)) echo $error_price ?></div>
            </div>
            <br>
            <button type="submit" class="btn btn-danger" name="submit" value="submit">Delete</button>
            <a href="view_book.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
<?php include('./footer.php') ?>
<?php
$db->close();
?>