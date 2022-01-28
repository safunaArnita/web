<?php
  // Panggil koneksi database
  require_once "config/database.php";

  if (isset($_GET['id'])) {
    try {
      // sql statement untuk menampilkan data dari tabel is_mahasiswa berdasarkan id
      $query = "SELECT * FROM tb_pegawai WHERE id=:id";
      // membuat prepared statements
      $stmt = $pdo->prepare($query);

      //mengikat parameter 
      $stmt->bindParam(':id', $_GET['id']);

      // eksekusi query
      $stmt->execute();

      // mengambil data mahasiswa
      $data = $stmt->fetch(PDO::FETCH_ASSOC);

      // nilai untuk mengisi form
      $id           = $data['id'];
      $nama_pegawai          = $data['nama_pegawai'];
      $tempat_lahir  = $data['tempat_lahir'];
      
      $tanggal       = $data['tanggal_lahir'];
      $tgl           = explode('-',$tanggal);
      $tanggal_lahir = $tgl[2]."-".$tgl[1]."-".$tgl[0];
      
      $alamat        = $data['alamat'];
      $agama         = $data['agama'];
      $jenis_kelamin = $data['jenis_kelamin'];
      $email        = $data['email'];     
      $no_hp         = $data['no_hp'];
      $lokasi_kerja   = $data['lokasi_kerja'];
      $usia         = $data['usia'];
      $tahun_kerja         = $data['tahun_kerja'];
      $foto          = $data['foto'];

      // tutup koneksi database
      $pdo = null;
    } catch (PDOException $e) {
      // tampilkan pesan kesalahan
      echo "ada kesalahan pada query : ".$e->getMessage();
    }
  }
  ?>
  
  <script type="text/javascript">
    $(function () {
      //datepicker plugin
      $('.date-picker').datepicker({
        autoclose: true,
        todayHighlight: true
      });
    })
  </script>

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">
          <i class="glyphicon glyphicon-edit"></i> 
          Ubah data Pegawai
        </h4>
      </div>

      <div class="modal-body">
        <form action="proses-ubah.php" method="POST" name="modal_popup" enctype="multipart/form-data" >
          <div class="form-group">
            <label>id</label>
            <input type="text" class="form-control" name="id" value="<?php echo $id; ?>" readonly required/>
          </div>

          <div class="form-group">
            <label>Nama Pegawai</label>
            <input type="text" class="form-control" name="nama_pegawai" autocomplete="off" value="<?php echo $nama_pegawai; ?>" required/>
          </div>

          <div class="form-group">
            <label>Tempat Lahir</label>
            <input type="text" class="form-control" name="tempat_lahir" autocomplete="off" value="<?php echo $tempat_lahir; ?>" required/>
          </div>

          <div class="form-group">
            <label>Tanggal Lahir</label>
            <div class="input-group">
              <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggal_lahir" autocomplete="off" value="<?php echo $tanggal_lahir; ?>" required>
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-calendar"></i>
              </span>
            </div>
          </div>


          <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control" name="alamat" rows="3" required><?php echo $alamat; ?></textarea>
          </div>

          <div class="form-group">
            <label>Agama</label>
            <select class="form-control" name="agama" placeholder="Pilih Agama" required>
              <option value="<?php echo $agama; ?>"><?php echo $agama; ?></option>
              <option value="Islam">Islam</option>
              <option value="Kristen Protestan">Kristen Protestan</option>
              <option value="Kristen Katolik">Kristen Katolik</option>
              <option value="Hindu">Hindu</option>
              <option value="Buddha">Buddha</option>
            </select>
          </div>

          <div class="form-group">
            <label>jenis kelamin</label>
            <div class="radio">
              <?php
              if ($jenis_kelamin=='Laki-laki') { ?>
                <label class="radio-inline">
                  <input type="radio" name="jenis_kelamin" value="Laki-laki" checked> Laki-laki
                </label>

                <label class="radio-inline">
                  <input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan
                </label>
                <?php
              } else { ?>
                <label class="radio-inline">
                  <input type="radio" name="jenis_kelamin" value="Laki-laki"> Laki-laki
                </label>

                <label class="radio-inline">
                  <input type="radio" name="jenis_kelamin" value="Perempuan" checked> Perempuan
                </label>
              <?php } ?>
            </div>
          </div>

          <div class="form-group">
            <label>email</label>
            <textarea class="form-control" name="email" rows="3" required><?php echo $email; ?></textarea>
          </div>


          <div class="form-group">
            <label>Telepon</label>
            <input type="text" class="form-control" name="no_hp" autocomplete="off" maxlength="13" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo $no_hp; ?>" required>
          </div>

          <div class="form-group">
            <label>Lokasi Kerja</label>
            <textarea class="form-control" name="lokasi_kerja" rows="3" required><?php echo $lokasi_kerja; ?></textarea>
          </div>

          <div class="form-group">
            <label>Usia</label>
            <textarea class="form-control" name="usia" rows="3" required><?php echo $usia; ?></textarea>
          </div>

          <div class="form-group">
            <label>Tahun Kerja</label>
            <textarea class="form-control" name="tahun_kerja" rows="3" required><?php echo $tahun_kerja; ?></textarea>
          </div>

          <div class="form-group">
            <label>Foto</label> <br>
            <?php  
            if ($foto=="") { ?>
              <img class="img-mahasiswa" src="foto/default_user.png" alt="Foto" width="110">
              <?php
            } else { ?>
              <img class="img-mahasiswa" src="foto/<?php echo $foto; ?>" alt="Foto" width="110">
              <?php
            }
            ?>
            <br><br>
            <input type="file" name="foto">
            <p class="help-block">
              <small>Catatan :</small> <br>
              <small>- Pastikan file yang diupload bertipe *.JPG atau *.PNG</small> <br>
              <small>- Ukuran file foto max 1 Mb</small>
            </p>
          </div>

          <div class="modal-footer">
            <input type="submit" class="btn btn-success btn-submit" name="simpan" value="Simpan">
            <button type="reset" class="btn btn-danger btn-reset" data-dismiss="modal" aria-hidden="true">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>