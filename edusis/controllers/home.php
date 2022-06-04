<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author andhana
 */
class Home extends CI_Controller{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('app_model');
        if (!$this->app_model->is_login("")) {redirect('login/loggedout');}
    }
    function index()
    {
        $data['nama_sekolah']   = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']      = ' | Dashboard';
        $data['menu']       = $this->app_model->tampil_menu('Home');
        $this->load->view('home/index',$data);
    }
    function konfigurasi()
    {
        $data['nama_sekolah']      = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']             = ' | Konfigurasi';
        $data['menu']              = $this->app_model->tampil_menu('FILE');
        $data['kd_sekolah']        = $this->session->userdata('kd_sekolah');
        $data['th_ajar']           = $this->session->userdata('th_ajar');
        $data['kd_semester']       = $this->session->userdata('kd_semester');
        $data['tgl_lhb']            = $this->app_model->get_tgl_lhb();

        $this->load->view('home/konfigurasi',$data);
        
    }
    function simpan_konfigurasi()
    {
        $data['sys_val']          = adn_ctgl2($this->input->post('tgl_lhb'));
        if($this->app_model->simpan_tgl_lhb($data))
            {
                echo '<script type="text/javascript">alert("Update Successfully!");window.location="'.site_url('home').'";</script>';
            }
            else
            {
                echo '<script type="text/javascript">alert("Failed to Save!");history.go(-1);</script>';
            }
    }
}

?>