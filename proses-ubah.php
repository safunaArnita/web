<?php
// Panggil koneksi database
require_once "config/database.php";

if (isset($_POST['simpan'])) {
	if (isset($_POST['id'])) {
		// ambil data hasil submit dari form
		$id                = trim($_POST['id']);
	$nama_pegawai      = trim($_POST['nama_pegawai']);
	$tempat_lahir       = trim($_POST['tempat_lahir']);
	
	$tanggal            = trim($_POST['tanggal_lahir']);
	$tgl                = explode('-',$tanggal);
	$tanggal_lahir      = $tgl[2]."-".$tgl[1]."-".$tgl[0];
	
	$alamat             = trim($_POST['alamat']);
	$agama              = trim($_POST['agama']);
	$jenis_kelamin      = trim($_POST['jenis_kelamin']);
	$email              = trim($_POST['email']);
	
	
	$no_hp            = trim($_POST['no_hp']);
	$lokasi_kerja	 = trim($_POST['lokasi_kerja']);
	$usia              = trim($_POST['usia']);
	$tahun_kerja        = trim($_POST['tahun_kerja']);
		
		$nama_file          = $_FILES['foto']['name'];
		$ukuran_file        = $_FILES['foto']['size'];
		$tipe_file          = $_FILES['foto']['type'];
		$tmp_file           = $_FILES['foto']['tmp_name'];
		
		// tentukan extension yang diperbolehkan
		$allowed_extensions = array('jpg','jpeg','png');
		
		// Set path folder tempat menyimpan gambarnya
		$path_file          = "foto/".$nama_file;
		
		// check extension
		$file               = explode(".", $nama_file);
		$extension          = array_pop($file);

		try {
			// jika foto diubah
			if (empty($_FILES['foto']['name'])) {
				// sql statement untuk mengubah data pada tabel is_mahasiswa
				$query = "UPDATE tb_pegawai SET nama_pegawai = :nama_pegawai,
				tempat_lahir 	= :tempat_lahir,
				tanggal_lahir 	= :tanggal_lahir,				
				alamat 			= :alamat,				
				agama 			= :agama,
				jenis_kelamin 	= :jenis_kelamin,
				email 			= :email,
				no_hp 			= :no_hp,
				lokasi_kerja 	= :lokasi_kerja,
				usia 			= :usia,
				tahun_kerja 	= :tahun_kerja
				WHERE id 		= :id";
		        // membuat prepared statements
				$stmt = $pdo->prepare($query);

		        // mengikat parameter
				$stmt->bindParam(':id', $id);
						$stmt->bindParam(':nama_pegawai', $nama_pegawai);
						$stmt->bindParam(':tempat_lahir', $tempat_lahir);
						$stmt->bindParam(':tanggal_lahir', $tanggal_lahir);
						
						$stmt->bindParam(':alamat', $alamat);
						$stmt->bindParam(':agama', $agama);
						$stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
						$stmt->bindParam(':email', $email);
						$stmt->bindParam(':no_hp', $no_hp);
						$stmt->bindParam(':lokasi_kerja', $lokasi_kerja);
						$stmt->bindParam(':usia', $usia);
						$stmt->bindParam(':tahun_kerja', $tahun_kerja);
			}
			// jika foto tidak diubah
			else {
				// Cek apakah tipe file yang diupload sesuai dengan allowed_extensions
				if (in_array($extension, $allowed_extensions)) {
	                // Jika tipe file yang diupload sesuai dengan allowed_extensions, lakukan :
	                if($ukuran_file <= 1000000) { // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
	                    // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
	                    // Proses upload
	                    if(move_uploaded_file($tmp_file, $path_file)) { // Cek apakah gambar berhasil diupload atau tidak
	                		// Jika gambar berhasil diupload, Lakukan : 
					        // sql statement untuk mengubah data pada tabel is_mahasiswa
	                    	$query = "UPDATE tb_pegawai SET nama_pegawai 	= :nama_pegawai,
							tempat_lahir 	= :tempat_lahir,
							tanggal_lahir 	= :tanggal_lahir,				
							alamat 			= :alamat,				
							agama 			= :agama,
							jenis_kelamin 	= :jenis_kelamin,
							email 			= :email,
							no_hp 			= :no_hp,
							lokasi_kerja 	= :lokasi_kerja,
							usia 			= :usia,
							tahun_kerja 	= :tahun_kerja,
	                    	foto         	= :foto
	                    	WHERE id 			= :id";
					        // membuat prepared statements
	                    	$stmt = $pdo->prepare($query);

					        // mengikat parameter
	                    	$stmt->bindParam(':nama_pegawai', $nama_pegawai);
						$stmt->bindParam(':tempat_lahir', $tempat_lahir);
						$stmt->bindParam(':tanggal_lahir', $tanggal_lahir);
						
						$stmt->bindParam(':alamat', $alamat);
						$stmt->bindParam(':agama', $agama);
						$stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
						$stmt->bindParam(':email', $email);
						$stmt->bindParam(':no_hp', $no_hp);
						$stmt->bindParam(':lokasi_kerja', $lokasi_kerja);
						$stmt->bindParam(':usia', $usia);
						$stmt->bindParam(':tahun_kerja', $tahun_kerja);
	                    $stmt->bindParam(':foto', $nama_file);
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

			// eksekusi query
	        $stmt->execute();

	        // jika berhasil tampilkan pesan berhasil update data
	        header('location: index.php?alert=2');

			// tutup koneksi database
	        $pdo = null;
	    } catch (PDOException $e) {
			// tampilkan pesan kesalahan
	    	echo "FALSE : ".$e->getMessage();
	    }
	}
}				
?>