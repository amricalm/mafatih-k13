<!--page_tray -->
<div id="tray" class="box">
    <p class="f-left box va-middle">
       Project : <strong>Edusis Prestasi</strong> | <strong><a href="#" onclick="changeSekolah()" style=" font-size: 12px; text-decoration: none; text-transform: uppercase;"><?php echo $nama_sekolah ?></a></strong>
    </p>
    
    <p class="f-right box">
        Th Ajar : <strong><a href="#" onclick="changeThAjar()" style="text-decoration: none;"><?php echo $this->session->userdata('th_ajar') ?></a></strong>
        |
        Semester : <strong><a href="#" onclick="changeSemester()" style="text-decoration: none;"><?php echo $this->session->userdata('kd_semester') ?></a></strong>
        |
        Penilaian : <strong><a href="#" onclick="changeSub()" style="text-decoration: none;"><?php echo $this->session->userdata('sub_pnl') ?></a></strong>
        |
        User: <strong><a href="#" onclick="changePassword()" style="text-decoration: none;"><?php echo $this->session->userdata('user_name'); ?></a></strong>
        |
        <strong><a href="<?php echo site_url('login/loggedout')?>" id="logout" style="text-decoration: none;">exit</a></strong>
    </p>
</div> 
<!--page_tray -->