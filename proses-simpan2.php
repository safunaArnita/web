<?php
// Panggil koneksi database
require_once "config/database.php";

if (isset($_POST['simpan'])) {
	// ambil data hasil submit dari form
	$id                     = trim($_POST['id']);
	$tingkat_pendidikan     = trim($_POST['tingkat_pendidikan']);
	$jurusan                = trim($_POST['jurusan']);
	
	$asal_sekolah           = trim($_POST['asal_sekolah']);
	$tempat_sekolah         = trim($_POST['tempat_sekolah']);
	$tahun_lulus            = trim($_POST['tahun_lulus']);
	
	// tentukan extension yang diperbolehkan
	$allowed_extensions = array('jpg','jpeg','png');
	
	// Set path folder tempat menyimpan gambarnya
	$path_file          = "foto/".$nama_file;
	
	// check extension
	$file               = explode(".", $nama_file);
	$extension          = array_pop($file);

	try {
		// sql statement untuk seleksi id dari tabel is_mahasiswa
		$query = "SELECT id FROM tb_data_pendidikan WHERE id=:id";
		// membuat prepared statements
		$stmt = $pdo->prepare($query);

		// mengikat parameter
		$stmt->bindParam(':id', $id);

		// eksekusi query
		$stmt->execute();

		$count = $stmt->rowCount();
		// jika id sudah ada
		if($count > 0) {
			// tampilkan pesan id sudah ada
			header("location: index.php?id=$id&alert=4");
		}
		// jika id belum ada
		else {
			// Cek apakah tipe file yang diupload sesuai dengan allowed_extensions
			if (in_array($extension, $allowed_extensions)) {
                // Jika tipe file yang diupload sesuai dengan allowed_extensions, lakukan :
                if($ukuran_file <= 1000000) { // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
                    // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
                    // Proses upload
                    if(move_uploaded_file($tmp_file, $path_file)) { // Cek apakah gambar berhasil diupload atau tidak
                		// Jika gambar berhasil diupload, Lakukan : 
				        // sql statement untuk menyimpan data ke tabel is_mahasiswa
				        $query = "INSERT INTO tb_data_pendidikan (id,tingkat_pendidikan,jurusan,asal_sekolah,tempat_sekolah,tahun_lulus)	
								  VALUES(:id,:tingkat_pendidikan,:jurusan,:asal_sekolah,:tempat_sekolah,:tahun_lulus)";
				        // membuat prepared statements
				        $stmt = $pdo->prepare($query);

				        // mengikat parameter
						$stmt->bindParam(':id', $id);
						$stmt->bindParam(':tingkat_pendidikan', $tingkat_pendidikan);
						$stmt->bindParam(':jurusan', $jurusan);
						$stmt->bindParam(':asal_sekolah', $asal_sekolah);
						
						$stmt->bindParam(':tempat_sekolah', $tempat_sekolah);
						$stmt->bindParam(':tahun_lulus', $tahun_lulus);

						// eksekusi query
				        $stmt->execute();

				        // jika berhasil tampilkan pesan berhasil simpan data
						header('location: index.php?alert=1');
                    } else {
                        // Jika gambar gagal diupload, tampilkan pesan gagal upload
                        header("location: index.php?alert=5");
                    }
                } else {
                    // Jika ukuran file lebih dari 1MB, tampilkan pesan gagal upload
                    header("location: index.php?alert=6");
                }
            } else {
                // Jika tipe file yang diupload bukan jpg, jpeg, png, tampilkan pesan gagal upload
                header("location: index.php?alert=7");
            }
		}

		// tutup koneksi database
        $pdo = null;
	} catch (PDOException $e) {
		// tampilkan pesan kesalahan
        echo "FALSE : ".$e->getMessage();
	}
}						
?>