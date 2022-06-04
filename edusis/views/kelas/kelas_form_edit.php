 <?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>KELAS</h1>
		<div id="tab11">
                <?php echo form_open('kelas/kelas_exec/db_edit','onsubmit = "return validasi()" id="frmkelas"'); ?>
                <?php echo form_hidden('kd_kelas',$data->row()->kelas) ?>
    			<fieldset>
    				<legend>Edit Kelas</legend>
    				<table class="nostyle" style="width:100%">
    					<!--<tr>
    						<td style="width:200px;">Kode Kelas</td>
    						<td><input type="text" size="20" name="peg_kd" id="peg_kd" class="input-text required" /></td>
    					</tr>-->
    					<tr>
    						<td>Nama kelas</td>
    						<td><input type="text" size="50" name="kelas" id="kelas" class="input-text" value="<?php echo trim($data->row()->kelas) ?>" /></td>
    					</tr>
    					<tr>
    						<td>Kelas</td>
    						<td>
                                <select name="tingkat" id="tingkat">
                                <?php
                                $kelas      = array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6');
                                foreach($kelas as $key=>$value)
                                {
                                    $selected       = ($key==$data->row()->tingkat) ? ' selected="selected" ' : '';
                                    echo '<option value="'.$key.'" class="input-text"'.$selected.'>'.$value.'</option>';
                                }
                                ?>
                                </select>
                            </td>
    					</tr>
                        <tr>
                            <td></td>
        			         <td colspan="2" class="t-left">
                                <input type="submit" class="input-submit" value="Edit" />
                                <input type="reset" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo site_url('kelas/daftar') ?>'" />
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