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
let btnSearch = document.getElementById('btnSearch');
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
    xhr.open('GET', 'view_book.php?keyword=' + keyword.value,true);
    xhr.send();
})


function search_book() {
	let search = document.getElementById('search').value;
	let inner = 'result';
	let url = 'detail.php?search=' + search;
	CallAjax(url, inner);
}

function detail_book(isbn) {
	let inner = 'result';
	let url = 'get_detail_book.php?isbn=' + isbn;
	CallAjax(url, inner);
}