 <?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>LEDGER</h1>

			<div id="tab01">
                
                <form action="<?php echo base_url().'index.php/export/ledger/xls';?>" name="frmfilter" id="frmfilter" method="POST">
                <table style="border:none;width:100%" class="nostyle">
                    <tr>
                        <td width="200px" style="border:none;text-align:left">Kelas</td>
                        <td style="border:none;width:10%;text-align:left">
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
                        <td rowspan="4" style="vertical-align:bottom">
                            <input type="submit" class="input-submit" name="filter" value="EXPORT" />
                        </td>
                        <td rowspan="4" style="border:none;text-align:right">
                            <!--<a href="" id="tombol_add" onclick="return add('<?php echo base_url(); ?>index.php/siswa/siswa_form/db_add');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//tambah.png" /></a>
                            <a href="" id="tombol_edit" onclick="return edit('<?php echo base_url(); ?>index.php/siswa/siswa_form/db_edit');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//edit.png" /></a>
                            <a href="" id="tombol_del" onclick="return del('<?php echo base_url(); ?>index.php/siswa/siswa_form/db_del');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//hapus.png" /></a>-->
                        </td>
                    </tr>
                    <tr>
                        <td style="border:none;text-align:left">Tahun Ajar</td>
                        <td style="border:none;text-align:left">
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
                        <td style="border:none;text-align:left">Semester</td>
                        <td style="border:none;text-align:left">
                            <select name="semester" id="semester">
                            <?php
                                echo '<option value="" class="input-text"></option>';
                                if(count($semester)!=0)
                                {
                                    foreach($semester as $key=>$value)
                                    {
                                        $selected       = '';
                                        if($p_semester==$key)
                                        {
                                            $selected   = ' selected="selected" ';
                                        }
                                        echo '<option value="'.$key.'" class="input-text"'.$selected.'>'.$value.'</option>'; 
                                    }
                                }
                            ?>	
                            </select>							
                        </td>
                    </tr>
                </table>
                </form>
			</div>
            </div> <!-- /content -->

	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>

</div> <!-- /main -->
</body>
</html>