<?php
// Panggil koneksi database
require_once "config/database.php";

$id = $_GET['id'];

if (isset($id)) {
	try {
		// sql statement untuk menghapus data pada tabel is_mahasiswa
        $query = "DELETE FROM tb_pegawai WHERE id=:id";
        // membuat prepared statements
		$stmt = $pdo->prepare($query);

		//mengikat parameter 
		$stmt->bindParam(':id', $id);

		// eksekusi query
		$stmt->execute();

        // jika berhasil tampilkan pesan berhasil delete data
		header('location: index.php?alert=3');

		// tutup koneksi database
        $pdo = null;
	} catch (PDOException $e) {
		// tampilkan pesan kesalahan
        echo "FALSE : ".$e->getMessage();
	}
}					
?>