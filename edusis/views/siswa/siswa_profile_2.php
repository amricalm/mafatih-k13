 <?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">
			<h1>PROFIL SISWA</h1>
			<div id="tabs">
				<ul>
					<li><a href="#tab01"><span><b>[ 1 ]</b></span></a></li>
					<li><a href="#tab02"><span><b>[ 2 ]</b></span></a></li>
					<li><a href="#tab03"><span><b>[ 3 ]</b></span></a></li>
					<li><a href="#tab09"><span><b>NILAI</b></span></a></li>
				</ul>
                <?php echo form_hidden('nis',$data->row()->nis) ?>
    			<div id="tab01">
    				<table class="nostyle" style="font-size: small;">
    					<tr>
    						<td style="width:200px;">NIS</td>
                            <td style="width:5px;">:</td>
    						<td><input type="text" size="40" name="nis" id="nis" class="input-text" value="<?php echo $data->row()->nis ?>" disabled="disabled" /></td>
    					</tr>
    					<tr>
    						<td style="width:200px;">NISN</td>
                            <td style="width:5px;">:</td>
    						<td><input type="text" size="40" name="nisn" id="nisn" class="input-text" value="<?php echo $data->row()->nisn ?>" disabled="disabled" /></td>
    					</tr>
    					<tr>
    						<td class="va-top">Nama Lengkap</td>
                            <td>:</td>
                            <td><input type="text" size="40" name="nama_lengkap" class="input-text" value="<?php echo $data->row()->nama_lengkap ?>" disabled="disabled" /></td>
    					</tr>
    					<tr>
    						<td>Nama Panggilan</td>
                            <td>:</td>
    						<td><input type="text" size="40" name="nama_panggilan" class="input-text" value="<?php echo $data->row()->nama_panggilan ?>" disabled="disabled" /></td>
    					</tr>
                        <tr>
    						<td>Jenis Kelamin</td>
                            <td>:</td>
    						<td>
                                <?php
                                    $laki       = ($data->row()->kelamin=='L') ? 'checked="checked"' : '';
                                    $prmpn      = ($data->row()->kelamin=='P') ? 'checked="checked"' : ''; 
                                ?>
    							<label><input type="radio" value="L" name="kelamin" id="kelaminl" <?php echo $laki; ?> disabled="disabled" /> Laki-laki</label> &nbsp;
    							<label><input type="radio" value="P" name="kelamin" id="kelaminp" <?php echo $prmpn; ?> disabled="disabled" /> Perempuan</label> &nbsp;
    						</td>
    					</tr>
                        <tr>
    						<td class="va-top">Tempat Lahir</td>
                            <td>:</td>
                            <td><input type="text" size="40" name="tp_lahir" id="tp_lahir" class="input-text" disabled="disabled" value="<?php echo $data->row()->tp_lahir; ?>" /></td>
    					</tr>
                        <tr>
    						<td class="va-top">Tanggal Lahir</td>
                            <td>:</td>
                            <td><input type="text" size="40" name="tgl_lahir" id="tgl_lahir" class="tgl input-text" disabled="disabled" value="<?php echo adn_ctgl($data->row()->tgl_lahir); ?>"/></td>
    					</tr>
                        <tr>
    						<td class="va-top">Agama</td>
                            <td>:</td>
                            <td class="va-top" width="250px">
                                <select name="agama" id="agama" disabled="disabled">
                                    <?php
                                        $agama  = array(''=>'','Islam'=>'Islam','Kristen'=>'Kristen','Katolik'=>'Katolik','Hindu'=>'Hindu','Budha'=>'Budha','Lainnya'=>'Lainnya');
                                        //print_r($agama);
                                        //die($data->row()->agama);
                                        foreach($agama as $keyagama=>$valueagama)
                                        {
                                            $pilih      = ($data->row()->agama==$keyagama) ? ' selected="selected" ' : '';
                                            echo '<option value="'.$keyagama.'"'.$pilih.'>'.$valueagama.'</option>';
                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td class="va-top">Warga Negara</td>
                            <td>:</td>
                            <td><input type="text" name="wn" id="wn" class="input-text" value="<?php echo $data->row()->wn ?>" disabled="disabled" /></td>
    					</tr>
                        <tr>
    						<td class="va-top">Anak Ke:</td>
                            <td>:</td>
                            <td>
                                <input type="text" size="10" name="anak_ke" id="anak_ke" id="anak_ke" class="input-text" disabled="disabled" style="width:50px" value="<?php echo $data->row()->anak_ke ?>" /> &nbsp;&nbsp;&nbsp;
                                Jumlah Saudara Kandung &nbsp;: 
                                <input type="text" size="10" name="jmh_sdr_kandung" id="jmh_sdr_kandung" class="input-text" disabled="disabled" style="width:50px" value="<?php echo $data->row()->jmh_sdr_kandung ?>" />
                            </td>
    					</tr>
                        <tr>
    						<td class="va-top">Jumlah Saudara Tiri</td>
                            <td>:</td>
                            <td>
                                <input type="text" size="10" name="jmh_sdr_tiri" id="jmh_sdr_tiri" class="input-text" disabled="disabled" style="width:50px" value="<?php echo $data->row()->jmh_sdr_tiri ?>" /> &nbsp;&nbsp;&nbsp;
                                Jumlah Saudara Angkat &nbsp;: &nbsp;
                                <input type="text" size="&nbsp;10" name="jmh_sdr_angkat" id="jmh_sdr_angkat" class="input-text" disabled="disabled" style="width:50px" value="<?php echo $data->row()->jmh_sdr_angkat ?>" />
                            </td>
    					</tr>
                        <tr>
    						<td class="va-top">Bahasa Sehari-hari</td>
                            <td>:</td>
                            <td class="va-top" width="250px">
                                <select name="bahasa" id="bahasa" disabled="disabled" >
                                    <?php 
                                        $bahasa     = array('Indonesia'=>'Indonesia','Daerah'=>'Daerah','Asing'=>'Asing','Indonesia - Daerah'=>'Indonesia - Daerah','Indonesia - Asing'=>'Indonesia - Asing');
                                        foreach($bahasa as $key=>$value)
                                        {
                                            $pilih      = ($data->row()->bahasa==$key) ? ' selected="selected" ' : '';
                                            echo '<option value="'.$key.'"'.$pilih.'>'.$value.'</option>';
                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>
    				</table>	
    			</div>
    			<div id="tab02">
    				<table class="nostyle" style="font-size: small;">
    					<tr>
    						<td style="width:200px;" class="va-top">Alamat</td>
                            <td class="va-top">:</td>
    						<td><textarea name="alamat" id="alamat" class="input-text" disabled="disabled" ><?php echo $data->row()->alamat ?></textarea></td>
    					</tr>
    					<tr>
    						<td>Kelurahan</td>
                            <td>:</td>
    						<td><input type="text" size="40" name="kelurahan" id="kelurahan" disabled="disabled" class="input-text" value="<?php echo $data->row()->kelurahan ?>" /></td>
    					</tr>
                        <tr>
                            <td class="va-top">Kode Pos</td>
                            <td>:</td>
                            <td><input type="text" size="10" name="kode_pos" id="kode_pos" disabled="disabled" class="input-text" value="<?php echo $data->row()->kode_pos ?>" /></td>
                        </tr>
    					<tr>
    						<td class="va-top">Kecamatan </td>
                            <td>:</td>
                            <td><input type="text" size="40" name="kecamatan" id="kecamatan" disabled="disabled" class="input-text" value="<?php echo $data->row()->kecamatan ?>" /></td>
    					</tr>
                        <tr>
    						<td>Kota </td>
                            <td>:</td>
                            <td><input type="text" size="40" name="kota" id="kota" disabled="disabled" class="input-text" value="<?php echo $data->row()->kota ?>" /></td>
    					</tr>
                        <tr>
    						<td>Nomer Telephon</td>
                            <td>:</td>
                            <td><input type="text" size="40" name="telp" id="telp" disabled="disabled" class="input-text" value="<?php echo $data->row()->telp ?>" /></td>
    					</tr>
                        <tr>
    						<td>Tinggal Dengan</td>
                            <td>:</td>
                            <td>
                                <select name="tinggal_dg" id="tinggal_dg" disabled="disabled">
                                    <?php 
                                        $tinggal_dg     = array('Orang Tua Kandung'=>'Orang Tua Kandung','Menumpang'=>'Menumpang','Asrama'=>'Asrama');
                                        foreach($tinggal_dg as $key=>$value)
                                        {
                                            $pilih      = ($data->row()->tinggal_dg==$key) ? ' selected="selected" ' : '';
                                            echo '<option value="'.$key.'"'.$pilih.'>'.$value.'</option>';
                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td>Jarak ke Sekolah</td>
                            <td>:</td>
                            <td><input type="text" name="jarak" id="jarak" class="input-text" disabled="disabled" value="<?php echo $data->row()->jarak ?>" style="width: 50px;" /> KM</td>
    					</tr>
                    </table>
                    <h3>Keterangan Kesehatan</h3>
                    <table class="nostyle" style="font-size: small;">
                        <tr>
    						<td style="width: 200px;">Golongan Darah</td>
                            <td>:</td>
                            <td>
                                <select name="gol_darah" id="gol_darah" disabled="disabled">
                                    <?php 
                                        $gol_darah     = array('A'=>'A','B'=>'B','AB'=>'AB','O'=>'O');
                                        foreach($gol_darah as $key=>$value)
                                        {
                                            $pilih      = ($data->row()->gol_darah==$key) ? ' selected="selected" ' : '';
                                            echo '<option value="'.$key.'" class="input-text"'.$pilih.'>'.$value.'</option>';
                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td>Penyakit yang pernah diderita</td>
                            <td>:</td>
                            <td><input size="40"type="text" name="penyakit" id="penyakit" class="input-text" disabled="disabled" value="<?php echo $data->row()->penyakit; ?>" /></td>
    					</tr>
                        <tr>
    						<td class="va-top">Tinggi Badan</td>
                            <td>:</td>
                            <td><input type="text" name="tinggi_badan" id="tinggi_badan" class="input-text" disabled="disabled" style="width: 50px;" value="<?php echo $data->row()->tinggi_badan; ?>" /> cm</td>
    					</tr>
                        <tr>
    						<td class="va-top">Berat Badan</td>
                            <td>:</td>
                            <td><input type="text" name="berat_badan" id="berat_badan" class="input-text" disabled="disabled" style="width: 50px;" value="<?php echo $data->row()->berat_badan; ?>" /> kg</td>
    					</tr>
                    </table>
    			</div>
    			<div id="tab03">
                    <h3>Pendidikan</h3>
    				<table class="nostyle" style="font-size: small;">
    					<tr>
    						<td style="width:200px;">Asal Sekolah </td>
                            <td>:</td>
    						<td><input type="text" size="40" name="asal_sekolah" class="input-text" disabled="disabled" value="<?php echo $data->row()->asal_sekolah; ?>" /></td>
    					</tr>
                        <tr>
    						<td>Mulai jadi murid</td>
                            <td>:</td>
                            <td><input type="text" name="diterima_tgl" id="diterima_tgl" class="tgl input-text" disabled="disabled" value="<?php echo adn_ctgl($data->row()->diterima_tgl); ?>" /></td>
    					</tr>
                    </table>
                    <h3>Keterangan Siswa</h3>
    				<table class="nostyle" style="font-size: small;">
    					<tr>
    						<td style="width:200px;">Nama Ayah Kandung</td>
                            <td>:</td>
    						<td><input type="text" name="ayah_nama" id="ayah_nama" class="input-text" disabled="disabled" value="<?php echo $data->row()->ayah_nama; ?>" /></td>
    					</tr>
                        <tr>
    						<td>Pendidikan Terakhir Ayah</td>
                            <td>:</td>
                            <td width="250px">
                                <select name="ayah_pdd" id="ayah_pdd" disabled="disabled">
                                    <?php
                                        $pdd        = array('SD'=>'SD','SLTP'=>'SLTP','SLTA'=>'SLTA','D1'=>'D1','D2'=>'D2','D3'=>'D3','S1'=>'S1','S2'=>'S2','S3'=>'S3');
                                        foreach($pdd as $key=>$value)
                                        {
                                            $pilih      = ($data->row()->ayah_pdd==$key) ? ' selected="selected" ' : '';
                                            echo '<option value="'.$key.'" class="input-text" '.$pilih.'>'.$value.'</option>';
                                        } 
                                    ?>
                                </select>
                            </td>
    					</tr>
    					<tr>
    						<td style="width:200px;">Nama Ibu Kandung</td>
                            <td>:</td>
    						<td><input type="text" name="ibu_nama" id="ibu_nama" class="input-text" disabled="disabled" value="<?php echo $data->row()->ibu_nama ?>" /></td>
    					</tr>
                        <tr>
    						<td>Pendidikan Terakhir Ibu</td>
                            <td>:</td>
                            <td width="250px">
                                <select name="ibu_pdd" id="ibu_pdd" disabled="disabled">
                                    <?php
                                        foreach($pdd as $key=>$value)
                                        {
                                            $pilih      = ($data->row()->ibu_pdd==$key) ? ' selected="selected" ' : '';
                                            echo '<option value="'.$key.'" class="input-text" '.$pilih.'>'.$value.'</option>';
                                        } 
                                    ?>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td>Alamat</td>
                            <td>:</td>
                            <td><input type="text" name="ibu_alamat" id="ibu_alamat" disabled="disabled" class="input-text" value="<?php echo $data->row()->ibu_alamat ?>" /></td>
    					</tr>
                        <tr>
    						<td >Kelurahan</td>
                            <td>:</td>
                            <td><input type="text" name="ibu_kelurahan" id="ibu_kelurahan" disabled="disabled" class="input-text" value="<?php echo $data->row()->ibu_kelurahan ?>" /></td>
    					</tr>
                        <tr>
    						<td>Kode Pos</td>
                            <td>:</td>
                            <td><input type="text" name="ibu_kode_pos" id="ibu_kode_pos" disabled="disabled" class="input-text" value="<?php echo $data->row()->ibu_kode_pos ?>" /></td>
    					</tr>
                        <tr>
    						<td>Kecamatan</td>
                            <td>:</td>
                            <td><input type="text" name="ibu_kelurahan" id="ibu_kelurahan" disabled="disabled" class="input-text" value="<?php echo $data->row()->ibu_kelurahan ?>" /></td>
    					</tr>
                        <tr>
    						<td>Kota</td>
                            <td>:</td>
                            <td><input type="text" name="ibu_kota" id="ibu_kota" class="input-text" disabled="disabled" value="<?php echo $data->row()->ibu_kota ?>" /></td>
    					</tr>
                        <tr>
    						<td>Telpon</td>
                            <td>:</td>
                            <td><input type="text" name="ibu_telp" id="ibu_telp" class="input-text" disabled="disabled" value="<?php echo $data->row()->ibu_telp ?>" /></td>
    					</tr>
    					<tr>
    						<td style="width:200px;">Nama Wali (jika ada)</td>
                            <td>:</td>
    						<td><input type="text" name="wali_nama" id="wali_nama" class="input-text" disabled="disabled" value="<?php echo $data->row()->wali_nama ?>" /></td>
    					</tr>
                        <tr>
    						<td>Hubungan Keluarga</td>
                            <td>:</td>
                            <td><input type="text" name="wali_hubungan" id="wali_hubungan" class="input-text" disabled="disabled" value="<?php echo $data->row()->wali_hubungan ?>"/></td>
    					</tr>
                        <tr>
    						<td>Pendidikan Terakhir</td>
                            <td>:</td>
                            <td width="250px">
                                <select name="wali_pdd" id="wali_pdd" disabled="disabled">
                                    <?php
                                        foreach($pdd as $key=>$value)
                                        {
                                            $pilih      = ($data->row()->wali_pdd==$key) ? ' selected="selected" ' : '';
                                            echo '<option value="'.$key.'" class="input-text" '.$pilih.'>'.$value.'</option>';
                                        } 
                                    ?>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td>Pekerjaan</td>
                            <td>:</td>
                            <td width="250px">
                                <select name="wali_pekerjaan" id="wali_pekerjaan" disabled="disabled">
                                    <?php
                                        $pekerjaan        = array('PNS'=>'PNS','Guru'=>'Guru','Anggota TNI/Polri'=>'Anggota TNI/Polri','Pensiunan'=>'Pensiunan','Pegawai Swasta'=>'Pegawai Swasta','Wiraswasta'=>'Wiraswasta','Petani'=>'Petani','Pedagang'=>'Pedagang','Buruh/Karyawan'=>'Buruh/Karyawan');
                                        foreach($pekerjaan as $key=>$value)
                                        {
                                            $pilih      = ($data->row()->wali_pekerjaan==$key) ? ' selected="selected" ' : '';
                                            echo '<option value="'.$key.'" class="input-text" '.$pilih.'>'.$value.'</option>';
                                        } 
                                    ?>
                                </select>
                            </td>
    					</tr>
                    </table>
    			</div>
    			<div id="tab09">
                    <form name="nilai_thajar" id="nilai_thajar" action="<?php echo base_url().'index.php/siswa/profile/'.$this->uri->segment(3).'#tab09' ?>" method="POST">
                        <fieldset>
                            <select name="pilih_th_ajar" id="pilih_th_ajar" onchange="submit()">
                            <?php 
                            foreach($this->app_model->get_th_ajar() as $key=>$val)
                            {
                                $pilih  = ($key==$pilih_th_ajar) ? ' selected="selected" ' : '';
                                echo '<option value="'.$key.'"'.$pilih.' class="input-text">'.$val.'</option>';
                            }
                            ?>
                            </select>
                            <table class="nostyle" style="width: 650px;">
                                <tr>
                                    <td>NIS</td>
                                    <td>:</td>
                                    <td><?php echo $data->row()->nis ?></td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td><?php echo $data->row()->nama_lengkap ?></td>
                                </tr>
                                <tr>
                                    <td>Kelas</td>
                                    <td>:</td>
                                    <td><?php echo $kelas?></td>
                                </tr>
                            </table>
                        </fieldset>
                    </form>
                    <br />
                    <h3>Nilai - nilai</h3>
    				<table style="font-size: small;width:100%">
                        <tr>
                            <th style="width: 25px;">No</th>
                            <th style="width: 90%;">Mata Pelajaran</th>
                            <th style="width: 5%;">Semester 1</th>
                            <th style="width: 5%;">Semester 2</th>
                        </tr>
                        <?php
                            $seq    = 1;
                            foreach($mp->result() as $rowmp)
                            {
                                $bg         = ($seq%2==0) ? ' class="bg" ' : '';
                                echo '<tr'.$bg.'>';
                                echo '<td>'.$seq.'</td>';
                                echo '<td>'.$rowmp->nm_mp.'</td>';
                                $nilaisem1[$rowmp->kd_mp] = ($this->nilai_model->get_nilai_nis($kd_sekolah,$pilih_th_ajar,$nis,'1',$rowmp->kd_mp)->row()->nilai!='0') ? $this->nilai_model->get_nilai_nis($kd_sekolah,$pilih_th_ajar,$nis,'1',$rowmp->kd_mp)->row()->nilai : '';
                                $nilaisem2[$rowmp->kd_mp] = ($this->nilai_model->get_nilai_nis($kd_sekolah,$pilih_th_ajar,$nis,'2',$rowmp->kd_mp)->row()->nilai!='0') ? $this->nilai_model->get_nilai_nis($kd_sekolah,$pilih_th_ajar,$nis,'2',$rowmp->kd_mp)->row()->nilai : '';
                                echo '<td align="center">'.$nilaisem1[$rowmp->kd_mp].'</td>';
                                echo '<td align="center">'.$nilaisem2[$rowmp->kd_mp].'</td>';
                                echo '</tr>';
                                $seq++;
                            } 
                        ?>
                    </table>
    			</div>
			</div>
            <!--<table class="nostyle">
                <tr>
            		<td colspan="2" class="t-right">
                        <input type="submit" name="" class="input-submit" value="Simpan" />
                        <input type="button" name="" class="input-submit" value="Batal" />
                    </td>
            	</tr>
            </table>-->
		</div>
	</div> <!-- /cols -->
	<hr class="noscreen" />
	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>
</div> <!-- /main -->
</body>
</html>