<html>

<head>
<title>Registration</title>
<link rel="stylesheet" href="css/global.css" />
<link rel="stylesheet" href="css/registration.css" />
<script src="js/ajax.js"></script>

<script type="text/javascript">
function ValidateForm(form)
{

var a=document.forms["form1"]["name"].value;
var c=document.forms["form1"]["address"].value;
var d=document.forms["form1"]["contact"].value;
var e=document.forms["form1"]["email"].value;
var f=document.forms["form1"]["username"].value;
var g=document.forms["form1"]["password"].value;
var h=document.forms["form1"]["cpassword"].value;
if (a==null || a=="")
  {
  alert("Name must be filled out");
  return false;
  }
if (f.length<5)
  {
  alert("Username must be more than 5 characters");
  return false;
  }
if (g.length<8)
  {
  alert("Password must be more than 8 characters");
  return false;
  }
if (c==null || c=="")
  {
  alert("Address must be filled out");
  return false;
  }
if (e==null || e=="")
  {
  alert("Email address must be filled out");
  return false;
  }
if (f==null || f=="")
  {
  alert("username must be filled out");
  return false;
  }
if (g==null || g=="")
  {
  alert("Password must be filled out");
  return false;
  }
if (h==null || h=="")
  {
  alert("Confirm password must be filled out");
  return false;
  }
if (h!=g)
  {
  alert("Password is not same with confirmed one!");
  return false;
  }
 
if (e==g)
  {
  alert("Password is same email address!");
  return false;
  }
  
//var reg = /^[a-z][0-9a-z]*([._][0-9a-z])*[@][a-z0-9]+([.][a-z]{2,})+$/;
/*if (!reg.test(e)){
	alert("Email is not valid");
	return false;
}*/

var reg = /^.+@.+\..{2,}$/;
if (!reg.test(e)){
	alert("Email is not valid");
	return false;
}

var reg = /^.+ .+$/;
if (!reg.test(a)){
	alert("Name is not valid");
	return false;
}

	var data = {"name" : a, "address" : c, "contact" : d, "email" : e, "username" : f, "password" : g};
	var callback = function(response){	
		if(response.status == "ok"){
			alert("Anda berhasil sign up");
			
			var hasil = {"user": f, "id": response.id};
			localStorage.setItem("logininfo", JSON.stringify(hasil));
			
			window.location = "kredit.php";
		}else{
			alert(response.raw);
		}
	};
	
	sendAjax(data, "handle_registration.php", callback);
}
</script>

</head>

<body>
<div class="outer">
	<?php
		include("header.php");
	?>

<div class='content'>
	<h3>Registration</h3>
	<form id="form1" name="form1" method="post">
	<div class="table">
	  <div class="row">
		<div class="cell50">Name:</div>
		<div class="cell50"><input type="text" name="name" /></div>
	  </div>
	  <div class="row">
		<div class="cell50">Address:</div>
		<div class="cell50"><input type="text" name="address" /></div>
	  </div>
	  <div class="row">
		<div class="cell50">Contact No.:</div>
		<div class="cell50"><input type="text" name="contact" /></div>
	  </div>
	  <div class="row">
		<div class="cell50">Email:</div>
		<div class="cell50"><input type="text" name="email" /></div>
	  </div>
	 <div class="row">
		<div class="cell50">Username:</div>
		<div class="cell50"><input type="text" name="username" /></div>
	  </div>
	 <div class="row">
		<div class="cell50">Password:</div>
		<div class="cell50"><input type="password" name="password" /></div>
	  </div>
	  <div class="row">
		<div class="cell50">Confirm Password:</div>
		<div class="cell50"><input type="password" name="cpassword" /></div>
	  </div>
	  <div class="row">
		<div class="cell50"></div>
		<div class="cell50"><input name="submit" type="button" onclick="return ValidateForm()" value="Submit" /></div>
	  </div>
	</div>


	</form>
</div></div>
</body>
</html>