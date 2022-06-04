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
                <form action="<?php echo base_url() ?>index.php/siswa/siswa_exec/db_add" method="POST" onsubmit="return validasi()">
                <div id="tab01">
    				<table class="nostyle" style="font-size: small;">
    					<tr>
    						<td style="width:200px;">NIS</td>
                            <td style="width:5px;">:</td>
    						<td><input type="text" size="40" name="nis" id="nis" class="input-text"/></td>
    					</tr>
    					<tr>
    						<td style="width:200px;">NISN</td>
                            <td style="width:5px;">:</td>
    						<td><input type="text" size="40" name="nisn" id="nisn" class="input-text"/></td>
    					</tr>
    					<tr>
    						<td class="va-top">Nama Lengkap</td>
                            <td>:</td>
                            <td><input type="text" size="40" name="nama_lengkap" id="nama_lengkap" class="input-text"/></td>
    					</tr>
    					<tr>
    						<td>Nama Panggilan</td>
                            <td>:</td>
    						<td><input type="text" size="40" name="nama_panggilan" id="nama_lengkap"class="input-text"/></td>
    					</tr>
                        <tr>
    						<td>Jenis Kelamin</td>
                            <td>:</td>
    						<td>
    							<label><input type="radio" value="L" name="kelamin" id="kelaminl" checked="checked" /> Laki-laki</label> &nbsp;
    							<label><input type="radio" value="P" name="kelamin" id="kelaminp"/> Perempuan</label> &nbsp;
    						</td>
    					</tr>
                        <tr>
    						<td class="va-top">Tempat Lahir</td>
                            <td>:</td>
                            <td><input type="text" size="40" name="tp_lahir" id="tp_lahir" class="input-text" /></td>
    					</tr>
                        <tr>
    						<td class="va-top">Tanggal Lahir</td>
                            <td>:</td>
                            <td><input type="text" size="40" name="tgl_lahir" id="tgl_lahir" class="tgl input-text"/></td>
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
                                            echo '<option value="'.$keyagama.'">'.$valueagama.'</option>';
                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td class="va-top">Warga Negara</td>
                            <td>:</td>
                            <td><input type="text" name="wn" id="wn" class="input-text" /></td>
    					</tr>
                        <tr>
    						<td class="va-top">Anak Ke:</td>
                            <td>:</td>
                            <td>
                                <input type="text" size="10" name="anak_ke" id="anak_ke" id="anak_ke" class="input-text" style="width:50px" /> &nbsp;&nbsp;
                                Jumlah Saudara Kandung &nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;
                                <input type="text" size="10" name="jmh_sdr_kandung" id="jmh_sdr_kandung" class="input-text" style="width:50px"/>
                            </td>
    					</tr>
                        <tr>
    						<td class="va-top">Jumlah Saudara Tiri</td>
                            <td>:</td>
                            <td>
                                <input type="text" size="10" name="jmh_sdr_tiri" id="jmh_sdr_tiri" class="input-text" style="width:50px"/> &nbsp;&nbsp;&nbsp;
                                Jumlah Saudara Angkat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;
                                <input type="text" size="10" name="jmh_sdr_angkat" id="jmh_sdr_angkat" class="input-text" style="width:50px" />
                            </td>
    					</tr>
                        <tr>
    						<td class="va-top">Bahasa Di rumah</td>
                            <td>:</td>
                            <td class="va-top" width="250px">
                                <select name="bahasa" id="bahasa" >
                                    <?php 
                                        $bahasa     = array('Indonesia'=>'Indonesia','Daerah'=>'Daerah','Asing'=>'Asing','Indonesia - Daerah'=>'Indonesia - Daerah','Indonesia - Asing'=>'Indonesia - Asing');
                                        foreach($bahasa as $key=>$value)
                                        {
                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>
    					<tr>
    						<td style="width:200px;" class="va-top">Alamat</td>
                            <td class="va-top">:</td>
    						<td><textarea name="alamat" id="alamat" class="input-text" ></textarea></td>
    					</tr>
    					<tr>
    						<td>Kelurahan</td>
                            <td>:</td>
    						<td><input type="text" size="40" name="kelurahan" id="kelurahan" class="input-text"/></td>
    					</tr>
                        <tr>
                            <td class="va-top">Kode Pos</td>
                            <td>:</td>
                            <td><input type="text" size="10" name="kode_pos" id="kode_pos" class="input-text"/></td>
                        </tr>
    				</table>	
    			</div>
    			<div id="tab02">
    				<table class="nostyle" style="font-size: small;">
    					<tr>
    						<td class="va-top" style="width:200px;">Kecamatan </td>
                            <td>:</td>
                            <td><input type="text" size="40" name="kecamatan" id="kecamatan" class="input-text"/></td>
    					</tr>
                        <tr>
    						<td style="width:200px;">Kota </td>
                            <td>:</td>
                            <td><input type="text" size="40" name="kota" id="kota" class="input-text"/></td>
    					</tr>
                        <tr>
    						<td style="width:200px;">Nomer Telephon</td>
                            <td>:</td>
                            <td><input type="text" size="40" name="telp" id="telp" class="input-text"/></td>
    					</tr>
                        <tr>
    						<td style="width:200px;">Tinggal Dengan</td>
                            <td>:</td>
                            <td>
                                <select name="tinggal_dg" id="tinggal_dg">
                                    <?php 
                                        $tinggal_dg     = array('Orang Tua Kandung'=>'Orang Tua Kandung','Orang Tua Angkat'=>'Orang Tua Angkat','Kakak Kandung'=>'Kakak Kandung','Kakak Ipar'=>'Kakak Ipar','Pesantren'=>'Pesantren');
                                        foreach($tinggal_dg as $key=>$value)
                                        {
                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td style="width:200px;">Jarak ke Sekolah</td>
                            <td>:</td>
                            <td><input type="text" name="jarak" id="jarak" class="input-text" style="width: 50px;" /> KM</td>
    					</tr>
                    </table>
                    <h3>Pendidikan</h3>
    				<table class="nostyle" style="font-size: small;">
    					<tr>
    						<td style="width:200px;">Asal Sekolah </td>
                            <td>:</td>
    						<td><input type="text" size="40" name="asal_sekolah" class="input-text"/></td>
    					</tr>
                        <tr>
    						<td>Mulai jadi murid</td>
                            <td>:</td>
                            <td><input type="text" name="diterima_tgl" id="diterima_tgl" class="tgl input-text"/></td>
    					</tr>
                    </table>
                    <h3>Keterangan Kesehatan</h3>
                    <table class="nostyle" style="font-size: small;">
                        <tr>
    						<td style="width: 200px;">Golongan Darah</td>
                            <td>:</td>
                            <td>
                                <select name="gol_darah" id="gol_darah">
                                    <option value="" class="input-text">&nbsp;</option>
                                    <option value="A" class="input-text">A</option>
                                    <option value="B" class="input-text">B</option>
                                    <option value="AB" class="input-text">AB</option>
                                    <option value="O" class="input-text">O</option>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td>Penyakit yang pernah diderita</td>
                            <td>:</td>
                            <td><input size="40"type="text" name="penyakit" id="penyakit" class="input-text"/></td>
    					</tr>
                        <tr>
    						<td class="va-top">Tinggi Badan</td>
                            <td>:</td>
                            <td><input type="text" name="tinggi_badan" id="tinggi_badan" class="input-text" style="width: 50px;"/> cm</td>
    					</tr>
                        <tr>
    						<td class="va-top">Berat Badan</td>
                            <td>:</td>
                            <td><input type="text" name="berat_badan" id="berat_badan" class="input-text" style="width: 50px;"/> kg</td>
    					</tr>
                    </table>
    			</div>
    			<div id="tab03">
                    <h3>Keterangan Siswa</h3>
    				<table class="nostyle" style="font-size: small;">
    					<tr>
    						<td style="width:200px;">Nama Ayah Kandung</td>
                            <td>:</td>
    						<td><input type="text" name="ayah_nama" id="ayah_nama" class="input-text"/></td>
    					</tr>
                        <tr>
    						<td>Pendidikan Terakhir Ayah</td>
                            <td>:</td>
                            <td width="250px">
                                <select name="ayah_pdd" id="ayah_pdd">
                                    <option value="" class="input-text">&nbsp;</option>
                                    <option value="TS" class="input-text">Tidak Sekolah</option>
                                    <option value="PSD" class="input-text">Putus SD</option>
                                    <option value="SD" class="input-text">SD Sederajat</option>
                                    <option value="SLTP" class="input-text">SMP Sederajat</option>
                                    <option value="SLTA" class="input-text">SMA Sederajat</option>
                                    <option value="D1" class="input-text">D1</option>
                                    <option value="D2" class="input-text">D2</option>
                                    <option value="D3" class="input-text">D3</option>
                                    <option value="D4" class="input-text">D4</option>
                                    <option value="S1" class="input-text">S1</option>
                                    <option value="S2" class="input-text">S2</option>
                                    <option value="S3" class="input-text">S3</option>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td>Pekerjaan Ayah</td>
                            <td>:</td>
                            <td width="250px">
                                <select name="ayah_pekerjaan" id="ayah_pekerjaan">
                                    <option value="" class="input-text">&nbsp;</option>
                                    <option value="TB" class="input-text">Tidak Bekerja</option>
                                    <option value="Guru" class="input-text">Guru</option>
                                    <option value="N" class="input-text">Nelayan</option>
                                    <option value="Petani" class="input-text">Petani</option>
                                    <option value="Petrnk" class="input-text">Peternak</option>
                                    <option value="PNS" class="input-text">PNS/TNI/Polri</option>
                                    <option value="Karyawan Swasta" class="input-text">Karyawan Swasta</option>
                                    <option value="pk" class="input-text">Pedagang Kecil</option>
                                    <option value="pb" class="input-text">Pedagang Besar</option>
                                    <option value="Wiraswasta" class="input-text">Wiraswasta</option>
                                    <option value="Wirausaha" class="input-text">Wirausaha</option>
                                    <option value="Buruh" class="input-text">Buruh</option>
                                    <option value="Pensiunan" class="input-text">Pensiunan</option>
                                    <option value="lain" class="input-text">Lainnya</option>
                                </select>
                            </td>
    					</tr>
    					<tr>
    						<td style="width:200px;">Nama Ibu Kandung</td>
                            <td>:</td>
    						<td><input type="text" name="ibu_nama" id="ibu_nama" class="input-text"/></td>
    					</tr>
                        <tr>
    						<td>Pendidikan Terakhir Ibu</td>
                            <td>:</td>
                            <td width="250px">
                                <select name="ibu_pdd" id="ibu_pdd">
                                    <option value="" class="input-text">&nbsp;</option>
                                    <option value="TS" class="input-text">Tidak Sekolah</option>
                                    <option value="PSD" class="input-text">Putus SD</option>
                                    <option value="SD" class="input-text">SD Sederajat</option>
                                    <option value="SLTP" class="input-text">SMP Sederajat</option>
                                    <option value="SLTA" class="input-text">SMA Sederajat</option>
                                    <option value="D1" class="input-text">D1</option>
                                    <option value="D2" class="input-text">D2</option>
                                    <option value="D3" class="input-text">D3</option>
                                    <option value="D4" class="input-text">D4</option>
                                    <option value="S1" class="input-text">S1</option>
                                    <option value="S2" class="input-text">S2</option>
                                    <option value="S3" class="input-text">S3</option>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td>Pekerjaan Ibu</td>
                            <td>:</td>
                            <td width="250px">
                                <select name="ibu_pekerjaan" id="ibu_pekerjaan">
                                    <option value="" class="input-text">&nbsp;</option>
                                    <option value="TB" class="input-text">Tidak Bekerja</option>
                                    <option value="N" class="input-text">Nelayan</option>
                                    <option value="Petani" class="input-text">Petani</option>
                                    <option value="Petrnk" class="input-text">Peternak</option>
                                    <option value="PNS" class="input-text">PNS/TNI/Polri</option>
                                    <option value="Karyawan" class="input-text">Karyawan Swasta</option>
                                    <option value="pk" class="input-text">Pedagang Kecil</option>
                                    <option value="pb" class="input-text">Pedagang Besar</option>
                                    <option value="Wiraswasta" class="input-text">Wiraswasta</option>
                                    <option value="Wirausaha" class="input-text">Wirausaha</option>
                                    <option value="Buruh" class="input-text">Buruh</option>
                                    <option value="Pensiunan" class="input-text">Pensiunan</option>
                                    <option value="lain" class="input-text">Lainnya</option>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td>Alamat</td>
                            <td>:</td>
                            <td><input type="text" name="ibu_alamat" id="ibu_alamat" class="input-text"/></td>
    					</tr>
                        <tr>
    						<td >Kelurahan</td>
                            <td>:</td>
                            <td><input type="text" name="ibu_kelurahan" id="ibu_kelurahan" class="input-text"/></td>
    					</tr>
                        <tr>
    						<td>Kode Pos</td>
                            <td>:</td>
                            <td><input type="text" name="ibu_kode_pos" id="ibu_kode_pos" class="input-text"/></td>
    					</tr>
                        <tr>
    						<td>Kecamatan</td>
                            <td>:</td>
                            <td><input type="text" name="ibu_kecamatan" id="ibu_kecamatan" class="input-text"/></td>
    					</tr>
                        <tr>
    						<td>Kota</td>
                            <td>:</td>
                            <td><input type="text" name="ibu_kota" id="ibu_kota" class="input-text"/></td>
    					</tr>
                        <tr>
    						<td>Telpon</td>
                            <td>:</td>
                            <td><input type="text" name="ibu_telp" id="ibu_telp" class="input-text"/></td>
    					</tr>
    					<tr>
    						<td style="width:200px;">Nama Wali (jika ada)</td>
                            <td>:</td>
    						<td><input type="text" name="wali_nama" id="wali_nama" class="input-text"/></td>
    					</tr>
                        <tr>
    						<td>Hubungan Keluarga</td>
                            <td>:</td>
                            <td><input type="text" name="wali_hubungan" id="wali_hubungan" class="input-text" /></td>
    					</tr>
                        <tr>
    						<td>Pendidikan Terakhir Wali</td>
                            <td>:</td>
                            <td width="250px">
                                <select name="wali_pdd" id="wali_pdd">
                                    <option value="" class="input-text">&nbsp;</option>
                                    <option value="TS" class="input-text">Tidak Sekolah</option>
                                    <option value="PSD" class="input-text">Putus SD</option>
                                    <option value="SD" class="input-text">SD Sederajat</option>
                                    <option value="SLTP" class="input-text">SMP Sederajat</option>
                                    <option value="SLTA" class="input-text">SMA Sederajat</option>
                                    <option value="D1" class="input-text">D1</option>
                                    <option value="D2" class="input-text">D2</option>
                                    <option value="D3" class="input-text">D3</option>
                                    <option value="D4" class="input-text">D4</option>
                                    <option value="S1" class="input-text">S1</option>
                                    <option value="S2" class="input-text">S2</option>
                                    <option value="S3" class="input-text">S3</option>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td>Pekerjaan Wali</td>
                            <td>:</td>
                            <td width="250px">
                                <select name="wali_pekerjaan" id="wali_pekerjaan">
                                    <option value="" class="input-text">&nbsp;</option>
                                    <option value="TB" class="input-text">Tidak Bekerja</option>
                                    <option value="N" class="input-text">Nelayan</option>
                                    <option value="Petani" class="input-text">Petani</option>
                                    <option value="Petrnk" class="input-text">Peternak</option>
                                    <option value="PNS" class="input-text">PNS/TNI/Polri</option>
                                    <option value="Karyawan" class="input-text">Karyawan Swasta</option>
                                    <option value="pk" class="input-text">Pedagang Kecil</option>
                                    <option value="pb" class="input-text">Pedagang Besar</option>
                                    <option value="Wiraswasta" class="input-text">Wiraswasta</option>
                                    <option value="Wirausaha" class="input-text">Wirausaha</option>
                                    <option value="Buruh" class="input-text">Buruh</option>
                                    <option value="Pensiunan" class="input-text">Pensiunan</option>
                                    <option value="lain" class="input-text">Lainnya</option>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td>Alamat Wali</td>
                            <td>:</td>
                            <td><input type="text" name="wali_alamat" id="wali_alamat"class="input-text"/></td>
    					</tr>
                        <tr>
    						<td>Telpon</td>
                            <td>:</td>
                            <td><input type="text" name="wali_telp" id="wali_telp" class="input-text"/></td>
    					</tr>
                    </table>
    			</div>
			</div>
            <table class="nostyle">
                <tr>
            		<td colspan="2" class="t-right">
                        <input type="submit" name="" class="input-submit" value="Simpan" />
                        <input type="button" name="" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/siswa/daftar' ?>';" />
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