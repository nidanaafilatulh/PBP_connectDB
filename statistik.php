<?php include('./header.php') ?>
<script src="https://cdn.syncfusion.com/ej2/dist/ej2.min.js" type="text/javascript"></script>

<br>
<?php require_once('./lib/db_login.php'); ?>
<div class="card mt-4">
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
    <div class="card-header">Statistik Buku</div>
    <div class="card-body">
        <div id="container"></div>
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

        //konversi agar bisa digunakan di JS
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
        </form>
    </div>
</div>
<?php include('./footer.php') ?>
<?php
$db->close();
?>