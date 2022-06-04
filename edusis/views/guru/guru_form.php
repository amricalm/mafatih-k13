<?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">
			<h1>DAFTAR GURU</h1>
                <br />
			<div id="tabs">
				<ul>
					<li><a href="#tab01"><span><b>[ 1 ]</b></span></a></li>
					<li><a href="#tab02"><span><b>[ 2 ]</b></span></a></li>
					<li><a href="#tab03"><span><b>[ 3 ]</b></span></a></li>
				</ul>
                <form action="<?php echo base_url() ?>index.php/guru/guru_exec/db_add" method="POST" onsubmit="return validasi()">
    			<div id="tab01">
                    <table class="nostyle" style="font-size: small;">
    					<tr>
    						<td style="width:200px;">NIP</td>
                            <td style="width:5px;">:</td>
    						<td><input type="text" size="40" name="nip" id="nip" class="input-text" /></td>
    					</tr>
                        <!--<tr>
    						<td style="width:200px;">Kode Gaji</td>
                            <td style="width:5px;">:</td>
    						<td>
                                <select name="kd_gaji" id="kd_gaji">
                                    <option value=""></option>
                                    <?php
//                                        foreach($golongan as $keygol=>$valuegol)
//                                        {
//                                            echo '<option value="'.$keygol.'">'.$valuegol.'</option>';
//                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>-->
    					<tr>
    						<td class="va-top">Nama Lengkap</td>
                            <td>:</td>
                            <td><input type="text" size="40" name="nama_lengkap" id="nama_lengkap" class="input-text" /></td>
    					</tr>
                        <tr>
    						<td>Jenis Kelamin</td>
                            <td>:</td>
    						<td>
    							<label><input type="radio" value="L" name="kelamin" id="kelaminl" checked="checked" /> Male</label> &nbsp;
    							<label><input type="radio" value="P" name="kelamin" id="kelaminp"/> Female</label> &nbsp;
    						</td>
    					</tr>
                        <!--<tr>
    						<td class="va-top">Employment Status</td>
                            <td>:</td>
                            <td>
                                <select name="kepeg_status" id="kepeg_status">
                                    <?php
