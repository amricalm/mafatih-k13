 <?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>TAHUN AJAR</h1>

                <table style="border:none;width:100%">
                    <tr>
                        <td width="40px" style="border:none;text-align:right"><!--Pencarian--></td>
                        <td style="border:none;width:10%;text-align:left">
                            <!--<?php
                                $option =array();
                                //foreach ($cari->result() as $row)
//                                {
//                                    $option = $option + array($row->sysd_kd=>$row->sysd_ket);
//                                }
                                echo form_dropdown('cbo_type',$option, "",'class="input-text" id="cbo_type"');
                            ?>	-->						
                        </td>
                        <td rowspan="2" style="border:none;text-align:left"><!--<a href="javascript:formfilter()" class="large button green">Pencarian</a>--></td>
                        <td rowspan="2" style="border:none;text-align:right">
                            <a href="" id="tombol_add" title="Tambah Tahun Ajar " onclick="return add('<?php echo base_url(); ?>index.php/th_ajar/th_ajar_form/db_add');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//tambah.png" /></a>
                            <a href="" id="tombol_edit" title="Edit Tahun Ajar" onclick="return edit_thajar('<?php echo base_url(); ?>index.php/th_ajar/th_ajar_form/db_edit');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//edit.png" /></a>
                            <a href="" id="tombol_del" title="Hapus Tahun Ajar" onclick="return del('<?php echo base_url(); ?>index.php/th_ajar/th_ajar_form/db_del');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//hapus.png" /></a>
                        </td>
                    </tr>
                    <!--<tr>
                        <td style="border:none;text-align:right">NIP</td>
                        <td style="border:none;text-align:left">
                                <input type="text" size="50" name="txtcari" id="txtcari" class="input-text" /><br>							
                        </td>
                    </tr>-->
                </table>
			<div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
    			<table class="tables" width="100%" >
    				<tr>
    				    <th width="5px" colspan="2"></th>
    				    <th width="20%">TAhun Ajar</th>
						<th width="40%">Keterangan</th>
    				    <th width="40%">Kepala Sekolah</th>
    				</tr>
                    <?php
                    $i = 1; 
                    foreach($data->result() as $row)
                    {
                        $bg = ($i%2==0) ? ' class="bg" ' : '';
                        echo '<tr'.$bg.'>';
                        echo '<td>'.$i.'</td>';
                        echo '<td><input type="checkbox" id="'.$row->th_ajar.'" name="kode[]" /></td>';
                        $aktif      = ($thaktif->row()->sys_val==$row->th_ajar) ? ' - <blink style="color:red;">Aktif</blink>' : ''; 
                        echo '<td>'.$row->th_ajar.$aktif.'</td>';
                        echo '<td>'.$row->keterangan.'</td>';
                        echo '<td>'.$row->nama_lengkap.'</td>';
                        $i++;
                        echo '</tr>';
                    }
                    ?>
    			</table>
			</div>
            
            <?php echo $this->pagination->create_links(); ?> &nbsp;&nbsp;&nbsp;
            </div> <!-- /content -->

	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>

</div> <!-- /main -->
<script>
function edit_thajar(myurl)
{
    var chks = document.getElementsByName('kode[]');
    var hasChecked = '';
    var j = 0;
    var iddituju = new Array();
    iddituju[j] = '';
    for(var x = 1;x <= chks.length; x++)
    {
        if(chks[x-1].checked)
        {
            iddituju[j] = String(chks[x-1].id);
            j++;
        }
    }
    if(iddituju[0]!='')
    {
        var explode = iddituju[0].split('/');
        document.getElementById('tombol_edit').href = myurl+"/"+(explode[0]+'-'+explode[1]);
        return true;
    }
    else
    {
        alert('Minimal satu record terseleksi!');
        return false;
    }
}
function del(myurl)
{
    var chks = document.getElementsByName('kode[]');
    var hasChecked = '';
    var j = 0;
    var iddituju = new Array();
    for(var x = 1;x <= chks.length; x++)
    {
        if(chks[x-1].checked)
        {
            iddituju[j] = String(chks[x-1].id);
            j++;
        }
    }
    if(iddituju.length!=0)
    {    
        var test = confirm("Yakin akan dihapus ? ");
        if(test)
        {
            var explode = iddituju[0].split('/');
            document.getElementById('tombol_del').href = myurl+"/"+(explode[0]+'-'+explode[1]);
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        alert('Minimal satu record terseleksi!');
        return false;
    }
}
</script>
</body>
</html>