 <?php $this->load->view('page_head');?>
<body>
<div id="main">
    <?php $this->load->view('page_menu');?>
		<!-- Content (Right Column) -->
		<div id="content" class="box">
			<h1>IMPOR NILAI</h1>
			<div id="tab01">
            <fieldset>
                <table width="100%" border="1" style="border: none;">
                <?php echo form_open_multipart('exel/baca_excel')?>
                <tr>
                    <td width="100px">Kelas</td>
                    <td width="">
                    <?php
                        $arraykelas = array('');
                        foreach($kelass->result () as $rowkelas )
                        {
                            $arraykelas[$rowkelas->kelas]=$rowkelas->kelas;
                        }
                        echo form_dropdown('kelas',$arraykelas,'',' id="kelas"');
                    ?>
                    </td>                      
                </tr>
                <tr>
                    <td>Mata Pelajaran</td>
                    <td>
                    <?php
                        $arraymp = array('');
                        foreach($kdmp->result () as $rowmp )
                        {
                            $arraymp[$rowmp->kd_mp]=$rowmp->nm_mp;
                        }
                        echo form_dropdown('kd_mp',$arraymp,'',' id="mp" ');
                    ?>
                    </td>
                </tr>
                <tr><td colspan="2">&nbsp;</td></tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input class="input-text-02" type="file" name="file" id="file"/>
                    </td>
                </tr>
                <?php //if($this->input()->post('file')!=''){ ?>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="submit" name="simpan" onclick="return validasi()" class="input-submit" value="Impor" />
                        <input type="button" name="batal" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/home' ?>';" />
                    </td>
            	</tr>
                <?php //}?>
                
                </form>
                </table>
            </fieldset>
            </div> <!-- /content -->

	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>

</div> <!-- /main -->
<script type="text/javascript">
function validasi()
{
    var peringatan = '';
    var kelas     = $('#kelas').val();
    var mp        = $('#mp').val();
    var file      = $('#file').val();
    peringatan  += (kelas=='0') ? "Kelas harus diisi!\n" : '';
    peringatan  += (mp=='0') ? "Mata Pelajaran harus diisi!\n" : '';
    peringatan  += (file=='') ? "File harus diisi!\n" : '';
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
</body>
</html>