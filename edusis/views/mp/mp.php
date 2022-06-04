<html>
<head>
<title>Mata Pelajaran</title>
</head>
<body>
<h1>Input Nilai</h1>
    <form action="simpan" method="POST">
        <table border="0">
        <tr> 
            <td>Nama Siswa</td>
            <td>
                <?php
                    $arraysiswa  = Array('Pilih nama siswa');
                    foreach($siswa->result() as $rowsiswa)
                    {
                        $arraysiswa[$rowsiswa->nis] = $rowsiswa->nama_lengkap;
                    }            
                    echo form_dropdown('nis',$arraysiswa,$siswa->row()->nama_lengkap,'name="siswa" id="siswa" class="input-teks"');
                ?>
            </td>
        </tr>
        <tr>
            <td>Mata Pelajaran</td>
            <td>
                <?php
                    $arraymp  = Array('Pilih mata pelajaran');
                    foreach($mp->result() as $rowmp)
                    {
                        $arraymp[$rowmp->kd_mp] = $rowmp->nm_mp;
                    }            
                    echo form_dropdown('kd_mp',$arraymp,$mp->row()->nm_mp,'name="nm_mp" id="nm_mp" class="input-text"');
                ?>
            </td>
        </tr>
        <tr>
            <td style="width:20%">Jenis Penilaian</td>
            <td>
                <?php
                    $arrayjn  = Array('Pilih jenis nilai');
                    foreach($jn->result() as $rowjn)
                    {
                        $arrayjn[$rowjn->kd_jenis_nilai] = $rowjn->jenis_nilai;
                    }            
                    echo form_dropdown('kd_jenis_nilai',$arrayjn,$jn->row()->jenis_nilai,'name="jenis_nilai" id="jenis_nilai" class="input-text"');
                ?>
            </td>
        </tr>
        <tr>
            <td>Nilai</td>
            <td>
                <input type="text" name="nilai" />
            </td>
            
        </tr>
        
        <tr>
        <td></td>
        <td>
            <input type="submit" name="simpan" id="simpan" class="input-submit" value="Simpan" />
            <input type="reset" name="batal" id="batal" class="input-submit"value="Reset"/>
        </td>
        </tr>

</body>
</html>