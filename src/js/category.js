// DEPENDENCIES: transaction.js
var page = 0; var loadable = true; var loading = false;

document.addEventListener('scroll', function (event) {
	if (document.body.scrollHeight == document.body.scrollTop + window.innerHeight) {
		nextPage()
	}
});

function nextPage(){
	if (loading || !loadable) return;
	
	infobottom = document.getElementById("infobottom");
	infobottom.innerHTML = "loading...";
	
	page++;
	var data = {"action": "category", "cat": category, "page": page};
	
	
	var callback = function(response){
		loading = false;
		
		if(response.status == "ok"){
			var cattable = document.getElementById("cattable");
		
			for (var i = 0; i < response.barang.length; i++){
				var item = response.barang[i];
				
				var row = createRow(item.id, item.nama, item.harga, item.deskripsi);
				cattable.innerHTML += row;
			}
			
			infobottom.innerHTML = "";
		}else{
			loadable = false;
			infobottom.innerHTML = "semua barang sudah ditampilkan";
		}
	};
	
	loading = true;
	
	sendAjax(data, "category.php", callback);
}

function createRow(id, nama, harga, deskripsi){
	var s = '<div class="row rowbarang">';
	s+='<div class="cell33 imgcell" ><img class="imgbarang" src="image/' + id + '.jpg" /></div>';
	s+='<div class="cell66"><div class="table">';
	s+='<div class="row title"><a href="barang.php?id=' + id + '" />' + nama + '</a></div>';
	s+='<div class="row">Rp. ' + formatCurrency(harga) + '</div>';
	s+='<div class="row">' + deskripsi + '</div>';
	s+='<div class="row"><input type="button" value="Tambahkan ke Keranjang" class="main-button-small" onclick="addCart(' + id + ')" /></div>';
	s+='</div></div></div>';
	
	return s;
}
