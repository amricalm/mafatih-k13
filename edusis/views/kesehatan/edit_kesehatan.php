<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<!-- Content (Right Column) -->
	<div id="content" class="box">
		<h1>KESEHATAN</h1>
		<div id="tab01">
        <form action="<?php echo base_url() ?>index.php/kesehatan/kesehatan_exec/db_edit" method="POST" name="frmekstrakurikuler" id="frmekstrakurikuler">
        <input type="hidden" name="kd_eskul" value="<?php echo $data->row()->kd_kesehatan?>"/>
        <table style="width:100%;font-size: 14px;">
            <tr>
                <td style="width:5%; ">Kode</td>
                <td style="width:1%;">:</td>
                <td style="width:94%"><input type="text" disabled="disabled" name="kd_eskul" id="kd_eskul" class="input-text" value="<?php echo $data->row()->kd_kesehatan?>"/></td>
            </tr>
            <tr>
                <td style="width:5%;">Kesehatan</td>
                <td style="width:1%;">:</td>
                <td style="width:94%;"><input type="text" name="nm_eskul" id="nm_eskul" class="input-text" value="<?php echo $data->row()->nm_kesehatan?>"/></td>
            </tr>
            <tr>
                <td style="border:none;width:5%;">Kategori</td>
                <td style="border:none;width:1%;">:</td>
                <td style="border:none;width:94%;">
                    <select name="kategori" id="kategori">
                    <?php
                        echo '<option value="" class="input-text"></option>';
                        $arraykategori = array('Tinggi dan Berat Badan','Kondisi Kesehatan');
                        foreach($arraykategori as $rowkategori )
                        {
                            $selected       ='';
                            if($data->row()->kategori == trim($rowkategori))
                            {
                                $selected   = 'selected="selected"';
                            }
                        echo '<option value="'.trim($rowkategori).'" class="input-text" '.$selected.'>'.$rowkategori.'</option>';
                        }
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
            <td></td><td></td>
            <td>
                <input type="submit" name="edit" class="input-submit" value="Edit" />
                <input type="button" name="batal" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/kesehatan/daftar' ?>';" />
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