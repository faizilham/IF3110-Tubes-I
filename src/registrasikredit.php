<!--
field card number,
name on card
expired date
submit
submit, maka akan dilakukan ajax untuk mengecek card numer dan name on card tersebut valid
jika sukses akan ada notifikasi pembelian sukses
jika gagal memberikan notifikasi gagal dan kembali ke halaman registrasi kartu kredit -->
<!DOCTYPE html>
<html>
<body>
<script src="js/ajax.js"></script>
<script src="validation.js"></script>
<h1> REGISTRASI KARTU KREDIT </h1>
<p> Registrasi kartu kredit dilakukan melalui form yang ada dibawah ini </p>
<form method="post" action="submit.php">
	<label for "cardnumber">Card Number : </label>
	<input type="text" id="cardnumber" name="cardnumber" "></br>
	<label for "namecard">Name on card : </label>
	<input type="text" id="namecard" name="namecard" /><br/>
	<label for "expireddate">Expired Date (Format MM/YY) : </label>
	<input type="text" id="expireddate" name="expireddate" /><br/>
	<!--<button type="button" onclick="validation(this.form)"  >Submit</button>-->
	<input type="button" value = "Submit" onclick="validation(this.form)" />
</body>
</form>
</html>