<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<!-- Content (Right Column) -->
	<div id="content" class="box">
		<h1>KONSELING PERSISWA</h1>
		
        <form action="<?php echo base_url().'index.php/lapkonseling/daftar_persiswa' ?>" name="frmcari" id="frmhasilbelajar" method="post">
    <?php echo form_hidden('myurl',site_url('hasilbelajar')) ?>
    <table width="100%">
        <tr>
            <td width="100px">Kelas</td>
            <td width="300px"> 
            <select name="skelas" id="skelas" onchange="pilih()">
    		<?php
    			echo '<option value="0" class="input-text"></option>';
                $arraykelas = array();
    			if($skelas->num_rows() !=0)
    			{
    				foreach($skelas->result () as $rowkelas )
    				{
    					$selected		='';
    					if($pilihkelas == trim($rowkelas->kelas))
    					{
    						$selected	= 'selected="selected"';
    					}
    				echo '<option value="'.trim($rowkelas->kelas).'" '.$selected.'>'.$rowkelas->kelas.'</option>';
    				}
    			}
    		?>
    		</select>
            </td>
            <td align="right" width="">
            <?php if($this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){ ?>
            <a href="<?php echo base_url().'index.php/export/konseling_persiswa/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Konseling Persiswa" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>
            <?php } ?>
            </td>  
        </tr>
        <tr>
            <td>Nama Siswa</td>   
            <td>
                <div id="resultnama">
                <?php
                    $option = array(0=>"&nbsp;");
                    foreach ($nama->result() as $row)
                    {   
                        $option = $option + array(trim($row->nis)=>$row->nama_lengkap) ;
                    }
                    //echo $nis;
                    echo form_dropdown('nis',$option,$nis,'id="nis"');
                ?>
                
                </div>
            </td>
            <td>
                <a href="javascript:filter()" class="small button blue">Filter</a>
            </td>              
        </tr>
    </table>
        </form>
	<div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
        <table style="width: 100%;" border="1" class="tables">
            <tr>
                <th width="2%">No.</th>
				<th width="8%">NIS</th>
                <th width="20%">Nama Siswa</th>
                <th width="8%">Kelas</th>
				<th width="10%">Tanggal</th>
				<th width="26%">Konseling Siswa</th>
				<th width="26%">Solusi Guru BK</th>
            </tr>
            <?php
                $seq        = 1;
                $jmhdatapeserta = 0;
                foreach($konseling->result() as $row)
                {
                    $class = ($seq%2==0) ? ' class="bg" ' : '';
            ?>
            <tr<?php echo $class; ?>>
                <td align="center"><?php echo $seq; ?></td>
                <td align="center"><?php echo $row->nis; ?></td>
                <td><?php echo $row->nama_lengkap; ?></td>
                <td align="center"><?php echo $row->kelas; ?></td>
				<?php //$tgl = ($row->tgl == '' || $row->tgl == '0'|| $row->tgl == 'NULL') ? explode(' ','0 0 0') : explode(' ',$row->tgl);
                //$a=($tgl[0] == '0') ? ' ' : $tgl[0];
                //$b=($tgl[1] == '0') ? ' ' : $tgl[1];
                //$c=($tgl[2] == '0') ? ' ' : $tgl[2]; ?>
                <td align="center"><?php echo $row->tglpanjang?></td>
                <td><?php echo $row->masalah; ?></td>
				<td><?php echo $row->solusi; ?></td>
            </tr>
            <?php $seq++; }?>
		</table>
        </div>
        <?php echo $this->pagination->create_links(); ?> &nbsp;&nbsp;&nbsp;
    </div> <!-- /content -->
<hr class="noscreen" />
<!-- Footer -->
 <?php $this->load->view('page_footer'); ?>
</div> <!-- /main -->
<script type="text/javascript">

    function filter()
    {
        var kelas         = urlencode($('#skelas').val());//utlencode pd javascript digunakan untuk merubah caracter sepasi, spt str_replece pd php 
        var nis           = $('#nis').val();
        var myurl         = $('#myurl').val();
        var form_wi       = $('#frmhasilbelajar').attr('action');
        $('#frmhasilbelajar').attr('action',form_wi+'/'+kelas+'/'+nis);
        $('#frmhasilbelajar').submit();
    }
    function pilih()
    {
        var kelas         = urlencode($('#skelas').val());
        var myurl         = $('#myurl').val();
        var tujuan        = myurl+"/alokasiwi_filter/"+kelas;
        $.ajax({
           type: "POST",
           async: false,
           url: tujuan,
           success: function (msg){
               if (msg!="") {
                   $("#resultnama").html(msg);
               }                       
           }
        });
    }
    function submitbynama()
    {
        var varnama = $('#nama_lengkap').val();
        var iddaftar = $('#frmdaftar').attr('action');
        window.location = iddaftar+"/"+varnama;
    }
</script>
</body>
</html>