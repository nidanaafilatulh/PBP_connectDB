<?php
session_start();
error_reporting(0);

$id = $_GET['id'];
if ($id != '') {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }
}
?>

<?php include('./header.php') ?>

<?php
if (isset($_POST['submit'])) {
    require_once('./lib/db_login.php');
    $sum_qty = 0;
    $sum_price = 0;

    if (is_array($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $isbn => $qty) {
            // Lakukan query untuk memasukkan data ke dalam tabel order_items
            $query = "INSERT INTO order_items (isbn, quantity) VALUES ('$isbn', '$qty');";
            $result = $db->query($query);

            if (!$result) {
                die("Could not query the database: <br />" . $db->error . "<br>Query: " . $query);
            }

            // Hitung jumlah total item dan harga total
            $sum_qty += $qty;
            $query = "SELECT price FROM books WHERE isbn = '$isbn'";
            $result = $db->query($query);
            $row = $result->fetch_assoc();
            $sum_price += $row['price'] * $qty;
        }

        // Setelah selesai memasukkan semua data, Anda dapat mengosongkan session cart jika diperlukan.
        unset($_SESSION['cart']);

        // Masukkan data pesanan ke dalam tabel "orders"
        // Anda perlu menyesuaikan "customerid" sesuai dengan cara Anda mengidentifikasi pelanggan
        $customerid = $_SESSION['customerid']; // Misalnya, Anda menyimpan customerid di sesi
        $date = date("Y-m-d");
        $insert_order_query = "INSERT INTO orders (customerid, amount, date) VALUES ('$customerid', '$sum_price', '$date')";
        $insert_order_result = $db->query($insert_order_query);

        if (!$insert_order_result) {
            die("Could not query the database: <br />" . $db->error . "<br>Query: " . $insert_order_query);
        }

        $orderid = $db->insert_id; // Ambil ID pesanan yang baru saja dibuat

        // Masukkan data item pesanan ke dalam tabel "order_items"
        foreach ($_SESSION['cart'] as $isbn => $qty) {
            $insert_order_item_query = "INSERT INTO order_items (orderid, isbn, quantity) VALUES ('$orderid', '$isbn', '$qty')";
            $insert_order_item_result = $db->query($insert_order_item_query);

            if (!$insert_order_item_result) {
                die("Could not query the database: <br />" . $db->error . "<br>Query: " . $insert_order_item_query);
            }
        }

        // Tutup koneksi database jika sudah tidak digunakan.
        $db->close();

        // Jika perlu, Anda dapat mengarahkan pengguna ke halaman "success.php" atau halaman lain yang sesuai.
        header('Location: success.php');
    }
}
?>

<br>
<div class="card mt-4">
<ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="view_book.php">Data</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="kategori.php">Kategori</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="catalog.php">Katalog</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="show_cart.php">Keranjang</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="order.php">Order</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="statistik.php">Statistik</a>
        </li>
</ul>
    <div class="card-header">Shopping Cart</div>
    <div class="card-body">
        <br>
        <table class="table table-striped">
            <tr>
                <th>ISBN</th>
                <th>Author</th>
                <th>Title</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Price * Qty</th>
            </tr>
            <?php
            require_once('./lib/db_login.php');
            $sum_qty = 0;
            $sum_price = 0;

            if (is_array($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $id => $qty) {
                    // TODO 1: Tuliskan dan eksekusi query
                    $query = "SELECT * FROM books WHERE isbn='$id'";
                    $result = $db->query($query);
                    if(!$result){
                        die("Could not query the database: <br />".$db->error."<br>Query: ".$query);
                    }

                    while ($row = $result->fetch_object()) {
                        echo '<tr>';
                        echo '<td>' . $row->isbn . '</td>';
                        echo '<td>' . $row->author . '</td>';
                        echo '<td>' . $row->title . '</td>';
                        echo '<td>$' . $row->price . '</td>';
                        echo '<td>' . $qty . '</td>';
                        echo '<td>$' . $row->price * $qty . '</td>';
                        echo '</tr>';

                        $sum_qty = $sum_qty + $qty;
                        $sum_price = $sum_price + ($row->price * $qty);
                    }
                }
            }
            
            if (empty($_SESSION['cart'])) {
                echo '<tr><td colspan="6" align="center">There is no item in shopping cart</td></tr>';
            }
            ?>
        </table>
        Total items = <?php echo $sum_qty ?><br><br>
        <div class="d-flex justify-content-between">
            <div>
                <a class="btn btn-primary" href="catalog.php">Continue Shopping</a>
                <a class="btn btn-danger" href="delete_cart.php">Empty Cart</a>
            </div>
            <div>
                <form method="POST">
                    <button class="btn btn-success" name="submit" type="submit">Checkout</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('./footer.php') ?>
