<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detail Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <main class="container mt-5">
        <section class="book-details">
            <div class="row">
                <div class="col-md-4">
                    <img src="bulan.jpg" alt="Judul Buku" class="img-thumbnail">
                </div>
                <div class="col-md-8">
                    <h1 class="display-4 font-weight-bold">Bulan</h1>
                    <p class="lead">Tere Liye</p>
                    <table class="table">
                        <tr>
                            <th>Jumlah Halaman</th>
                            <td>400</td>
                        </tr>
                        <tr>
                            <th>Tanggal Terbit</th>
                            <td>4 September 2022</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>Novel</td>
                        </tr>
                        <tr>
                            <th>ISBN</th>
                            <td>978-602-03-1411-2</td>
                        </tr>
                        <tr>
                            <th>Penerbit</th>
                            <td>PENERBIT SABAK GRIP</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <h2>Sinopsis</h2>
                    <p class="text-justify">
                        Masih tentang kisah petualangan tiga remaja tangguh Raib, Seli, dan Ali. Namun kali ini ada tambahan tokoh yakni ILY dan tokoh lainnya. 
                        Ily merupakan putra sulung dari Ilo, ily lulusan akademi klan bulan dengan postur tubuh gagah dan sangat disiplin. 
                        Wajahnya amat tampan, dengan bola mata hitam. Ily murah senyum dan dalam senyumnya itu ada lesung pipi yang membuat ily terlihat manis. 
                        Awalnya, kedatangan Av, miss selena, Raib, Seli, Ali, dan Ily hanya untuk mencari sekutu dalam menjaga perdamaian dunia antar klan serta menjaga agar si Tanpa Mahkota tetap di tempatnya, 
                        yakni penjara bayangan di bawah bayangan. Namun, ketua konsil klan matahari, Fala-tara-tana IV justru memanfaatkan mereka untuk menambah kekuatan sang ketua. 
                        Yakni dengan mengikutsertakan Raib, Seli, Ali, dan Ily dalam kompetisi mencari bunga matahari yang pertama mekar pada hari ke 10 sejak kompetisi itu di mulai. 
                        Keluar dari portal, mereka langsung di sambut sorak sorai para penonton di tribun. Mereka datang percis saat pembukaan acara festival bunga matahari. 
                        Raib, Seli, Ali, dan Ily mengikuti kompetisi dengan mengunggangi Harimau putih dari pegunungaan salju, Hadiah dari Mala tara tana II. 
                        Di tengah lapangan istana ilios, saat petir menghantam api unggun, sembilan kontingen lain berderap meninggalkaan lapangan istana besama hewan yang di tungganginya menerobos gerbang-gerbang yang ada. 
                        Raib dan rombongan menuju utara, mengikuti arahan Ily. Petualangan mereka di klan matahari di mulai. 
                        Memasuki hutan lebat, singgah di ternak lebah milik hana, melintasi padang perdu berduri, memasuki hutan, melawan gorila, menghindari burung pemakan daging, 
                        melintasi lereng pegunungan berkabut, menyebrangi danau, tiba di perkampungan danau teluk jauh, bertemu mela-tara-nata II. Melawan monster danau teluk jauh, lolos dari air bah yang tumpah, mendaki bukit, 
                        melewati lautan jamur beracun, memasuki lorong tikus bawah tanah. Dan kembali ke peternakan lebah milik hana. Banyak rintangan yang mereka lewati, bertemu dengan hal-hal baru, 
                        membantu kontingen lain, membantu orang yang bahkan mengusir mereka. Di akhir, mereka bertarung. Melawan ketua konsil yang hendak membuka portal penjara bayangan di bawah banyangan dan membebaskan Si Tanpa Mahkota. 
                        Hana mengorbankan lebahnya dan Ily mengorbankan dirinya.
                    </p>
                </div>
            </div>
        </section>

        <section class="customer-reviews mt-5">
            <h2>Ulasan Pelanggan</h2>
            <div class="review mb-3">
                <div class="d-flex align-items-center">
                    <img src="ariana.jpeg" alt="Foto Profil" class="mr-3 rounded-circle" style="width: 50px;">
                    <div>
                        <h3 class="h6 mb-0">Hana Shabrina</h3>
                        <p class="mb-0">Bukunya sangat bagus!</p>
                        <div class="rating">⭐⭐⭐⭐⭐</div>
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
    <br><br>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-eSNceF7lWcq5vR3BCSw0f0b0OV66KggFolrql7FsbXEgiJlJ3z8Ei1dFtyAg2dYR" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMzI5KvbSgRZDIOMCdgnD0P4dQD8H37ZpFk0qXl5NNTFwtG7pC8JwZUK1zX" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-DV2ahR4Hv1QF8e5TfIeB5rrStk3fP0T/RWtOBtDfZ51i4Hzv3nmEaqngM+4ZBUpm" crossorigin="anonymous"></script>
</body>
</html>
