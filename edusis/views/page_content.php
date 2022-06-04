		<!-- Content (Right Column) -->
		<div id="content" class="box">
            <?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; ?>
            <table style="width: 100%;">
                <tr>
                    <td align="left" width="48px"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/mafatih.jpg"/></td>
                    <td class="va-middle" ><h1 style="text-transform: uppercase; text-align: center;"><?php echo $nama_sekolah; ?> KURIKULUM 2013</h1></td>
                    <td align="right" width="48px"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/mafatih.jpg"/></td>
                </tr>
            </table>
            
            <br />
            <div class="col50">
                <a class="large button yellow" id="file" href="<?php echo base_url()?>index.php/siswa" title="Siswa" style="float:left;padding: 10px; margin: 10px;"><img src="<?php echo base_url()?>edusis_asset/edusisimg/student.png"  height="48px" width="48px"/></a>
                <p class="f-justify">
                    <h2 style="cursor: pointer;" onclick="goto('<?php echo base_url()?>index.php/siswa')">SISWA</h2>
                </p>
            </div>
            <div class="col50 f-right">
                <a class="large button yellow" id="kbm" href="<?php echo base_url()?>index.php/task/daftar" title="Input Nilai" style="float:left;padding: 10px; margin: 10px;"><img src="<?php echo base_url()?>edusis_asset/edusisimg/Text-icon.png" /></a>
                <p class="f-justify">
                    <h2 style="cursor: pointer;" onclick="goto('<?php echo base_url()?>index.php/task/daftar')">INPUT NILAI <?php echo $q; ?></h2>
                </p>
            </div>
            <div class="fix"></div>
            
            <div class="col50">
                <a class="large button yellow" href="<?php echo base_url()?>index.php/guru/daftar" title="Guru dan Karyawan" style="float:left;padding: 10px; margin: 10px;"><img src="<?php echo base_url()?>edusis_asset/edusisimg/Teacher.png" height="48px" width="48px"/></a>
                <p class="f-justify">
                    <h2 style="cursor: pointer;" onclick="goto('<?php echo base_url()?>index.php/guru/daftar')">GURU & KARYAWAN</h2>
                </p>
            </div>
            <div class="col50 f-right">
                <a class="large button yellow" href="<?php echo base_url()?>index.php/hasilbelajar/lck" title="Laporan Hasil Belajar" style="float:left;padding: 10px; margin: 10px;"><img src="<?php echo base_url()?>edusis_asset/edusisimg/book_marks.png" height="48px" width="48px"/></a>
                <p class="f-justify">
                    <h2 style="cursor: pointer;" onclick="goto('<?php echo base_url()?>index.php/hasilbelajar/rapor_uts')">RAPOR <?php echo $q; ?></h2>
                </p>
            </div>
            <div class="fix"></div>
            
            <div class="col50">
                <a class="large button yellow" href="<?php echo base_url()?>index.php/absen/lapabsen" title="Absensi Siswa" style="float:left;padding: 10px; margin: 10px;"><img src="<?php echo base_url()?>edusis_asset/edusisimg/check-mark.png"height="48px" width="48px"/></a>
                <p class="f-justify">
                    <h2 style="cursor: pointer;" onclick="goto('<?php echo base_url()?>index.php/absen/lapabsen')">ABSENSI SISWA</h2>
                </p>
            </div>
            <div class="col50 f-right">
                <a class="large button yellow" href="<?php echo base_url()?>index.php/sekolah/profil" title="Profil Sekolah" style="float:left;padding: 10px; margin: 10px;"><img src="<?php echo base_url()?>edusis_asset/edusisimg/School1.png" height="48px" width="48px"/></a>
                <p class="f-justify">
                    <h2 style="cursor: pointer;" onclick="goto('<?php echo base_url()?>index.php/sekolah/profil')">PROFIL SEKOLAH</h2>
                </p>
            </div>
            <div class="fix"></div>
        </div> <!-- /content -->