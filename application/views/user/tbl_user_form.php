<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">UPDATE DATA MAHASISWA</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">

                <table class='table table-bordered>'>

                    <!-- BIODATA BIODATA BIODATA BIODATA BIODATA BIODATA BIODATA BIODATA BIODATA BIODATA BIODATA BIODATA BIODATA -->

                    <tr>
                        <td width='200'>Nama Lengkap <?php echo form_error('full_name') ?></td>
                        <td>
                            <input type="text" class="form-control" name="full_name" id="full_name"
                                placeholder="Full Name" value="<?php echo $full_name; ?>" />
                        </td>
                    </tr>

                    <tr>
                        <td width='200'>NIM <?php echo form_error('nim') ?></td>
                        <td>
                            <input type="text" class="form-control" name="nim" id="nim" placeholder="NIM"
                                value="<?php echo $nim; ?>" />
                        </td>
                    </tr>

                    <tr>
                        <td width='200'>Jurusan <?php echo form_error('jurusan') ?></td>
                        <td>
                            <input type="text" class="form-control" name="jurusan" id="jurusan" placeholder="Jurusan"
                                value="<?php echo $jurusan; ?>" />
                        </td>
                    </tr>

                    <tr>
                        <td width='200'>Asal Sekolah <?php echo form_error('asal_sekolah') ?></td>
                        <td>
                            <input type="text" class="form-control" name="asal_sekolah" id="asal_sekolah"
                                placeholder="Asal Sekolah" value="<?php echo $asal_sekolah; ?>" />
                        </td>
                    </tr>

                    <tr>
                        <td width='200'>Tanggal Lahir <?php echo form_error('tanggal_lahir') ?></td>
                        <td>
                            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
                                placeholder="Tanggal Lahir" value="<?php echo $tanggal_lahir; ?>" />
                        </td>
                    </tr>

                    <tr>
                        <td width='200'>Nomor Telepon <?php echo form_error('nomor_telepon') ?></td>
                        <td>
                            <input type="text" class="form-control" name="nomor_telepon" id="nomor_telepon"
                                placeholder="Nomor Telepon" value="<?php echo $nomor_telepon; ?>" />
                        </td>
                    </tr>

                    <!-- USER USER USER USER USER USER USER USER USER USER USER USER USER USER USER  -->

                    <tr>
                        <td width='200'>Email <?php echo form_error('email') ?></td>
                        <td>

                            <input type="text" class="form-control" name="email" id="email" placeholder="Email"
                                value="<?php echo $email; ?>" /></td>
                    </tr>

                    <?php if (strcmp(strtolower($button), 'create') === 0) {?>
                    <tr>
                        <td width='200'>Password <?php echo form_error('password') ?></td>
                        <td>
                            <input type="text" class="form-control" name="password" id="password" placeholder="Password"
                                value="<?php echo $password; ?>" />
                        </td>
                    </tr>
                    <?php } ?>

                    <tr>
                        <td width='200'>Level User <?php echo form_error('id_user_level') ?></td>
                        <td>
                            <?php echo cmb_dinamis('id_user_level', 'tbl_user_level', 'nama_level', 'id_user_level', $id_user_level,'DESC') ?>
                            <!--<input type="text" class="form-control" name="id_user_level" id="id_user_level" placeholder="Id User Level" value="<?php echo $id_user_level; ?>" />-->
                        </td>
                    </tr>
                    <tr>
                        <td width='200'>Status Aktif <?php echo form_error('is_aktif') ?></td>
                        <td>
                            <?php echo form_dropdown('is_aktif', array('y' => 'AKTIF', 'n' => 'TIDAK AKTIF'), $is_aktif, array('class' => 'form-control')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td width='200'>Foto Profile <?php echo form_error('images') ?></td>
                        <td> <input type="file" name="images"></td>
                    </tr>

                    <tr>
                        <td width='200'>Profile </td>
                        <td>
                            <img src="<?php echo base_url() ?>assets/foto_profil/<?= $images?>"
                                class="user-image" alt="User Image">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="hidden" name="id_users" value="<?php echo $id_users; ?>" />
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-floppy-o"></i>
                                <?php echo $button ?>
                            </button>
                            <a href="<?php echo site_url('user') ?>" class="btn btn-info">
                                <i class="fa fa-sign-out"></i>
                                Kembali
                            </a>
                        </td>
                    </tr>

                </table>
            </form>
        </div>
</div>
</div>