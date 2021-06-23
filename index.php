<?php 

include 'functions.php';

if (isset($_POST['submitLogin'])) {
	$username = $_POST['userLogin'];
	$password = $_POST['passLogin'];

	$data = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
	$obj = mysqli_fetch_assoc($data);

	var_dump(!$obj['username']);

	//cek Username
	if (!$obj['username']) {
		echo "<script> alert('Tidak Ada'); </script>";
	} else {
		
		// Cek Password
		if (password_verify($password, $obj['password'])) {
			// Apa yg dilakukan jika password benar

			echo "<script> alert('PASWORD BENAR!'); </script>";


		} else {
			// Apa yg dilakukan jika password salah
			
			echo "<script> alert('PASSWORD SALAH!'); </script>";
		}
	}
}

if (isset($_POST['submitRegister'])) {
	$username = $_POST['userReg'];
	$password = $_POST['passReg'];

	$passwordNew = password_hash($password, PASSWORD_DEFAULT);
	mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$passwordNew')");

	if (mysqli_affected_rows($conn) >= 1) {
		echo "<script> alert('Register Berhasil!'); </script>";
	} else{
		echo "<script> alert('Register Gagal!'); </script>";
	}
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
</head>
<body>

<h1>Login Form</h1>
<form method="post">
	<input type="text" name="userLogin" placeholder="username">
	<input type="password" name="passLogin" placeholder="password">
	<button type="submit" name="submitLogin">Login!</button>
</form>

<h1>Register Form</h1>
<form method="post">
	<input type="text" name="userReg" placeholder="username">
	<input type="password" name="passReg" placeholder="password">
	<button type="submit" name=submitRegister>Register!</button>
</form>


</body>
</html>