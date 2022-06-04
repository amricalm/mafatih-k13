 <?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>
		<!-- Content (Right Column) -->
		<div id="content" class="box">
			<h1>Konfigurasi</h1>
                        <form action="<?php echo base_url() ?>index.php/home/simpan_konfigurasi" method="POST">
                <table style="border:none;width:100%">
                    <tr>
                        <td style="border:none;text-align:left">
                            <br>
                        Tanggal Rapor  : 

                        <input type="text" name="tgl_lhb" id="tgl_lhb" class="tgl input-text" value="<?php echo $tgl_lhb; ?>" style="width: 145px;" />
                        <br>
                            
                            
                            
                            
                            
                            
                            
                        </td>
                        <td style="border:none;text-align:right">
                         
                            
                        </td>
                    </tr>
                </table>
			<div style="border:1px solid #999999" border="1">
    			            <table class="nostyle">
                <tr>
            		<td colspan="2" class="t-right">
                        <input type="submit" name="" class="input-submit" value="Save" />
                        <input type="button" name="" class="input-submit" value="Cancel" onclick="javascript:window.location='<?php echo base_url().'index.php/home' ?>';" />
                    </td>
            	</tr>
            </table>

		  </div>
                                        </form>
	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>

</div> <!-- /main -->
</body>
</html>
