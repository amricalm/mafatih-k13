<!DOCTYPE html>
<html>
    <head>
        <title>Cetak Studi Kasus</title>
        <style type="text/css">
            body {font-size:12 "Tahoma", sans-serif;}
            th {height:25px;background:orange;}
            td {height:25px;}
            td .bg{background:yellow;}
        </style>
    </head>
    <body>
        <h3 align="center"><u>Laporan Studi Kasus Siswa</u></h3>
		<table style="width: 100%;border:0 solid #000" cellpadding="0" cellspacing="0">
            <tr>
                <td width="8%">No.Induk</td>
				<td width="2%">:</td>
				<td width="90%"></td>
			</tr>
			<tr>
                <td>Nama</td>
				<td>:</td>
				<td><?php echo $row()->nama_lengkap?></td>
			</tr>
			<tr>            
				<td>Kelas</td>
				<td>:</td>
				<td></td>
            </tr>
		</table>
        <br/>
        <table style="width: 67%;border:1px solid #000" border="1" cellpadding="0" cellspacing="0">
            <tr>
                <th width="2%">No.</th>
				<th width="15%">Tanggal</th>
				<th width="40%">Pelanggaran Siswa</th>
				<th width="10%">Point</th>
            </tr>
            <?php
                $seq        = 1;
                foreach($studikasus->result() as $row)
                {
            ?> 
            <tr>
                <td><?php echo $seq; ?></td>
				<td><?php //echo $row->tgl; ?></td>
				<td><?php //echo $row->nm_pelanggaran; ?></td>
				<td><?php //echo $row->point; ?></td>
            </tr>
            <?php $seq++; } ?>
		</table>
        <br/>
		<table style="width: 100%;border:1px solid #000" border="1" cellpadding="0" cellspacing="0">
            <tr>
                <th width="3%">No.</th>
				<th width="97%">Tindakan Orang Tua</th>
            </tr>
            <?php
                $seq        = 1;
                foreach($studikasus->result() as $row)
                {
            ?>
            <tr>
                <td><?php echo $seq; ?></td>
				<td><?php echo $row->tindakan_ortu; ?></td>
            </tr>
            <?php $seq++; } ?>
		</table>
        <br/>
		<br/>
		<table style="width: 100%; solid #000" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="95%" align="right">Petugas</td>
			<td width="5%"></td>
		</tr>
		</table>
    </body>
</html>