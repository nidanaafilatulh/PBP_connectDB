function getXMLHTTPRequest() {
	if (window.getXMLHTTPRequest) {
		return new XMLHttpRequest();
	} else {
		return new ActiveXObject('Microsoft.XMLHTTP');
	}
}

let keyword = document.getElementById('search');
let category = document.getElementById('categoryFilter');
let container = document.getElementById('container');

keyword.addEventListener('keyup', function(){
    let xhr = new XMLHttpRequest();
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
    var selectedCategory = this.value; 
    var xhr = new XMLHttpRequest(); 
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('filteredResults').innerHTML = xhr.responseText;
        }
    };
    xhr.open('POST', 'book.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('category=' + selectedCategory); 
});
