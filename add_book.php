<?php

include('./header.php');    

require_once('./lib/db_login.php');

if (isset($_POST["submit"])) {
    $valid = TRUE;

    $isbn = test_input($_POST['isbn']);
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
    $category = $_POST['category'];
    if ($category == '' || $category == 'none') {
        $error_category = "Category is required";
        $valid = FALSE;
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
    } elseif(!preg_match("/^[0-9][0-9]{0,10}$/", $price)) {
        $error_price = "Price hanya dapat berisi angka";
        $valid = FALSE;
    }

    if($valid) {
        $query = "INSERT into books (isbn, title, category, author, price) VALUES ('".$isbn."', '".$title."', '".$category."', '".$author."', '".$price."');";
        $result = $db->query($query);
        echo $query;
        if(!$result) {
            die("Could not query the database: <br />".$db->error);
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
    <div class="card-header">Add Customer Data</div>
    <div class="card-body">
        <form action="" method="POST" autocomplete="on">
            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <input type="text" class="form-control" id="isbn" name="isbn" value="<?php if(isset($_POST['isbn'])) {echo $_POST['isbn'];} ?>">
                <div class="text-danger"><?php if (isset($error_isbn)) echo $error_isbn ?></div>
            </div>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php if(isset($_POST['title'])) {echo $_POST['title'];} ?>">
                <div class="text-danger"><?php if (isset($error_title)) echo $error_title ?></div>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="none" <?php if (!isset($category)) echo 'selected' ?>>--Select a Category--</option>
                    <option value="Airport West" <?php if (isset($category) && $category == "Airport West") echo 'selected' ?>>Airport West</option>
                    <option value="Box Hill" <?php if (isset($category) && $category == "Box Hill") echo 'selected' ?>>Box Hill</option>
                    <option value="Yarraville" <?php if (isset($category) && $category == "Yarraville") echo 'selected' ?>>Yarraville</option>
                </select>
                <div class="text-danger"><?php if (isset($error_category)) echo $error_category ?></div>
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" class="form-control" id="author" name="author" value="<?php if(isset($_POST['author'])) {echo $_POST['author'];} ?>">
                <div class="text-dannger"><?php if (isset($error_author)) echo $error_author ?></div>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="price" name="price" value="<?php if(isset($_POST['price'])) {echo $_POST['price'];} ?>">
                <div class="text-danger"><?php if (isset($error_price)) echo $error_price ?></div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
            <a href="view_book.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
<?php include('./footer.php') ?>