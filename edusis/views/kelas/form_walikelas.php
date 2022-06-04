 <?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>WALI KELAS</h1>
		<div id="tab11">
                <?php echo form_open('walikelas/wali_exec/db_wali','onsubmit = "return validasi()" id="frmkelas"'); ?>
    			<fieldset>
    				<legend>Input Wali Kelas</legend>
    				<table style="border:none;width:100%" class="nostyle">
                    <tr>
                        <td style="width: 150px;">Kelas</td>
                        <td>
                            <select name="kelas" id="kelas" onchange="ubahform()">
                            <?php
                                echo '<option value="" class="input-text"></option>';
                                if($kelas->num_rows()!=0)
                                {
                                    foreach($kelas->result() as $rowkelas)
                                    {
                                        $selected       = '';
                                        if($p_kelas==$rowkelas->kelas)
                                        {
                                            $selected   = ' selected="selected" ';
                                        }
                                        echo '<option value="'.$rowkelas->kelas.'" class="input-text" '.$selected.'>'.$rowkelas->kelas.'</option>'; 
                                    }
                                }
                            ?>	
                            </select>						
                        </td>
                    </tr>
                    <tr>
                        <td>Tahun Ajar</td>
                        <td>
                            <select name="th_ajar" id="th_ajar">
                            <?php
                                echo '<option value="" class="input-text"></option>';
                                if($th_ajar->num_rows()!=0)
                                {
                                    foreach($th_ajar->result() as $rowthajar)
                                    {
                                        $selected       = '';
                                        if($p_th_ajar==$rowthajar->th_ajar)
                                        {
                                            $selected   = ' selected="selected" ';
                                        }
                                        echo '<option value="'.$rowthajar->th_ajar.'" class="input-text" '.$selected.'>'.$rowthajar->th_ajar.' - '.$rowthajar->keterangan.'</option>'; 
                                    }
                                }
                            ?>	
                            </select>							
                        </td>
                    </tr>
                    <tr>
                        <td>Wali Kelas</td>
                        <td>
                            <select name="nip" id="nip">
                               <?php
                                echo '<option value="" class="input-text"></option>';
                                if($pegawai->num_rows()!=0)
                                {
                                    foreach($pegawai->result() as $rowpegawai)
                                    {
                                        $selected       = '';
                                        if($p_pegawai==$rowpegawai->nip)
                                        {
                                            $selected   = ' selected="selected" ';
                                        }
                                        echo '<option value="'.$rowpegawai->nip.'" class="input-text" '.$selected.'>'.$rowpegawai->nama_lengkap.'</option>'; 
                                    }
                                }
                            ?>	
                            </select>						
                        </td>
                    </tr>
                    <tr>
                        <td></td>
    			         <td colspan="2" class="t-left">
                            <input type="submit" class="input-submit" value="Simpan" />
                            <input type="reset" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo site_url('walikelas/daftar') ?>'" />
                        </td>
                    </tr>
                </table>
		              </fieldset>
                
                <?php echo form_close(); ?>
			</div>
		</div>
	</div> <!-- /cols -->
	<hr class="noscreen" />
	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>
</div> <!-- /main -->
</body>
</html>