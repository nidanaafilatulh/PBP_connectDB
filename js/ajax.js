function getXMLHTTPRequest() {
	if (window.getXMLHTTPRequest) {
		//code for modern browsers
		return new XMLHttpRequest();
	} else {
		//code for old IE browsers
		return new ActiveXObject('Microsoft.XMLHTTP');
	}
}

// ambil elemen
let keyword = document.getElementById('search');
let category = document.getElementById('categoryFilter');
let container = document.getElementById('container');

// event ketika search
keyword.addEventListener('keyup', function(){
    // create ajax object
    let xhr = new XMLHttpRequest();
    // check ajax
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            container.innerHTML = xhr.responseText;
        }
    }
    // execute ajax
    xhr.open('GET', 'book.php?keyword=' + keyword.value,true);
    xhr.send();
})

document.getElementById('categoryFilter').addEventListener('change', function() {
    var selectedCategory = this.value; // Mengambil nilai yang dipilih
    var xhr = new XMLHttpRequest(); // Membuat objek AJAX
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Ketika permintaan selesai dan status OK (200), tampilkan hasil filter di div
            document.getElementById('filteredResults').innerHTML = xhr.responseText;
        }
    };
    // Membuka dan mengirim permintaan AJAX dengan metode POST
    xhr.open('POST', 'book.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('category=' + selectedCategory); // Mengirim kategori yang dipilih ke PHP
});
