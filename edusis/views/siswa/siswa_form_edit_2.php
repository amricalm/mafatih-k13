 <?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">
			<h1>DAFTAR SISWA</h1>
			<div id="tabs">
				<ul>
					<li><a href="#tab01"><span><b>[ 1 ]</b></span></a></li>
					<li><a href="#tab02"><span><b>[ 2 ]</b></span></a></li>
					<li><a href="#tab03"><span><b>[ 3 ]</b></span></a></li>
				</ul>
                <form action="<?php echo base_url() ?>index.php/siswa/siswa_exec/db_edit" method="POST" onsubmit="return validasi()">
                <?php echo form_hidden('nis',$data->row()->nis) ?>
    			<div id="tab01">
    				<table class="nostyle" style="font-size: small;">
    					<tr>
    						<td style="width:200px;">NIS</td>
                            <td style="width:5px;">:</td>
    						<td><input type="text" size="40" name="nis" id="nis" class="input-text" disabled="disabled" value="<?php echo $data->row()->nis; ?>" /></td>
    					</tr>
    					<tr>
    						<td style="width:200px;">NISN</td>
                            <td style="width:5px;">:</td>
    						<td><input type="text" size="40" name="nisn" id="nisn" class="input-text" value="<?php echo $data->row()->nisn; ?>" /></td>
    					</tr>
    					<tr>
    						<td class="va-top">Nama Lengkap</td>
                            <td>:</td>
                            <td><input type="text" size="40" name="nama_lengkap" id="nama_lengkap" class="input-text" value="<?php echo $data->row()->nama_lengkap; ?>" /></td>
    					</tr>
    					<tr>
    						<td>Nama Panggilan</td>
                            <td>:</td>
    						<td><input type="text" size="40" name="nama_panggilan" class="input-text" value="<?php echo $data->row()->nama_panggilan;?>" /></td>
    					</tr>
                        <tr>
    						<td>Jenis Kelamin</td>
                            <td>:</td>
    						<td>
                                <?php
                                    $laki       = ($data->row()->kelamin=='L') ? 'checked="checked"' : '';
                                    $prmpn      = ($data->row()->kelamin=='P') ? 'checked="checked"' : ''; 
                                ?>
    							<label><input type="radio" value="L" name="kelamin" id="kelaminl" <?php echo $laki; ?> /> Laki-laki</label> &nbsp;
    							<label><input type="radio" value="P" name="kelamin" id="kelaminp" <?php echo $prmpn; ?> /> Perempuan</label> &nbsp;
    						</td>
    					</tr>
                        <tr>
    						<td class="va-top">Tempat Lahir</td>
                            <td>:</td>
                            <td><input type="text" size="40" name="tp_lahir" id="tp_lahir" class="input-text" value="<?php echo $data->row()->tp_lahir; ?>" /></td>
    					</tr>
                        <tr>
    						<td class="va-top">Tanggal Lahir</td>
                            <td>:</td>
                            <td><input type="text" size="40" name="tgl_lahir" id="tgl_lahir" class="tgl input-text" value="<?php echo $tgl->row()->th; echo ' - '; echo $tgl->row()->bln; echo ' - '; echo $tgl->row()->hr;?>"/></td>
    					</tr>
                        <tr>
    						<td class="va-top">Agama</td>
                            <td>:</td>
                            <td class="va-top" width="250px">
                                <select name="agama" id="agama">
                                    <?php
                                        $agama  = array(''=>'','Islam'=>'Islam','Kristen'=>'Kristen','Katolik'=>'Katolik','Hindu'=>'Hindu','Budha'=>'Budha','Lainnya'=>'Lainnya');
                                        foreach($agama as $keyagama=>$valueagama)
                                        {
                                            $pilih      = (trim($data->row()->agama)==$keyagama) ? ' selected="selected" ' : '';
                                            echo '<option value="'.trim($keyagama).'"'.$pilih.'>'.$valueagama.'</option>';
                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td class="va-top">Warga Negara</td>
                            <td>:</td>
                            <td><input type="text" name="wn" id="wn" class="input-text" value="<?php echo $data->row()->wn; ?>" /></td>
    					</tr>
                        <tr>
    						<td class="va-top">Anak Ke:</td>
                            <td>:</td>
                            <td>
                                <input type="text" size="10" name="anak_ke" id="anak_ke" id="anak_ke" class="input-text" style="width:50px" value="<?php echo $data->row()->anak_ke; ?>" /> &nbsp;&nbsp;
                                Jumlah Saudara Kandung &nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;
                                <input type="text" size="10" name="jmh_sdr_kandung" id="jmh_sdr_kandung" class="input-text" style="width:50px" value="<?php echo $data->row()->jmh_sdr_kandung; ?>" />
                            </td>
    					</tr>
                        <tr>
    						<td class="va-top">Jumlah Saudara Tiri</td>
                            <td>:</td>
                            <td>
                                <input type="text" size="10" name="jmh_sdr_tiri" id="jmh_sdr_tiri" class="input-text" style="width:50px" value="<?php echo $data->row()->jmh_sdr_tiri; ?>" /> &nbsp;&nbsp;&nbsp;
                                Jumlah Saudara Angkat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;
                                <input type="text" size="10" name="jmh_sdr_angkat" id="jmh_sdr_angkat" class="input-text" style="width:50px" value="<?php echo $data->row()->jmh_sdr_angkat; ?>" />
                            </td>
    					</tr>
                        <tr>
    						<td class="va-top">Bahasa Sehari-hari</td>
                            <td>:</td>
                            <td class="va-top" width="250px">
                                <select name="bahasa" id="bahasa" >
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
    					<tr>
    						<td style="width:200px;" class="va-top">Alamat</td>
                            <td class="va-top">:</td>
    						<td><textarea name="alamat" id="alamat" class="input-text" ><?php echo $data->row()->alamat; ?></textarea></td>
    					</tr>
    					<tr>
    						<td>Kelurahan</td>
                            <td>:</td>
    						<td><input type="text" size="40" name="kelurahan" id="kelurahan" class="input-text" value="<?php echo $data->row()->kelurahan; ?>" /></td>
    					</tr>
                        <tr>
                            <td class="va-top">Kode Pos</td>
                            <td>:</td>
                            <td><input type="text" size="10" name="kode_pos" id="kode_pos" class="input-text" value="<?php echo $data->row()->kode_pos; ?>" /></td>
                        </tr>
    				</table>	
    			</div>
    			<div id="tab02">
    				<table class="nostyle" style="font-size: small;">
    					<tr>
    						<td class="va-top" style="width:200px;">Kecamatan </td>
                            <td>:</td>
                            <td><input type="text" size="40" name="kecamatan" id="kecamatan" class="input-text" value="<?php echo $data->row()->kecamatan; ?>" /></td>
    					</tr>
                        <tr>
    						<td style="width:200px;">Kota </td>
                            <td>:</td>
                            <td><input type="text" size="40" name="kota" id="kota" class="input-text" value="<?php echo $data->row()->kota; ?>" /></td>
    					</tr>
                        <tr>
    						<td style="width:200px;">Nomer Telephon</td>
                            <td>:</td>
                            <td><input type="text" size="40" name="telp" id="telp" class="input-text" value="<?php echo $data->row()->telp; ?>" /></td>
    					</tr>
                        <tr>
    						<td style="width:200px;">Tinggal Dengan</td>
                            <td>:</td>
                            <td>
                                <select name="tinggal_dg" id="tinggal_dg">
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
    						<td style="width:200px;">Jarak ke Sekolah</td>
                            <td>:</td>
                            <td><input type="text" name="jarak" id="jarak" class="input-text" value="<?php echo $data->row()->jarak; ?>" style="width: 50px;" /> KM</td>
    					</tr>
                    </table>
                    <h3>Pendidikan</h3>
    				<table class="nostyle" style="font-size: small;">
    					<tr>
    						<td style="width:200px;">Asal Sekolah </td>
                            <td>:</td>
    						<td><input type="text" size="40" name="asal_sekolah" class="input-text" value="<?php echo $data->row()->asal_sekolah; ?>" /></td>
    					</tr>
                        <tr>
    						<td style="width:200px;">Mulai jadi murid</td>
                            <td>:</td>
                            <td><input type="text" name="diterima_tgl" id="diterima_tgl" class="tgl input-text" value="<?php echo $tglmasuk->row()->th; echo ' - '; echo $tglmasuk->row()->bln; echo ' - '; echo $tglmasuk->row()->hr; ?>" /></td>
    					</tr>
                    </table>
                    <h3>Keterangan Kesehatan</h3>
                    <table class="nostyle" style="font-size: small;">
                        <tr>
    						<td style="width: 200px;">Golongan Darah</td>
                            <td>:</td>
                            <td>
                                <select name="gol_darah" id="gol_darah">
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
                            <td><input size="40"type="text" name="penyakit" id="penyakit" class="input-text" value="<?php echo $data->row()->penyakit; ?>" /></td>
    					</tr>
                        <tr>
    						<td class="va-top">Tinggi Badan</td>
                            <td>:</td>
                            <td><input type="text" name="tinggi_badan" id="tinggi_badan" class="input-text" style="width: 50px;" value="<?php echo $data->row()->tinggi_badan; ?>" /> cm</td>
    					</tr>
                        <tr>
    						<td class="va-top">Berat Badan</td>
                            <td>:</td>
                            <td><input type="text" name="berat_badan" id="berat_badan" class="input-text" style="width: 50px;" value="<?php echo $data->row()->berat_badan; ?>" /> kg</td>
    					</tr>
                    </table>
    			</div>
    			<div id="tab03">
                    <h3>Keterangan Siswa</h3>
    				<table class="nostyle" style="font-size: small;">
    					<tr>
    						<td style="width:200px;">Nama Ayah Kandung</td>
                            <td>:</td>
    						<td><input type="text" name="ayah_nama" id="ayah_nama" class="input-text" value="<?php echo $data->row()->ayah_nama; ?>" /></td>
    					</tr>
                        <tr>
    						<td>Pendidikan Terakhir Ayah</td>
                            <td>:</td>
                            <td width="250px">
                                <select name="ayah_pdd" id="ayah_pdd">
                                    <?php
                                        $pdd        = array('-'=>'-','TS'=>'Tidak Sekolah','PSD'=>'Putus SD','SD'=>'SD Sederajat','SLTP'=>'SMP Sederajat','SLTA'=>'SMA Sederajat','D1'=>'D1','D2'=>'D2','D3'=>'D3','D4'=>'D4','S1'=>'S1','S2'=>'S2','S3'=>'S3');
                                        foreach($pdd as $key=>$value)
                                        {
                                            $pilih      = (trim($data->row()->ayah_pdd)==$key) ? ' selected="selected" ' : '';
                                            echo '<option value="'.trim($key).'" class="input-text" '.$pilih.'>'.$value.'</option>';
                                        } 
                                    ?>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td>Pekerjaan Ayah</td>
                            <td>:</td>
                            <td width="250px">
                                <select name="ayah_pekerjaan" id="ayah_pekerjaan">
                                    <?php
                                        $pekerjaan        = array('TB'=>'Tidak Bekerja','Guru'=>'Guru','N'=>'Nelayan','Petani'=>'Petani','Petrnk'=>'Peternak','PNS'=>'PNS/TNI/Polri','Karyawan Swasta'=>'Karyawan Swasta','pk'=>'Pedagang Kecil','pb'=>'Pedagang Besar','Wiraswasta'=>'Wiraswasta','Wirausaha'=>'Wirausaha','Buruh'=>'Buruh','Pensiunan'=>'Pensiunan','lain'=>'Lainnya');
                                        foreach($pekerjaan as $key=>$value)
                                        {
                                            $pilih      = ($data->row()->ayah_pekerjaan==$key) ? ' selected="selected" ' : '';
                                            echo '<option value="'.$key.'" class="input-text" '.$pilih.'>'.$value.'</option>';
                                        } 
                                    ?>
                                </select>
                            </td>
    					</tr>
    					<tr>
    						<td style="width:200px;">Nama Ibu Kandung</td>
                            <td>:</td>
    						<td><input type="text" name="ibu_nama" id="ibu_nama" class="input-text" value="<?php echo $data->row()->ibu_nama; ?>" /></td>
    					</tr>
                        <tr>
    						<td>Pendidikan Terakhir Ibu</td>
                            <td>:</td>
                            <td width="250px">
                                <select name="ibu_pdd" id="ibu_pdd">
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
    						<td>Pekerjaan Ibu</td>
                            <td>:</td>
                            <td width="250px">
                                <select name="ibu_pekerjaan" id="ibu_pekerjaan">
                                    <?php 
                                        $pekerjaan  += array('Ibu Rumah Tangga'=>'Ibu Rumah Tangga');
                                        foreach($pekerjaan as $key=>$value)
                                        {
                                            $pilih      = ($data->row()->ibu_pekerjaan==$key) ? ' selected="selected" ' : '';
                                            echo '<option value="'.$key.'" class="input-text" '.$pilih.'>'.$value.'</option>';
                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td>Alamat</td>
                            <td>:</td>
                            <td><input type="text" name="ibu_alamat" id="ibu_alamat" class="input-text" value="<?php echo $data->row()->ibu_alamat; ?>" /></td>
    					</tr>
                        <tr>
    						<td >Kelurahan</td>
                            <td>:</td>
                            <td><input type="text" name="ibu_kelurahan" id="ibu_kelurahan" class="input-text" value="<?php echo $data->row()->ibu_kelurahan; ?>" /></td>
    					</tr>
                        <tr>
    						<td>Kode Pos</td>
                            <td>:</td>
                            <td><input type="text" name="ibu_kode_pos" id="ibu_kode_pos" class="input-text" value="<?php echo $data->row()->ibu_kode_pos; ?>" /></td>
    					</tr>
                        <tr>
    						<td>Kecamatan</td>
                            <td>:</td>
                            <td><input type="text" name="ibu_kecamatan" id="ibu_kecamatan" class="input-text" value="<?php echo $data->row()->ibu_kecamatan; ?>" /></td>
    					</tr>
                        <tr>
    						<td>Kota</td>
                            <td>:</td>
                            <td><input type="text" name="ibu_kota" id="ibu_kota" class="input-text" value="<?php echo $data->row()->ibu_kota; ?>" /></td>
    					</tr>
                        <tr>
    						<td>Telpon</td>
                            <td>:</td>
                            <td><input type="text" name="ibu_telp" id="ibu_telp" class="input-text" value="<?php echo $data->row()->ibu_telp; ?>" /></td>
    					</tr>
    					<tr>
    						<td style="width:200px;">Nama Wali (jika ada)</td>
                            <td>:</td>
    						<td><input type="text" name="wali_nama" id="wali_nama" class="input-text" value="<?php echo $data->row()->wali_nama; ?>" /></td>
    					</tr>
                        <tr>
    						<td>Hubungan Keluarga</td>
                            <td>:</td>
                            <td><input type="text" name="wali_hubungan" id="wali_hubungan" class="input-text" value="<?php echo $data->row()->wali_hubungan; ?>"/></td>
    					</tr>
                        <tr>
    						<td>Pendidikan Terakhir</td>
                            <td>:</td>
                            <td width="250px">
                                <select name="wali_pdd" id="wali_pdd">
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
                                <select name="wali_pekerjaan" id="wali_pekerjaan">
                                    <?php
                                        $pekerjaan  += array('Ibu Rumah Tangga'=>'Ibu Rumah Tangga');
                                        foreach($pekerjaan as $key=>$value)
                                        {
                                            $pilih      = ($data->row()->wali_pekerjaan==$key) ? ' selected="selected" ' : '';
                                            echo '<option value="'.$key.'" class="input-text" '.$pilih.'>'.$value.'</option>';
                                        } 
                                    ?>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td>Alamat Wali</td>
                            <td>:</td>
                            <td><input type="text" name="wali_alamat" id="wali_alamat"class="input-text" value="<?php echo $data->row()->wali_alamat ?>" /></td>
    					</tr>
                        <tr>
    						<td>Telpon</td>
                            <td>:</td>
                            <td><input type="text" name="wali_telp" id="wali_telp" class="input-text" value="<?php echo $data->row()->wali_telp ?>" /></td>
    					</tr>
                    </table>
    			</div>
			</div>
            <table class="nostyle">
                <tr>
            		<td colspan="2" class="t-right">
                        <input type="submit" name="" class="input-submit" value="Simpan" />
                        <input type="button" name="" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/siswa/daftar'; ?>'" />
                    </td>
            	</tr>
            </table>
            </form>
		</div>
	</div> <!-- /cols -->
	<hr class="noscreen" />
	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>
</div> <!-- /main -->
<script type="text/javascript">
function validasi()
{
    var peringatan = '';
    var nip     = $('#nis').val();
    var nama    = $('#nama_lengkap').val(); 
    peringatan  += (nip=='') ? "NIS harus diisi!\n" : '';
    peringatan  += (nama=='') ? "Nama harus diisi!\n" : '';
    if(peringatan!='')
    {
        alert(peringatan);
        return false;
    }
    else
    {
        return true;
    }
}
</script>
</body>
</html>