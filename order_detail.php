<?php include('header.php') ?>

<div class="card mt-5">
    <ul class="nav">
        <!-- Daftar menu navigasi -->
    </ul>
    <div class="card-header">Data Pesanan</div>
    <div class="card-body">
        <!-- Tabel Data Pesanan -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No Order</th>
                    <th>Tanggal</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mengambil data pesanan dari database
                require_once('./lib/db_login.php');
                $query = "SELECT * FROM orders";
                $result = $db->query($query);

                if (!$result) {
                    die("Could not query the database: " . $db->error);
                }

                // Menampilkan data pesanan dalam tabel
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['orderid'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>$" . $row['amount'] . "</td>";
                    echo "<td><a href='detail_order.php?orderid=" . $row['orderid'] . "'>Detail</a></td>";
                    echo "</tr>";
                }

                // Tutup koneksi database jika sudah tidak digunakan.
                $db->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="card mt-5">
    <div class="card-header">Detail Pesanan</div>
    <div class="card-body">
        <?php
        // Periksa apakah orderid telah diberikan melalui parameter URL
        if (isset($_GET['orderid'])) {
            $orderid = $_GET['orderid'];

            // Mengambil data pesanan berdasarkan orderid dari database
            $query = "SELECT * FROM orders WHERE orderid='$orderid'";
            $result = $db->query($query);

            if ($result) {
                $order = $result->fetch_assoc();

                // Menampilkan detail pesanan
                echo "<h4>No Order: " . $order['orderid'] . "</h4>";
                echo "<p>Tanggal: " . $order['date'] . "</p>";
                echo "<p>Total Amount: $" . $order['amount'] . "</p>";

                // Mengambil data order_items berdasarkan orderid
                $query = "SELECT oi.isbn, oi.quantity, b.title, b.price FROM order_items oi
                          JOIN books b ON oi.isbn = b.isbn
                          WHERE oi.orderid='$orderid'";
                $result = $db->query($query);

                if ($result->num_rows > 0) {
                    echo "<h5>Daftar Produk yang Dipesan:</h5>";
                    echo "<table class='table table-striped'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>ISBN</th>";
                    echo "<th>Title</th>";
                    echo "<th>Price</th>";
                    echo "<th>Qty</th>";
                    echo "<th>Total</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['isbn'] . "</td>";
                        echo "<td>" . $row['title'] . "</td>";
                        echo "<td>$" . $row['price'] . "</td>";
                        echo "<td>" . $row['quantity'] . "</td>";
                        echo "<td>$" . ($row['price'] * $row['quantity']) . "</td>";
                        echo "</tr>";
                    }

                    echo "</tbody>";
                    echo "</table>";
                } else {
                    echo "<p>Tidak ada produk yang dipesan.</p>";
                }
            } else {
                echo "<p>Data pesanan tidak ditemukan.</p>";
            }
        } else {
            echo "<p>No Order tidak ditemukan.</p>";
        }

        // Tutup koneksi database jika sudah tidak digunakan.
        $db->close();
        ?>
    </div>
</div>

<?php include('footer.php') ?>
