<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<div id="content" class="box">
<h1>KOMPETENSI</h1>

    <form action="<?php echo base_url().'index.php/kompetensi/daftar_kompetensi';?>" name="frmfilter" id="frmfilter" method="POST">
        <table width="100%" border="0">
        <tr>
            <td width="100px">Mata Pelajaran</td>
            <td  width="300px"> 
            <select name="mp" id="mp">
    		<?php
    			echo '<option value="" class="input-text" ></option>';
    			$arraymp = array('');
    			if($mp->num_rows() !=0)
    			{
    				foreach($mp->result () as $rowmp )
    				{
    					$selected		='';
    					if($pilihmp == trim($rowmp->kd_mp))
    					{
    						$selected	= 'selected="selected"';
    					}
    				    echo '<option value="'.trim($rowmp->kd_mp).'" class="input-text" '.$selected.'>'.$rowmp->nm_mp.'</option>';
    				}
    			}
    		?>
    		</select>
            </td>
            <td align="right" width="">
            <?php if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0') { ?>
                <a href="<?php echo base_url().'index.php/export/export_kompetensi_daftar/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Daftar Kompetensi" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>
            <?php }?>
            </td>
        </tr>
        <tr>
            <td>Kelas/Tingkat</td>
            <td>
                <?php
                    $arraytik = array('&nbsp;');
                    if(11)
                    {
                        $x = '6';
                    }
                    elseif(01)
                    {
                        $x = '4';
                    }
                    elseif(21)
                    {
                        $x = '3';
                    }
                    else
                    {
                        $x = '3';
                    }
                    for($i=1;$i<=$x;$i++)
                    {
                        $arraytik[$i]=$i;
                    }
                    echo form_dropdown('kelas',$arraytik,$tk,'id="skelas"');
                ?>
            </td>
            <td>
                <input type="submit" class="input button blue" name="submit" onclick="submitbympkelas()" value="Filter" />
            </td>
        </tr>
        </table>
    </form>
    </td>
    </tr>
    <tr>
    <td>
    <form action="<?php echo base_url().'index.php/rencana_pembelajaran/simpan';?>" name="frmdaftar" id="frmdaftar" method="POST">
    <div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
    <table width="100%" class="tables" >
    <tr>
        <th width="10%">Mata Pelajaran</th>
        <th width="30%">Standar Kompetensi</th>
        <th width="30%">Kompetensi Dasar</th>
        <th width="30">Indikator</th>
    </tr>
    <?php
    $sk     = '';
    $kd     = '';
    $idr    = '';
    $mp     = '';
    $i      = '';
    foreach($kompetensi->result() as $row)
    {
//        if($sk!=$row->ket_sk)
//        {
//            echo '<tr><td colspan="3" style="border-bottom: none;border-top:none; "><hr style="height: 1px solid #cfcfcf;" /></td></tr>';
//        }
//        if($kd!=$row->ket_kd)
//        {
//            echo '<tr><td style="border-bottom: none;border-top:none; "></td><td colspan="2" style="border-bottom: none;border-top:none; "></td></tr>';
//        }
//        if($idr!=$row->ket_idr)
//        {
//            echo '<tr><td style="border-bottom: none;border-top:none; "></td><td style="border-bottom: none;border-top:none; "></td><td style="border-bottom: none;border-top:none; "></td></tr>';
//        }
        $bg = ($i%2==0) ? ' class="bg" ' : '';
        echo '<tr'.$bg.'>';
        echo '<td>';
        if($mp!=$row->nm_mp)
        {
            echo $row->nm_mp;
            $mp = $row->nm_mp;
        }
        echo '</td>';
        
        echo '<td>';
        if($sk!=$row->ket_sk)
        {
            echo '<b>&curren;&nbsp;</b>'; echo $row->ket_sk;
            $sk = $row->ket_sk;
        }
        echo '</td>';
        
        echo '<td>';
        if($kd!=$row->ket_kd)
        {
            echo '<b>&gt;&nbsp;</b>'; echo $row->ket_kd;
            $kd = $row->ket_kd;
        }
        echo '</td>';
        
        echo '<td>';
        if($idr!=$row->ket_idr)
        {
            echo '<b>&gt;&gt;&nbsp;</b>'; echo $row->ket_idr;
            $idr = $row->ket_idr;
        }
        echo '</td>';
        $i++;
        echo '</tr>';
    }
    ?>
    </table>
    </form>
</div>
</div> <!-- /content -->
</div> <!-- /cols -->
<hr class="noscreen" />
<!-- Footer -->
<?php $this->load->view('page_footer'); ?>

<script type="text/javascript">
    function submitbympkelas()
    {   
        var varmp    = urlencode($('#mp').val());
        var varkelas = urlencode($('#skelas').val());
        var iddaftar = $('#frmfilter').attr('action');
        $('#frmfilter').attr('action',iddaftar+"/"+varkelas+"/"+varmp);
        $('#frmfilter').submit();
    }
    function ambildatanilai(kelas,kd_mp,ket_sk,ket_kd,kd_tagihan,temu_tgl,kd_penilaian)
    {
        $.ajax
        ({
            type: "POST",
            url: "<?php echo base_url().'index.php/rencana_pembelajaran/get_sk_mp' ?>",
            data: "kelas="+kelas+"&kd_mp="+kd_mp+"&ket_sk"+ket_sk+"&kd_tagihan"+kd_tagihan+"&temu_tgl"+temu_tgl+"&kd_penilaian"+kd_penilaian,
            success : function(msg)
            {
                $('#dataskkd').remove();
                $('#tempatdataskkd').append(msg);
            }
        });
    }
    function ambildatanilai2(p_nl)
    {
		var kelas  = document.getElementById("kelas").value;
        var kd_mp  = document.getElementById("kd_mp").value;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url().'index.php/rencana_pembelajaran/get_sk_mp' ?>",
            data: "kelas="+kelas+"&kd_mp="+kd_mp+"&p_nl="+p_nl,
            success : function(msg)
            {
                $('#dataskkd').remove();
                $('#tempatdataskkd').append(msg);
            }
        });
    }
</script>
<script type="text/javascript">
		$(document).ready(function(){
			$('.Jalankan').on('click', function(){
				console.log($(this).parent().children().children('input').append());
			});
		});
</script>

</body>
</html>
















