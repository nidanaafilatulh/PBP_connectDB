<?php 
    include('./header.php');
    require_once('./lib/db_login.php');

    $isbn = $_GET['isbn'];

    if (!isset($_POST["submit"])) {
        $query = "SELECT books.isbn, books.title, books.author, books.category, books.price, book_reviews.review, book_reviews.jml_halaman, book_reviews.tgl_terbit, book_reviews.penerbit, book_reviews.img_url FROM books LEFT JOIN book_reviews ON books.isbn = book_reviews.isbn WHERE books.isbn='$isbn'";
        $result = $db->query($query);
        if(!$result) {
            die("Could not query the database: <br />".$db->error);
        } else {
            while($row = $result->fetch_object()){
                $isbn = $row->isbn;
                $title = $row->title;
                $category = $row->category;
                $author = $row->author;
                $price = $row->price;
                $review = $row->review;
                $jml_halaman = $row->jml_halaman;
                $tgl_terbit = $row->tgl_terbit;
                $penerbit = $row->penerbit;
                $img_url = $row->img_url;
            }
        }
        
    
    }
?>


<body>
    <main class="container mt-5 w-75" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . '?isbn=' . $isbn ?>">
        <div class="container d-flex align-items-center align-center">
            <a href="view_book.php" class="btn btn-primary">Kembali</a>
            <p class="">Detail Buku </p>
        </div>
        
        <section class="book-details">
            <div class="row ">
                <div class="col-md-3">
                    <img src="<?php  echo $img_url ?>" alt="Judul Buku" class="img-thumbnail rounded">
                </div>
                <div class="col-md-8">
                    <h1 class="display-4 font-weight-bold"><?php echo $title  ?></h1>
                    <p class="lead"><?php echo $author  ?></p>
                    <table class="table">
                        <tr>
                            <th>Jumlah Halaman</th>
                            <td><?php echo $jml_halaman  ?></td>
                            
                        </tr>
                        <tr>
                            <th>Tanggal Terbit</th>
                            <td><?php echo $tgl_terbit  ?></td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td><?php echo $category  ?></td>
                        </tr>
                        <tr>
                            <th>ISBN</th>
                            <td><?php echo $isbn  ?></td>
                        </tr>
                        <tr>
                            <th>Penerbit</th>
                            <td><?php echo $penerbit  ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row mt-4 p-4 rounded"  style="background: rgba(0, 123, 255, 0.1)">
                <div class="col">
                    <h2>Sinopsis</h2>
                    <p class="text-justify">
                        <?php echo $review ?>
                    </p>
                </div>
            </div>
        </section>

        <section class="customer-reviews mt-5">
            <h2>Ulasan</h2>
            <div class="review mb-3">
                <div class="d-flex align-items-center">
                    <div class="ms-3">
                        <div class="rating">⭐⭐⭐⭐⭐</div>
                        <h3 class="h6 mb-0">Hana Shabrina</h3>
                        <p class="mb-0">Bukunya sangat bagus!</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="add-review mt-5">
            <h2>Tambahkan Ulasan Anda</h2>
            <form>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama:</label>
                    <input type="text" class="form-control" id="nama" required>
                </div>
                <div class="mb-3">
                    <label for="ulasan" class="form-label">Ulasan:</label>
                    <textarea class="form-control" id="ulasan" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating:</label>
                    <select class="form-control" id="rating" required>
                        <option value="1">⭐</option>
                        <option value="2">⭐⭐</option>
                        <option value="3">⭐⭐⭐</option>
                        <option value="4">⭐⭐⭐⭐</option>
                        <option value="5">⭐⭐⭐⭐⭐</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Tambahkan Ulasan</button>
            </form>
        </section>
    </main>
<?php include('./footer.php') ?>

