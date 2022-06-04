<?php $this->load->view('page_head'); ?>
<body>
  <div id="main">
    <?php $this->load->view('page_menu'); ?>
    <div id="container">
      <div id="tabungan" class="tabungan-input">
        <table>
          <tr>
            <td>Jenis Tabungan</td>
            <td>:</td>
            <td><?php
            echo $dropdown;
            ?></td>
          </tr>
          <?php echo form_open('tabungan/cariSiswa'); ?>
          <tr>
            <td>Nama Siswa / NIS</td>
            <td>:</td>
            <td>
              <input type="text" name="siswaTabungan" placeholder="Ketikan sesuatu" />
            </td>
          </tr>
          <tr>
            <td colspan="3" align="center"><button type="submit" class="input button blue">Cari Siswa</button></td>
          </tr>
          <?php echo form_close(); ?>
        </table>
        <?php
        if (isset($data['cekSiswa']))
        {
          echo $data['nama_siswa'];
        }
        else
        {
          echo "Siswa belum dimasukan!!!";
        }
        ?>
      </div>
    </div>
  </div>
</body>
<?php $this->load->view('page_footer'); ?>
