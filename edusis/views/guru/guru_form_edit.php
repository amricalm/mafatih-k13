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
                <form action="<?php echo base_url() ?>index.php/guru/guru_exec/db_edit" method="POST" onsubmit="return validasi()">
                <?php echo form_hidden('nip',$data->row()->nip); ?>
    			<div id="tab01">
    				<table class="nostyle" style="font-size: small;">
    					<tr>
    						<td style="width:200px;">NIP</td>
                            <td style="width:5px;">:</td>
    						<td><input type="text" size="40" name="nip" id="nip" class="input-text" value="<?php echo $data->row()->nip ?>" disabled="disabled" /></td>
    					</tr>
    					<tr>
    						<td class="va-top">Nama Lengkap</td>
                            <td>:</td>
                            <td><input type="text" size="40" name="nama_lengkap" id="nama_lengkap" class="input-text" value="<?php echo $data->row()->nama_lengkap; ?>" /></td>
    					</tr>
                        <tr>
    						<td>Jenis Kelamin</td>
                            <td>:</td>
    						<td>
                                <?php $pilihlaki = ($data->row()->kelamin=='L') ? ' checked="checked" ' : ''; ?>
                                <?php $pilihprm = ($data->row()->kelamin=='P') ? ' checked="checked" ' : ''; ?>
    							<label><input type="radio" value="L" name="kelamin" id="kelaminl" <?php echo $pilihlaki ?>/> Laki-laki</label> &nbsp;
    							<label><input type="radio" value="P" name="kelamin" id="kelaminp" <?php echo $pilihprm ?>/> Perempuan</label> &nbsp;
    						</td>
    					</tr>
                        
                        <tr>
    						<td class="va-top" style="width: 200px;">Tempat / Tgl Lahir</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="tp_lahir" id="tp_lahir" class="input-text" style="width: 150px;" value="<?php echo $data->row()->tp_lahir ?>" />
                                <input type="text" name="tgl_lahir" id="tgl_lahir" class="tgl input-text" style="width: 145px;" value="<?php echo $tgl->row()->th; echo '-'; echo $tgl->row()->bln; echo '-'; echo $tgl->row()->hr;?>" />
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
                                            $pilih = ($keygol==$data->row()->kepeg_golongan) ? ' selected="selected" ' : '';
                                            echo '<option value="'.$keygol.'"'.$pilih.'>'.$valuegol.'</option>';
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
    						<td style="width:200px;" class="va-top">Agama</td>
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
    						<td class="va-top">Alamat</td>
                            <td class="va-top">:</td>
                            <td><textarea name="alamat" id="alamat" class="input-text" ><?php echo $data->row()->alamat ?></textarea></td>
    					</tr>
                        <tr>
    						<td class="va-top">Kota/Kabupaten</td>
                            <td>:</td>
                            <td><input type="text" name="kota" id="kota" class="input-text" value="<?php echo $data->row()->kota ?>" /></td>
    					</tr>
                        <tr>
    						<td class="va-top">Kode POS</td>
                            <td>:</td>
                            <td><input type="text" name="kode_pos" id="kode_pos" class="pos input-text" style="width:50px" value="<?php echo $data->row()->kode_pos ?>" /></td>
    					</tr>
                        <tr>
    						<td class="va-top">Telp</td>
                            <td>:</td>
                            <td><input type="text" name="telp" id="telp" class="input-text" value="<?php echo $data->row()->telp ?>" /></td>
    					</tr>
                        <tr>
    						<td class="va-top">HP</td>
                            <td>:</td>
                            <td><input type="text" name="hp" id="hp" class="input-text" value="<?php echo $data->row()->hp ?>"/></td>
    					</tr>
                        <tr>
    						<td class="va-top">Jabatan</td>
                            <td>:</td>
                            <td class="va-top" width="250px">
                                <?php
                                    foreach($jabatan as $keyjabatan=>$valuejabatan)
                                    {
                                        $sjabatan        = explode(';',$data->row()->jabatan);
                                        $pilih           = '';
                                        for($i=0;$i<count($sjabatan);$i++)
                                        {
                                            $pilih      .= ($sjabatan[$i]==$valuejabatan) ? ' checked="checked" ' : '';
                                        }
                                        echo '<input type="checkbox" name="jabatan[]" id="jabatan'.$keyjabatan.'" value="'.trim($valuejabatan).'" '.$pilih.'/>&nbsp;&nbsp;'.$valuejabatan.'<br/>';
                                    } 
                                ?>
                            </td>
    					</tr>
                    </table>
                </div>
    			<div id="tab03">
    				<table class="nostyle" style="font-size: small;">
                        <tr>
    						<td style="width:200px;" class="va-top">Status Kawin</td>
                            <td>:</td>
                            <td class="va-top">
                                <select name="status_kawin" id="status_kawin">
                                    <?php
                                        foreach($status_kawin as $keystatus=>$valuestatus)
                                        {
                                            $pilih  = ($keystatus==$data->row()->status_kawin) ? ' selected="selected" ' : '';
                                            echo '<option value="'.$keystatus.'"'.$pilih.'>'.$valuestatus.'</option>';
                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td style="width:200px;" class="va-top">Tingkat Pendidikan</td>
                            <td>:</td>
                            <td class="va-top">
                                <select name="tk_pdd" id="tk_pdd">
                                    <?php
                                        foreach($ijazah as $keyijazah=>$valueijazah)
                                        {
                                            $pilih      = (trim($data->row()->tk_pdd)==$keyijazah) ? ' selected="selected" ' : '';
                                            echo '<option value="'.trim($keyijazah).'"'.$pilih.'>'.$valueijazah.'</option>';
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
                                            $pilih      = (trim($data->row()->pdd_akhir)==$keyijazah) ? ' selected="selected" ' : '';
                                            echo '<option value="'.trim($keyijazah).'"'.$pilih.'>'.$valueijazah.'</option>';
                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td style="width:200px;" class="va-top">Ijazah Tertinggi</td>
                            <td>:</td>
                            <td class="va-top">
                                <select name="ijazah" id="ijazah">
                                    <?php
                                        foreach($ijazah as $keyijazah=>$valueijazah)
                                        {
                                            $pilih      = (trim($data->row()->ijasah)==$keyijazah) ? ' selected="selected" ' : '';
                                            echo '<option value="'.trim($keyijazah).'"'.$pilih.'>'.$valueijazah.'</option>';
                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td class="va-top">Mata Pelajaran yang diajarkan</td>
                            <td>:</td>
                            <td>
                                <?php
                                    $arraymp = array('');
                                    foreach($mp->result () as $rowmp )
                                    {
                                        $arraymp[trim($rowmp->kd_mp)]=$rowmp->nm_mp;
                                    }
                                    echo form_dropdown('mp',$arraymp,trim($data->row()->mp),' id="mp" ');
                                ?>
                            </td>
    					</tr>
                        <tr>
    						<td class="va-top">Mulai Bekerja</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="tgl_mulai_kerja" id="tgl_mulai_kerja" class="tgl input-text" value="<?php echo $tglm->row()->th; echo '-'; echo $tglm->row()->bln; echo '-'; echo $tglm->row()->hr;?>" />
                            </td>
    					</tr>
                        <tr>
    						<td class="va-top">Keluar Bekerja</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="tgl_keluar" id="tgl_keluar" class="tgl input-text" value="<?php echo $tglk->row()->th; echo '-'; echo $tglk->row()->bln; echo '-'; echo $tglk->row()->hr;?>"" />
                            </td>
    					</tr>
                    </table>
                </div>
			</div>
            <table class="nostyle">
                        <tr>
                    		<td colspan="2" class="t-left">
                                <input type="submit" name="" class="input-submit" value="Simpan" />
                                <input type="button" name="" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/guru/daftar' ?>';" />
                            </td>
                    	</tr>
            </table>
            </form>
		</div><!-- /cols -->
</div> <!-- /main -->
	<hr class="noscreen" />
	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>
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