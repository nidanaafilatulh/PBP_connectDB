<?php include('./header.php') ?>
<script src="https://cdn.syncfusion.com/ej2/dist/ej2.min.js" type="text/javascript"></script>

<br>
<?php require_once('./lib/db_login.php'); ?>
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
            <a class="nav-link" href="show_cart.php">Keranjang</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="order.php">Order</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="statistik.php">Statistik</a>
        </li>
    </ul>
    <div class="card-header">Statistik Buku</div>
    <div class="card-body">
        <div id="container"></div>
        <?php
        $query = "SELECT c.name AS category_name, COUNT(b.isbn) AS book_count FROM categories c LEFT JOIN books b ON c.categoryid = b.categoryid GROUP BY c.categoryid ORDER BY c.name";
        $result = $db->query($query);
        if (!$result) {
            die('Could not query the database: <br/>' . $db->error . '<br>Query:' . $query);
        }

        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = array(
                'category_name' => $row['category_name'],
                'book_count' => (int)$row['book_count']
            );
        }

        //konversi agar bisa digunakan di JS
        $json_data = json_encode($data);

        ?>
        <?php
        $query = "SELECT c.name AS category_name, COUNT(b.isbn) AS book_count FROM categories c LEFT JOIN books b ON c.categoryid = b.categoryid GROUP BY c.categoryid ORDER BY c.name";
        $result = $db->query($query);
        if (!$result) {
            die('Could not query the database: <br/>' . $db->error . '<br>Query:' . $query);
        }

        //array untuk data grafik
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = array(
                'category_name' => $row['category_name'],
                'book_count' => (int)$row['book_count']
            );
        }

        $json_data = json_encode($data);

        ?>
        <script>
            var data = <?php echo $json_data; ?>;
            var categories = [];
            var bookCounts = [];
            for (var i = 0; i < data.length; i++) {
                categories.push(data[i].category_name);
                bookCounts.push(data[i].book_count);
            }

            var chart = new ej.charts.Chart({
                chartArea: {
                    border: {
                        width: 0
                    }
                },
                primaryXAxis: {
                    title: 'Kategori', 
                    valueType: 'Category'
                },
                primaryYAxis: {
                    title: 'Jumlah Buku', 
                    labelFormat: '{value}', 
                    edgeLabelPlacement: 'Shift',
                    interval: 1
                },
                series: [{
                    type: 'Column',
                    dataSource: data,
                    xName: 'category_name',
                    yName: 'book_count',
                    marker: {
                        dataLabel: {
                            visible: true,
                            position: 'Bottom',
                            font: {
                                fontWeight: '600',
                                size:'16px',
                            },
                        }
                    },
                    fill: '#007bff'
                }],
                legendSettings: {
                    visible: false
                },
                title: 'Jumlah data buku pada tiap kategori'
            });

            chart.appendTo('#container');
        </script>
        <br>
        </div>

        <!-- Bagian HTML untuk diagram kedua -->
        <div id="container2"></div>

        <?php
        // Query SQL kedua untuk mengambil jumlah pesanan (quantity) per Kategori
        $query2 = "SELECT c.name AS category_name, SUM(oi.quantity) AS total_quantity 
                FROM categories c 
                LEFT JOIN books b ON c.categoryid = b.categoryid
                LEFT JOIN order_items oi ON b.isbn = oi.isbn
                GROUP BY c.categoryid, c.name 
                ORDER BY c.name";
        $result2 = $db->query($query2);
        if (!$result2) {
            die('Could not query the database: <br/>' . $db->error . '<br>Query:' . $query2);
        }

        // Array untuk data grafik pesanan
        $data2 = array();
        while ($row2 = $result2->fetch_assoc()) {
            $data2[] = array(
                'category_name' => $row2['category_name'],
                'total_quantity' => (int)$row2['total_quantity'] // Menggunakan 'total_quantity' sebagai jumlah pesanan per Kategori
            );
        }

        // Konversi data pesanan menjadi JSON
        $json_data2 = json_encode($data2);
        ?>

        <!-- Kode JavaScript untuk membuat diagram kedua -->
        <script>
            var data2 = <?php echo $json_data2; ?>;
            var categories = [];
            var orderCounts = [];
            for (var i = 0; i < data2.length; i++) {
                categories.push(data2[i].category_name);
                orderCounts.push(data2[i].total_quantity); // Menggunakan 'total_quantity' sebagai jumlah pesanan
            }

            var chart2 = new ej.charts.Chart({
                chartArea: {
                    border: {
                        width: 0
                    }
                },
                primaryXAxis: {
                    title: 'Kategori',
                    valueType: 'Category'
                },
                primaryYAxis: {
                    title: 'Jumlah Pesanan',
                    labelFormat: '{value}',
                    edgeLabelPlacement: 'Shift',
                    interval: 1
                },
                series: [{
                    type: 'Column',
                    dataSource: data2,
                    xName: 'category_name',
                    yName: 'total_quantity', // Menggunakan 'total_quantity' sebagai jumlah pesanan
                    marker: {
                        dataLabel: {
                            visible: true,
                            position: 'Bottom',
                            font: {
                                fontWeight: '600',
                                size: '16px',
                            },
                        }
                    },
                    fill: '#A4D0FF'
                }],
                legendSettings: {
                    visible: false
                },
                title: 'Jumlah pesanan per Kategori'
            });

            chart2.appendTo('#container2');
        </script>
    
</div>
<?php include('./footer.php') ?>
<?php
$db->close();
?>