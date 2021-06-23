<?php 

// Configuration Connection Database
$host = "localhost";
$user = "root";
$password = "";
$usingDatabase = "job";

$connection = mysqli_connect($host, $user, $password, $usingDatabase);


// Function Fetch Data
function fetchData($query){
	global $connection;

	$resultQuery = mysqli_query($connection, $query);
	$box = [];

	// Looping for fetch data
	while ($results = mysqli_fetch_assoc($resultQuery)) {
		$box[] = $results;
	}

	return $box;
}

// Function Add Data Product
function addProduct($data, $gambar){
	global $connection;

	$image = $gambar;
	$name = htmlspecialchars($data['name']);
	$categorie = htmlspecialchars($data['categorie']);
	$desc = htmlspecialchars($data['desc']);
	$price = htmlspecialchars($data['price']);


	$query = "INSERT INTO product VALUES ('', '$image', '$name', '$categorie', '$desc', '$price')";

	mysqli_query($connection, $query);
	return true;
}

// Function Add Data Categorie
function addCategorie($data){
	global $connection;

	$name = htmlspecialchars($data['categorie']);
	$query = "INSERT INTO categories VALUES ('', '$name')";

	mysqli_query($connection, $query);
	return true;
}


// Check Upload File
function checkingUpload(){
	// ================
	$file = $_FILES['image'];

	$nameFile = $file['name'];
	$tmpName = $file['tmp_name']; // location file
	$size = $file['size'];
	$error = $file['error'];
	// ================

	// cek File ada atau tidak
	if ($error === 4) {
		return 'nothingfile';
	}

	// cek type file
	$type = ['jpg', 'jpeg', 'png'];

	$explodeName = explode('.', $nameFile);
	$returnTypeFile = strtolower(end($explodeName));

	// Jika tidak ada type file seperti variable $type
	if ( !in_array($returnTypeFile, $type)) {
		return 'not image';
	}

	$newNameFile = uniqid();
	$newNameFile .= '.';
	$newNameFile .= $returnTypeFile;

	move_uploaded_file($tmpName, 'img/' . $newNameFile);
	return $newNameFile;

}

// Function Delete Data
function deleteData($id, $table){
	 global $connection;

	 mysqli_query($connection, "DELETE FROM $table WHERE id = $id ");
	 return mysqli_affected_rows($connection);
}



// Ubah Format ke Rupiah
function rupiah($angka){
	$format = number_format($angka);
	return $format;
}



// Function Edit Data Categorie
function updateCategorie($id, $name){
	global $connection;
	
	$query = "UPDATE `categories` SET `categories` = '$name' WHERE `categories`.`id` = $id";

	mysqli_query($connection, $query);

	return mysqli_affected_rows($connection);
}

 ?>