//                                        foreach($status as $keystatus=>$valuestatus)
//                                        {
//                                            echo '<option value="'.$keystatus.'">'.$valuestatus.'</option>';
//                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>
                        -->
                        <tr>
    						<td class="va-top" style="width: 200px;">Tempat / Tgl Lahir</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="tp_lahir" id="tp_lahir" class="input-text" style="width: 150px;" />
                                <input type="text" name="tgl_lahir" id="tgl_lahir" class="tgl input-text" style="width: 145px;" />
                            </td>
    					</tr>
    					<tr>
    						<td class="va-top">Golongan</td>
                            <td>:</td>
                            <td>
                                <select name="kepeg_golongan" id="kepeg_golongan">
                                    <option value=""></option>
                                    <?php
                                        foreach($golongan as $keygol=>$valuegol)
                                        {
                                            echo '<option value="'.$keygol.'">'.$valuegol.'</option>';
                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>
                        
    					<!--<tr>
    						<td class="va-top">Room</td>
                            <td>:</td>
                            <td>
                                <select name="kepeg_ruangan" id="kepeg_ruangan">
                                    <option value=""></option>
                                    <?php
//                                        foreach($ruang as $keyruang=>$valueruang)
//                                        {
//                                            echo '<option value="'.$keyruang.'">'.$valueruang.'</option>';
//                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td class="va-top" style="width: 200px;">No. SK / TMT Start Working</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="no_sk_mulai_bekerja" id="no_sk_mulai_bekerja" class="input-text" style="width: 150px;" />
                                <input type="text" name="tgl_mulai_kerja" id="tgl_mulai_kerja" class="tgl input-text" style="width: 145px;" />
                            </td>
    					</tr>
                        <tr>
    						<td class="va-top" style="width: 200px;">No. SK / TMT In School</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="no_sk_sekolah" id="no_sk_sekolah" class="input-text" style="width: 150px;" />
                                <input type="text" name="tgl_sk_sekolah" id="tgl_sk_sekolah" class="tgl input-text" style="width: 145px;" />
                            </td>
    					</tr>-->
<!--
    					
    					<tr>
    						<td style="width:200px;">NUPTK</td>
                            <td style="width:5px;">:</td>
    						<td><input type="text" size="40" name="nuptk" id="nuptk" class="input-text" /></td>
    					</tr>

    					<tr>
    						<td style="width:200px;">No Teacher Contract/PTT/Assist</td>
                            <td style="width:5px;">:</td>
    						<td><input type="text" size="40" name="nptt" id="nptt" class="input-text" /></td>
    					</tr>-->
    				</table>	
    			</div>
    			<div id="tab02">
    				<table class="nostyle" style="font-size: small;">
                        <tr>
    						<td style="width:200px;" class="va-top">Agama</td>
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
                        <!--<tr>
    						<td class="va-top">Mother's Name</td>
                            <td>:</td>
                            <td><input type="text" name="nama_ibu" id="nama_ibu" class="input-text" /></td>
    					</tr>
                        <tr>
    						<td class="va-top">NPWP</td>
                            <td>:</td>
                            <td><input type="text" name="npwp" id="npwp" class="input-text" /></td>
    					</tr>-->
                        <tr>
    						<td class="va-top">Alamat</td>
                            <td class="va-top">:</td>
                            <td><textarea name="alamat" id="alamat" class="input-text" ></textarea></td>
    					</tr>
                        <!--<tr>
    						<td class="va-top">Village</td>
                            <td>:</td>
                            <td><input type="text" name="kelurahan" id="kelurahan" class="input-text" /></td>
    					</tr>
                        <tr>
    						<td class="va-top">Sub District</td>
                            <td>:</td>
                            <td><input type="text" name="kecamatan" id="kecamatan" class="input-text" /></td>
    					</tr>-->
                        <tr>
    						<td class="va-top">Kota</td>
                            <td>:</td>
                            <td><input type="text" name="kota" id="kota" class="input-text" /></td>
    					</tr>
                        <tr>
    						<td class="va-top">Kode Pos</td>
                            <td>:</td>
                            <td><input type="text" name="kode_pos" id="kode_pos" class="pos input-text" style="width:50px" /></td>
    					</tr>
                        <tr>
    						<td class="va-top">Telp</td>
                            <td>:</td>
                            <td><input type="text" name="telp" id="telp" class="input-text" /></td>
    					</tr>
                        <tr>
    						<td class="va-top">HP</td>
                            <td>:</td>
                            <td><input type="text" name="hp" id="hp" class="input-text" /></td>
    					</tr>
                        <tr>
    						<td class="va-top">Jabatan</td>
                            <td>:</td>
                            <td class="va-top" width="250px">
                                <?php
                                    foreach($jabatan as $keyjabatan=>$valuejabatan)
                                    {
                                        echo '<input type="checkbox" name="jabatan[]" id="jabatan'.$keyjabatan.'" value="'.$valuejabatan.'" />&nbsp;&nbsp;'.$valuejabatan.'<br/>';
                                    } 
                                ?>
                            </td>
    					</tr>
                    </table>
                </div>
    			<!--<div id="tab03">
    				<table class="nostyle" style="font-size: small;">
                        <tr>
    						<td class="va-top" style="width: 200px;">No. SK / TMT Position</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="no_sk_jabatan" id="no_sk_jabatan" class="input-text" style="width: 150px;" />
                                <input type="text" name="tmt_jabatan" id="tmt_jabatan" class="input-text" style="width: 145px;" />
                            </td>
    					</tr>
                        <tr>
    						<td class="va-top">Teacher Certification</td>
                            <td>:</td>
                            <td>
                                <input type="radio" name="sertifikasi" id="sertifikasi" class="input-text" value="1" />&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="sertifikasi" id="sertifikasi" class="input-text" value="0" />&nbsp;No</td>
    					</tr>
                        <tr>
    						<td class="va-top">No. Participant</td>
                            <td>:</td>
                            <td><input type="text" name="no_peserta" id="no_peserta" class="input-text" /></td>
    					</tr>
                        <tr>
    						<td class="va-top">No. Certificate/Year</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="no_sertifikasi" id="no_sertifikasi" class="input-text" style="width: 245px;" />
                                <input type="text" name="thn_sertifikasi" id="thn_sertifikasi" class="tahun input-text" style="width: 50px;" />
                            </td>
    					</tr>
                        <tr>
    						<td class="va-top">No. Registration/NRG</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="no_registrasi" id="no_registrasi" class="input-text" />
                            </td>
    					</tr>
                        <tr>
    						<td class="va-top">No. SK Allowance</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="no_sk_tunjangan" id="no_sk_tunjangan" class="input-text" />
                            </td>
    					</tr>
                        <tr>
    						<td class="va-top">Bank / No. Accounts</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="bank" id="bank" class="input-text" style="width: 150px;" />
                                <input type="text" name="no_rekening" id="no_rekening" class="input-text" style="width: 145px;" />
                            </td>
    					</tr>
                        <tr>
    						<td class="va-top">On Behalf</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="atas_nama" id="atas_nama" class="input-text" />
                            </td>
    					</tr>
                    </table>
                </div>-->
    			<div id="tab03">
    				<table class="nostyle" style="font-size: small;">
                        <tr>
    						<td style="width:200px;" class="va-top">Status </td>
                            <td>:</td>
                            <td class="va-top">
                                <select name="status_kawin" id="status_kawin">
                                    <?php
                                        foreach($status_kawin as $keystatus=>$valuestatus)
                                        {
                                            echo '<option value="'.$keystatus.'">'.$valuestatus.'</option>';
                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>
                        <!--<tr>
    						<td style="width:200px;" class="va-top">Amount Dependents</td>
                            <td class="va-top">:</td>
                            <td class="va-top">
                                wife/Husband  &nbsp;&nbsp;<input type="text" name="jmh_tanggungan" id="jmh_tanggungan" class="number input-text" style="width:50px" /> &nbsp;&nbsp;&nbsp;
                                Child &nbsp; <input type="text" name="jmh_tanggungan_anak" id="jmh_tanggungan_anak" class="number input-text" style="width:50px" />
                            </td>
    					</tr>-->
                        <tr>
    						<td style="width:200px;" class="va-top">Tingkat Pendidikan</td>
                            <td>:</td>
                            <td class="va-top">
                                <select name="tk_pdd" id="tk_pdd">
                                    <?php
                                        foreach($ijazah as $keyijazah=>$valueijazah)
                                        {
                                            echo '<option value="'.$keyijazah.'">'.$valueijazah.'</option>';
                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td style="width:200px;" class="va-top">Pendidikan Terakhir</td>
                            <td>:</td>
                            <td class="va-top">
                                <select name="pdd_akhir" id="pdd_akhir">
                                    <?php
                                        foreach($ijazah as $keyijazah=>$valueijazah)
                                        {
                                            echo '<option value="'.$keyijazah.'">'.$valueijazah.'</option>';
                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>
                        <!--<tr>
    						<td style="width:200px;" class="va-top">Field Education</td>
                            <td>:</td>
                            <td class="va-top">
                                <select name="bidang_pend" id="bidang_pend">
                                    <?php
//                                        foreach($bidang_pend as $keypend=>$valuepend)
//                                        {
//                                            echo '<option value="'.$keypend.'">'.$valuepend.'</option>';
//                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td class="va-top">Program Study</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="program_studi" id="program_studi" class="input-text" />
                            </td>
    					</tr>
                        <tr>
    						<td class="va-top">Years Graduated</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="thn_lulus" id="thn_lulus" class="tahun input-text" style="width: 50px;" />
                            </td>
    					</tr>-->
                        <tr>
    						<td class="va-top">Mengajar Mata Pelajaran</td>
                            <td>:</td>
                            <td>
                                <select name="mp" id="mp">
                                    <option value=""></option>
                                    <?php
                                        foreach($mp->result() as $rowmp)
                                        {
                                            echo '<option value="'.$rowmp->kd_mp.'">'.$rowmp->nm_mp.'</option>';
                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>
                        <!--<tr>
    						<td class="va-top">Amount of Hours / Week</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="jmh_jam" id="jmh_jam" class="number input-text" style="width: 50px;" />
                            </td>
    					</tr>-->
                        <tr>
    						<td class="va-top">Mulai Bekerja</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="tgl_mulai_kerja" id="tgl_mulai_kerja" class="tgl input-text"  />
                            </td>
    					</tr>
                        <tr>
    						<td class="va-top">Keluar Bekerja</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="tgl_keluar" id="tgl_keluar" class="tgl input-text"  />
                            </td>
    					</tr>
                    </table>
                </div>
			</div>
            <table class="nostyle">
                <tr>
            		<td colspan="2" class="t-right">
                        <input type="submit" name="" class="input-submit" value="Save" />
                        <input type="button" name="" class="input-submit" value="Cancel" onclick="javascript:window.location='<?php echo base_url().'index.php/guru/daftar' ?>';" />
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
    var nip     = $('#nip').val();
    var nama    = $('#nama_lengkap').val(); 
    peringatan  += (nip=='') ? "NIP harus diisi!\n" : '';
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