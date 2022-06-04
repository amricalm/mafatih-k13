<?php
Header('Cache-Control: no-cache');
Header('Pragma: no-cache');
?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="en" />
	<meta name="robots" content="noindex,nofollow" />
	<?php $this->load->view('pagecss'); ?>
	<script type="text/javascript">
	$(document).ready(function(){
		$(".tabs > ul").tabs();
	});
	</script>
	<title>SID | Sekuriti</title>
</head>

<body>

    <div id="main">
        <?php $this->load->view('sekuriti/menu_sekuriti'); ?>
            <!-- Content (Right Column) -->
            <div id="content" class="box">
                <h1>Otorisasi Group&nbsp;<?php echo $group->group_nama;?></h1>
                <div id="tab01">
                    <table style="border:none;width:100%">
                    <tr>
                        <td style="border:none"></td>
                        <td style="border:none;text-align:right">
                            <a href="" id="tombol_add" onclick="return edit_all('<?php echo base_url(); ?>index.php/sekuriti/role_form/db_add/<?php echo $group->group_kd;?>');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//cog.png" /></a>
                        </td>
                    </tr>
                    </table>
                    <table style="width:100%">
                        <tr>
                            <th style="width:5px"></th>                
                            <th style="width:70%">Daftar Otorisasi</th>
                            <th style="width:30%">Kategori</th>
    			</tr>
                            <form name="form">
                                <?php	
                                    $seq = 1;
                                    $kat = ""; $kat_chk = 0;
                                    foreach($listrole->result() as $row):
                                        if ($row->role_kat!=$kat) {$kat = $row->role_kat; $kat_chk = 0;} else $kat_chk++;
                                ?>						
    				<tr class="<?php  if($seq % 2 == 0) echo "bg"; else echo "";?>">
                                <td><input type="checkbox" id="<?php echo $row->role_kd;?>" name="kode[]" <?php echo $row->chk;?> /></td>
                                <td><?php echo $row->role_nm;?></td>                                
                                <?php if ($kat_chk==0) { ?> 
                                    <td rowspan="<?php echo $row->span;?>"><b><?php echo $row->role_kat;?></b></td>
                                <?php } ?>                                
				<?php	
                                    $seq++;
                                    endforeach;
				?>
                            </form>   
    			</tr>
                    </table>                   
                </div>
            </div>
        </div> <!-- /cols -->
        <hr class="noscreen" />

        <!-- Footer -->
        <?php $this->load->view('page_footer'); ?>

    </div> <!-- /main -->
    <script type="text/javascript" src="<?php echo base_url(); ?>edusis_asset/js/aksi.js"></script>
</body>
</html>