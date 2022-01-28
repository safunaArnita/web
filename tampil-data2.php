<div class="row">
    <div class="col-md-12">
      <div class="page-header">
        <h4>
          <i class="glyphicon glyphicon-user"></i> Data Pendidikan
          
          <a class="btn btn-success pull-right" href="#" data-target="#modal_tambah" data-toggle="modal">
            <i class="glyphicon glyphicon-plus"></i> Tambah
          </a>
        </h4>
      </div>

      <?php  
  // fungsi untuk menampilkan pesan
  // jika alert = "" (kosong)
  // tampilkan pesan "" (kosong)
      if (empty($_GET['alert'])) {
        echo "";
      }
  // jika alert = 1
  // tampilkan pesan Sukses "Mahasiswa baru berhasil disimpan" 
      elseif ($_GET['alert'] == 1) {
        echo "<div class='alert alert-success alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data mahasiswa berhasil disimpan.
        </div>";
      } 
  // jika alert = 2
  // tampilkan pesan Sukses "Mahasiswa berhasil diubah"
      elseif ($_GET['alert'] == 2) {
        echo "<div class='alert alert-success alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data mahasiswa berhasil diubah.
        </div>";
      } 
  // jika alert = 3
  // tampilkan pesan Sukses "Mahasiswa berhasil dihapus"
      elseif ($_GET['alert'] == 3) {
        echo "<div class='alert alert-success alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data mahasiswa berhasil dihapus.
        </div>";
      }
  // jika alert = 4
  // tampilkan pesan Gagal "id sudah ada"
      elseif ($_GET['alert'] == 4) {
        echo "<div class='alert alert-danger alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        <strong><i class='glyphicon glyphicon-remove-circle'></i> Gagal!</strong> id $_GET[id] sudah ada.
        </div>";
      }
  // jika alert = 5
  // tampilkan pesan Upload Gagal "Pastikan file yang diupload sudah benar"
      elseif ($_GET['alert'] == 5) {
        echo "  <div class='alert alert-danger alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        <strong><i class='glyphicon glyphicon-remove-circle'></i> Upload Gagal!</strong> Pastikan file yang diupload sudah benar.
        </div>";
      }
  // jika alert = 6
  // tampilkan pesan Upload Gagal "Pastikan ukuran file foto tidak lebih dari 1MB"
      elseif ($_GET['alert'] == 6) {
        echo "  <div class='alert alert-danger alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        <strong><i class='glyphicon glyphicon-remove-circle'></i> Upload Gagal!</strong> Pastikan ukuran file foto tidak lebih dari 1MB.
        </div>";
      }
  // jika alert = 7
  // tampilkan pesan Upload Gagal "Pastikan file yang diupload bertipe *.JPG, *.JPEG, *.PNG"
      elseif ($_GET['alert'] == 7) {
        echo "  <div class='alert alert-danger alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        <strong><i class='glyphicon glyphicon-remove-circle'></i> Upload Gagal!</strong> Pastikan file yang diupload bertipe *.JPG, *.JPEG, *.PNG.
        </div>";
      }
      ?>

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Data Pendidikan</h3>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-hover" id="dataTables-example">
            <thead>
              <tr>
                <th>Id</th>
                <th>Tingkat Pendidikan</th>
                <th>Jurusan</th>
                <th>Asal Sekolah</th>
                <th>Tempat Lahir</th>                
                <th>Tahun Lulus</th>
                <th></th>
              </tr>
            </thead>   

            <tbody>
              <?php
              try {
                $no = 1;

              // sql statement untuk menampilkan semua data dari tabel is_mahasiswa
                $query = "SELECT * FROM tb_data_pendidikan ORDER BY id DESC";
              // membuat prepared statements
                $stmt = $pdo->prepare($query);

              // eksekusi query
                $stmt->execute();

              // tampilkan data
                while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {

                  echo "<tr>
                  <td width='50' class='center'>$no</td>";


                  echo "  <td width='60'>$data[id]</td>
                  <td width='150'>$data[tingkat_kelulusan]</td>
                  <td width='250'>$data[jurusan]</td>                  
                  <td width='100'>$data[asal_sekolah]</td>
                  <td width='120'>$data[tempat_sekolah]</td>
                  <td width='120'>$data[tahun_lulus]</td>

                  <td width='100'>
                  <div class=''>
                  <a href='#' data-toggle='tooltip' data-placement='top' title='Ubah' style='margin-right:5px' class='btn btn-success btn-sm open_modal' id='$data[id]' >
                  <i class='glyphicon glyphicon-edit'></i>
                  </a>";
                  ?>
                  <a href="#" onclick="confirm_modal('proses-hapus.php?&id=<?php echo $data['id']; ?>');" data-id="<?php echo $data['id']; ?>" data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm">
                    <i class="glyphicon glyphicon-trash"></i>
                  </a>
                  <?php
                  echo "
                  </div>
                  </td>
                  </tr>";
                  $no++;
                }

              // tutup koneksi database
                $pdo = null;
              } catch (PDOException $e) {
              // tampilkan pesan kesalahan
                echo "ada kesalahan pada query : ".$e->getMessage();
              }
              ?>
            </tbody>           
          </table>
        </div>
      </div> <!-- /.panel -->
    </div> <!-- /.col -->
  </div> <!-- /.row -->
  
  <!-- Modal Popup untuk tambah--> 
  <div id="modal_tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModalLabel">
            <i class="glyphicon glyphicon-edit"></i> 
            Input Data Pendidikan
          </h4>
        </div>

        <div class="modal-body">
          <form action="proses-simpan.php" method="POST" name="modal_popup" enctype="multipart/form-data">

            <div class="form-group">
              <label>id</label>
              <input type="text" class="form-control" name="id" autocomplete="off" maxlength="10" required/>
            </div>

            <div class="form-group">
              <label>Tingkat Pendidikan</label>
              <select class="form-control" name="tingkat_pendidikan" placeholder="Pilih Tingkat Pendidikan" required>
                <option value=""></option>
                <option value="SD/MI/Sederajat">SD/MI/Sederajat</option>
                <option value="SMP/Mts/Sederajat">SMP/Mts/Sederajat</option>
                <option value="SMA/SMK/MA/Sederajat">SMA/SMK/MA/Sederajat</option>
                <option value="Diploma/Sederajat">Diploma/Sederajat</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
                <option value="S3">S3</option>
              </select>
            </div>

            <div class="form-group">
              <label>Jurusan</label>
              <select class="form-control" name="jurusan" placeholder="Pilih Jurusan" required>
                <option value=""></option>
                <option value="Sistem Informasi">Sistem Informasi</option>
                <option value="Teknik Jaringan Komputer">Teknik Jaringan Komputer</option>
                <option value="Teknik Informatika">Teknik Informatika</option>
                <option value="Teknik Industri">Teknik Industri</option>
                <option value="Teknik Mesin">Teknik Mesin</option>
                <option value="Teknik Sipil">Teknik Sipil</option>
                <option value="Teknik Kimia">Teknik Kimia</option>
                <option value="Teknik Elektro">Teknik Elektro</option>
                <option value="Teknik Material">Teknik Material</option>
                <option value="Teknik Arsitektur">Teknik Arsitektur</option>
              </select>
            </div>

            <div class="form-group">
              <label>Asal Sekolah</label>
              <textarea class="form-control" name="asal_sekolah" rows="3" required></textarea>
            </div>
            
            <div class="form-group">
              <label>Tempat Sekolah</label>
              <textarea class="form-control" name="tempat_sekolah" rows="3" required></textarea>
            </div>

            <div class="form-group">
              <label>Tahun Lulus</label>
              <textarea class="form-control" name="tahun_lulus" rows="3" required></textarea>
            </div>

            <div class="modal-footer">
              <input type="submit" class="btn btn-success btn-submit" name="simpan" value="Simpan">
              <button type="reset" class="btn btn-danger btn-reset" data-dismiss="modal" aria-hidden="true">Batal</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Popup untuk ubah--> 
  <div id="modal_ubah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  </div>

  <!-- Modal Popup untuk hapus -->
  <div class="modal fade" id="modal_hapus">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><i style="margin-right:7px" class="glyphicon glyphicon-trash"></i> Anda yakin ingin menghapus data mahasiswa ?</h4>
        </div>
        <div class="modal-footer">
          <a href="#" type="button" class="btn btn-danger btn-submit" id="link_hapus">Ya, Hapus</a>
          <button type="button" class="btn btn-default btn-reset" data-dismiss="modal">Batal</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->