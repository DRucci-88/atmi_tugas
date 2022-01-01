<div class="content-wrapper">
  <!-- <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-warning box-solid">

          <div class="box-header">
            <h3 class="box-title">Dashboard Mahasiswa</h3>
          </div>

          <div class="box-body">

          </div>
        </div>
      </div>
    </div> -->
  </section>

  <section class="content">
    <div class="box box-warning box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">BIODATA</h3>
      </div>

      <table class='table table-bordered>'>
        
        <tr>
          <td width='200'>Email </td>
          <td>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email"
              value="<?php echo $user['email']; ?>" /></td>
        </tr>

        <tr>
          <td width='200'>Password </td>
          <td>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email"
              value="<?php echo $user['password']; ?>" /></td>
        </tr>
      
        <tr>
          <td width='200'>Nama Lengkap </td>
          <td>
            <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name" 
              value="<?php echo $biodata['mahasiswa_name']; ?>" />
          </td>
        </tr>

        <tr>
          <td width='200'>NIM </td>
          <td>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email"
              value="<?php echo $biodata['mahasiswa_nim']; ?>" /></td>
        </tr>

        <tr>
          <td width='200'>Jurusan </td>
          <td>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email"
              value="<?php echo $biodata['mahasiswa_jurusan']; ?>" /></td>
        </tr>

        <tr>
          <td width='200'>Asal Sekolah </td>
          <td>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email"
              value="<?php echo $biodata['mahasiswa_asal_sekolah']; ?>" /></td>
        </tr>

        <tr>
          <td width='200'>Tanggal Lahir </td>
          <td>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email"
              value="<?php echo $biodata['mahasiswa_tanggal_lahir']; ?>" /></td>
        </tr>

        <tr>
          <td width='200'>Nomor Telepon </td>
          <td>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email"
              value="<?php echo $biodata['mahasiswa_nomor_telepon']; ?>" /></td>
        </tr>

        <tr>
          <td width='200'>Profile </td>
          <td>
            <img src="<?php echo base_url() ?>assets/foto_profil/<?= $user['images'] ?>" class="user-image" alt="User Image">
          </td>
        </tr>

      </table>

    </div>
  </section>

</div>