<?php include('header.php'); ?>

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
            <a class="nav-link" href="order.php">Order</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="statistik.php">Statistik</a>
        </li>
    </ul>
    <div class="card-header">Data Pesanan</div>
    <div class="card-body">
        <!-- Filter Form -->
        <form method="POST">
            <div class="form-row w-50 d-flex">
                <div class="col  mx-2">
                    <label for="start_date">Tanggal Awal</label>
                    <input type="date" class="form-control" id="start_date" name="start_date">
                </div>
                <div class="col mx-2">
                    <label for="end_date">Tanggal Akhir</label>
                    <input type="date" class="form-control" id="end_date" name="end_date">
                </div>
                <div class="col mx-2">
                    <br>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <!-- Tabel Data Pesanan -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No Order</th>
                    <th>Tanggal</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mengambil data pesanan dari database berdasarkan filter tanggal
                require_once('./lib/db_login.php');

                // Inisialisasi filter tanggal
                $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
                $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';

                // Query untuk mengambil data pesanan berdasarkan filter tanggal
                $query = "SELECT * FROM orders WHERE 1";

                if (!empty($start_date) && !empty($end_date)) {
                    $query .= " AND date BETWEEN '$start_date' AND '$end_date'";
                }

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
                    echo "</tr>";
                }

                // Tutup koneksi database jika sudah tidak digunakan.
                $db->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('footer.php'); ?>
