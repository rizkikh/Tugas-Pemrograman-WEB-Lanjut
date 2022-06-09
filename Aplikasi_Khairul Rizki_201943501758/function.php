<?php
session_start();

// database conection
$conn = mysqli_connect("localhost", "root", "", "web_lanjut");

// insert stock
if (isset($_POST['insertbrg'])) {
	$nama = $_POST['nama_brg'];
	$merk = $_POST['merk'];
	$harga = $_POST['harga'];
	$stok = $_POST['stok'];

	$tambahbrg = mysqli_query($conn, "INSERT INTO barang (nama_brg, merk, harga, stok) values ('$nama', '$merk', '$harga', '$stok')");
	if ($tambahbrg) {
		header('location:index.php');
	} else {
		echo "gagal";
		header('location:index.php');
	}
}

//update stock
if (isset($_POST['updatebrg'])) {
	$nama = $_POST['nama_brg'];
	$merk = $_POST['merk'];
	$harga = $_POST['harga'];
	$stok = $_POST['stok'];
	$id_brg = $_POST['id_brg'];
	// print_r($iduser);
	// exit();
	$updatehp = mysqli_query($conn, "UPDATE barang SET nama_brg='$nama', merk='$merk', harga='$harga' , stok='$stok' WHERE barang.id_brg='$id_brg' ");
	if ($updatehp) {
		header('location:index.php');
	} else {
		echo "gagal";
		header('location:index.php');
	}
}

//delete stock
if (isset($_POST['deletebrg'])) {
	$id_brg = $_POST['id_brg'];

	$deletebrg = mysqli_query($conn, "DELETE FROM barang WHERE id_brg='$id_brg'");
	if ($deletebrg) {
		header('location:index.php');
	} else {
		echo "gagal";
		header('location:index.php');
	}
}

//insert pegawai
if (isset($_POST['savepgw'])) {
	$nama = $_POST['nama'];
	$no_hp = $_POST['no_hp'];
	$alamat = $_POST['alamat'];

	$tambahpgw = mysqli_query($conn, "INSERT INTO pegawai (nama_peg, alamat, telp) VALUES ('$nama', '$alamat', '$no_hp')");
	if ($tambahpgw) {
		header('location:pegawai.php');
	} else {
		echo "gagal";
		header('location:pegawai.php');
	}
}

//update pegawai
if (isset($_POST['updatepgw'])) {
	$nama = $_POST['nama'];
	$no_hp = $_POST['nohp'];
	$alamat = $_POST['alamat'];
	$id_pgw = $_POST['idpgw'];

	$updatepgw = mysqli_query($conn, "UPDATE pegawai SET nama_peg='$nama', alamat='$alamat', telp='$no_hp' WHERE id_pegawai='$id_pgw'");
	if ($updatepgw) {
		header('location:pegawai.php');
	} else {
		echo "gagal";
		header('location:pegawai.php');
	}
}

//delete pegawai
if (isset($_POST['deletepgw'])) {
	$id_pgw = $_POST['idpgw'];

	$deletepgw = mysqli_query($conn, "delete from pegawai where id_pegawai='$id_pgw'");
	if ($deletepgw) {
		header('location:pegawai.php');
	} else {
		echo "gagal";
		header('location:pegawai.php');
	}
}


//insert pembeli
if (isset($_POST['savepembeli'])) {
	$nama = $_POST['nama'];
	$no_hp = $_POST['nohp'];

	$tambahpembeli = mysqli_query($conn, "INSERT INTO customer (nama_cust, no_hp) VALUES ('$nama', '$no_hp')");
	if ($tambahpembeli) {
		header('location:pembeli.php');
	} else {
		echo "gagal";
		header('location:pembeli.php');
	}
}

//update pembeli
if (isset($_POST['updatepembeli'])) {
	$nama = $_POST['nama'];
	$no_hp = $_POST['nohp'];
	$idpembeli = $_POST['id_pembeli'];

	$updatepembeli = mysqli_query($conn, "UPDATE customer SET nama_cust='$nama', no_hp='$no_hp' WHERE id_customer='$idpembeli'");
	if ($updatepembeli) {
		header('location:pembeli.php');
	} else {
		echo "gagal";
		header('location:pembeli.php');
	}
}

//delete pembeli
if (isset($_POST['deletepembeli'])) {
	$idpembeli = $_POST['id_pembeli'];

	$deletepembeli = mysqli_query($conn, "DELETE FROM customer WHERE id_customer='$idpembeli'");
	if ($deletepembeli) {
		header('location:pembeli.php');
	} else {
		echo "gagal";
		header('location:pembeli.php');
	}
}

// insert transaksi
if (isset($_POST['savetransaksi'])) {
	$pembeli = $_POST['pembeli'];
	$pegawai = $_POST['pgw'];
	$barang = explode('_', $_POST['barang']); //[0]=>3, [1]=>1200
	$jumlah = $_POST['jumlah'];
	$harga = $_POST['harga'];

	$lihatstock = mysqli_query($conn, "SELECT * FROM barang WHERE id_brg='$barang[0]'");
	$stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
	$stockskrg = $stocknya['stok'];

	if ($jumlah <= $stockskrg) {
		$stockupdate = $stockskrg - $jumlah;
		$updatestock = mysqli_query($conn, "UPDATE barang SET stok='$stockupdate' WHERE id_brg = '$barang[0]'");
		$tambahtransaksi = mysqli_query($conn, "INSERT INTO transaksi (id_customer, id_pegawai, id_brg, total, jumlah) VALUES ('$pembeli', '$pegawai', '$barang[0]', '$harga', '$jumlah')");
		header('location:transaksi.php');
	} else {
		echo "gagal";
		header('location:transaksi.php');
	}
}


// delete transaksi
if (isset($_POST['deletetransaksi'])) {
	$id_transaksi = $_POST['id_transaksi'];
	$id_brg = $_POST['id_brg'];
	$jumlah = $_POST['jumlah'];

	$lihatstock = mysqli_query($conn, "SELECT * FROM barang where id_brg='$id_brg'");
	$stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
	$stockskrg = $stocknya['stok'];

	$stockupdate = $stockskrg + $jumlah;
	$updatestock = mysqli_query($conn, "UPDATE barang SET stok='$stockupdate' WHERE id_brg='$id_brg'");
	$tambahtransaksi = mysqli_query($conn, "DELETE FROM transaksi WHERE id_transaksi='$id_transaksi'");

	header('location:transaksi.php');
}
