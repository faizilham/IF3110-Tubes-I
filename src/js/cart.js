//DEPENDENCIES: ajax.js, login.js, transaction.js

function refreshCart(){
	var cart = document.getElementById("cart");
	cart.innerHTML = "refreshing...";
	
	// klo ga ada di local storage, berarti blom belanja
	if (localStorage.getItem("shoppingbag") === null){
		cart.innerHTML = "Keranjang belanja kosong";
		return;
	}
	var bag = JSON.parse(localStorage.shoppingbag);
	var list = [];
	
	for (barang in bag){
		list.push(parseInt(barang));
	}
	
	// kalo list empty, berarti belom belanja
	if (list.length == 0){
		cart.innerHTML = "Keranjang belanja kosong";
		return;
	}
	
	var callback = function(response){
		if (response.status == "ok"){
			cart.innerHTML = "";
			var total = 0;
			
			// bikin title row 
			
			var hrow = createRow();
			hrow.appendChild(createCell(50, "<b>Nama Barang</b>"));
			hrow.appendChild(createCell(15, "<b>Jumlah</b>"));
			hrow.appendChild(createCell(35, "<b>Total Harga</b>"));
			
			cart.appendChild(hrow);
			
			// isi row2 barang
			
			for (i = 0; i < response.barang.length; i++){
				var barang = response.barang[i];
				
				var harga = bag[barang.id] * barang.harga;
				total += harga;
				
				var row = createRow();
				row.appendChild(createCell(50, barang.nama));
				row.appendChild(createCell(15, "<a class='editlink' href='javascript:editItem(" + barang.id + ");'>"+bag[barang.id] + "</a>"));
				row.appendChild(createCell(35, "Rp. " + formatCurrency(harga)));
				
				cart.appendChild(row);
			}
			
			// bikin row total harga
			
			hrow = createRow();
			hrow.appendChild(createCell(50, "Total Harga"));
			hrow.appendChild(createCell(15, " "));
			hrow.appendChild(createCell(35, "Rp. " + formatCurrency(total)));
			
			cart.appendChild(document.createElement("hr"));
			cart.appendChild(hrow);
			
			var s = "<div id='btn-row' class='row'>"
			s += "<input class='main-button' type='button' value='Lakukan Pembelian' onclick='commit_buy()' />";
			s += " <input class='grey-button' type='button' value='Bersihkan Keranjang' onclick='clean_cart()' />";
			s += "</div>"
			
			cart.innerHTML += s;
			
		}else{
			cart.innerHTML = "error " + response.details;
		}
	};
	
	var request = {"action" : "cart", "ids" : list};
	
	sendAjax(request, "cart.php", callback);
}

function clean_cart(){
	localStorage.removeItem("shoppingbag");
	refreshCart();
}

function commit_buy(){

}

function editItem(id){
	if (localStorage.getItem("shoppingbag") === null) return;
	
	var bag = JSON.parse(localStorage.shoppingbag);
	jumlah = bag[id];
	
	if(jumlah==undefined) return;
	
	editCart(id, jumlah, refreshCart);
}

function createRow(){
	var row = document.createElement("div");
	row.classList.add("row");
	
	return row;
}

function createCell(size, content){
	var cell = document.createElement("div");
	cell.classList.add("cell"+size);
	if (content != null){
		cell.innerHTML = content;
	}
	
	return cell;
}

function loadCartPage(){
	//cek login dulu
	
	refreshCart();
}