<?php

	function addToUser($data){
		// mengecek apakah masih bisa meng-add barang dengan id tertentu sejumlah tertentu
		// return -1 jika sukses, dan sisa barang jika gagal
		$conn = new mysqli("localhost", "root", "", "user");
		
		$statement = $conn->prepare("SELECT * FROM member WHERE Email = ?");
		
		$statement->bind_param("s", $data["email"]);
		$statement->execute();
		
		/*$statement->bind_result($email1);*/
		
		if (!$statement->fetch()){
			$statement1 = $conn->prepare("SELECT * FROM member WHERE Username = ?");
		
			$statement1->bind_param("s", $data["username"]);
			$statement1->execute();
		
			/*$statement1->bind_result($username1);*/
			if (!$statement1->fetch()){
				$name=$data["name"];
				$address=$data["address"];
				$contact=$data["contact"];
				$email=$data["email"]; 
				$username=$data["username"];
				$password=$data["password"];
				$statement2 = $conn->prepare("INSERT INTO member(name,address,contact,email,username,password,no_credit,nama_credit,expired_date,jumlah_transaksi)VALUES('$name', '$address', '$contact', '$email', '$username', '$password', \"\", \"\", \"\", 0)");
				$statement2->execute();
				$statement2->fetch();
				return 0;
			}
			else{
				return 1;
			}
			$statement1->close();
		}
		else{
			return 2;
		}
		$statement->close();
		$conn->close();		
		
		
	}
		
	
	function handleRegistrationAjax(){
		// handle ajax untuk aksi2 transaksi
		// syarat: $_POST["ajax"] terdefinisi
		
		$request = json_decode($_POST["ajax"], true);
		$response = array("status" => "error");
		
		$sisa = addToUser($request);
		if ($sisa == 0)
			$response["status"] = "ok";
		else{
			$response["status"] = "error";
			if ($sisa == 1){
				$response["message"] = "Username sudah terdaftar sebelumnya";
			}
			else{
				$response["message"] = "Email sudah terdaftar sebelumnya";
			}
		}
			
		return json_encode($response);
	}
	
	if (isset($_POST["ajax"])){
		echo handleRegistrationAjax();
	}
?>