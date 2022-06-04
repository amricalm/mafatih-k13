<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<!-- Content (Right Column) -->
	<div id="content" class="box">
		<h1>INDIKATOR SIKAP</h1>
        <form action="<?php echo base_url() ?>index.php/indikator/indikator_exec/db_edit" method="POST" name="frmekstrakurikuler" id="frmekstrakurikuler">
        <input type="hidden" name="kd_sikap" id="kd_sikap" value="<?php echo trim($data->row()->kd_sikap)?>"/>
        <br />
        <legend>Edit Indikator Sikap</legend>	
		<div id="tabs">	
        <table style="width:100%;font-size: 14px;">            
            <tr>
                <td style="border:none;width:10%; ">Kode</td>
                <td style="border:none;width:1%;">:</td>
                <td style="border:none;width:89%"><input disabled="disabled" type="text" name="kd_sikap" id="kd_sikap" class="input-text" value="<?php echo $data->row()->kd_sikap;?>"/></td>
            </tr>
            <tr>
                <td style="width:100px" class="va-top" >Indikator</td><td class="va-top" >:</td>
                <td>
                    <textarea style="height: 105px; width: 380px;" name="nm_sikap" ><?php echo $data->row()->nm_sikap;?></textarea>
                </td>
            </tr>
            <tr>
            <td></td><td></td>
            <td>
                <input type="submit" name="edit" class="input-submit" value="Edit" />
                <input type="button" name="batal" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/kepribadian/daftar' ?>';" />
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
</body>
</html>