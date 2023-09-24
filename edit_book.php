<?php

include('./header.php');    

// TODO 1: Lakukan koneksi dengan database
require_once('./lib/db_login.php');

// TODO 2: Buat variabel $id yang diambil dari query string parameter
$isbn = $_GET['isbn'];

// Memeriksa apakah user belum menekan tombol submit
if (!isset($_POST["submit"])) {
    // TODO 3: Tulislah dan eksekusi query untuk mengambil informasi customer berdasarkan id
    $query = "SELECT * FROM categories c LEFT JOIN books b ON c.categoryid = b.categoryid WHERE b.isbn='$isbn'";
    $result = $db->query($query);
    if(!$result) {
        die("Could not query the database: <br />".$db->error);
    } else {
        while($row = $result->fetch_object()){
            $isbn = $row->isbn;
            $title = $row->title;
            $categoryid = $row->categoryid;
            $category = $row->name;
            $author = $row->author;
            $price = $row->price;
        }
    }
    

} else {
    $valid = TRUE;

    $isbn = test_input($_GET['isbn']);
    if($isbn == '') {
        $error_isbn = "ISBN harus diisi";
        $valid = FALSE;
    } elseif (!preg_match("/^\d{1,}-\d{1,3}-\d{1,5}-\d{1,}$/", $isbn)) {
        $error_isbn = "Gunakan format ISBN yang benar";
        $valid = FALSE;
    }

    // Validasi terhadap field address
    $title = test_input($_POST['title']);
    if ($title == '') {
        $error_title = "title is required";
        $valid = FALSE;
    }

    // Validasi terhadap field city
    $category_name = $_POST['category'];
    if ($category_name == '' || $category_name == 'none') {
        $error_category = "Category is required";
        $valid = FALSE;
    } else {
        // Temukan categoryid berdasarkan nama kategori yang diinput
        $category_query = "SELECT categoryid FROM categories WHERE name='$category_name'";
        $category_result = $db->query($category_query);
        if (!$category_result) {
            die("Could not query the database: <br />" . $db->error);
        } else {
            $category_row = $category_result->fetch_object();
            $categoryid = $category_row->categoryid;
        }
    }

    $author = $_POST['author'];
    if ($author == '' || $author == 'none') {
        $error_author = "author is required";
        $valid = FALSE;
    }

    $price = $_POST['price'];
    if ($price == '' || $price == 'none') {
        $error_price = "price is required";
        $valid = FALSE;
    } elseif (!preg_match("/^\d+(\.\d{1,2})?$/", $price)) {
        $error_price = "Price hanya dapat berisi angka dan maksimal 2 digit di belakang koma";
        $valid = FALSE;
    }

    // Update data into database
    if ($valid) {
        // TODO 4: Jika valid, update data pada database dengan mengeksekusi query yang sesuai
        $query = "UPDATE books SET title='".$title."', categoryid='".$categoryid."', author='".$author."', price='".$price."' WHERE isbn='$isbn'";
        $result = $db->query($query);
        $echo = $query;
        if(!$result) {
            die("Could not query the database: <br />".$db->error."<br>Query: ".$query);
        } else {
            $db->close();
            header('Location: view_book.php');
        }
    }
}
?>
<?php include('./header.php') ?>
<br>
<div class="card mt-4">
    <div class="card-header">Edit Book Data</div>
    <div class="card-body">
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . '?isbn=' . $isbn ?>" method="POST" autocomplete="on">
            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <input type="text" class="form-control" id="isbn" name="isbn" value="<?= $isbn; ?>" disabled>
                <div class="text-danger"><?php if (isset($error_isbn)) echo $error_isbn ?></div>
            </div>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $title; ?>">
                <div class="text-danger"><?php if (isset($error_title)) echo $error_title ?></div>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="none" <?php if (!isset($category)) echo 'selected' ?>>--Select a Category--</option>
                    <option value="Education" <?php if (isset($category) && $category == "Education") echo 'selected' ?>>Education</option>
                    <option value="Fiction" <?php if (isset($category) && $category == "Fiction") echo 'selected' ?>>Fiction</option>
                    <option value="Motivation" <?php if (isset($category) && $category == "Motivation") echo 'selected' ?>>Motivation</option>
                    <option value="Romance" <?php if (isset($category) && $category == "Romance") echo 'selected' ?>>Romance</option>
                </select>
                <div class="text-danger"><?php if (isset($error_category)) echo $error_category ?></div>
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" class="form-control" id="author" name="author" value="<?= $author; ?>">
                <div class="text-danger"><?php if (isset($error_author)) echo $error_author ?></div>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="price" name="price" value="<?= $price; ?>">
                <div class="text-danger"><?php if (isset($error_price)) echo $error_price ?></div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
            <a href="view_book.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
<?php include('./footer.php') ?>
<?php
$db->close();
?>