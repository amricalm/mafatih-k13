<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of peserta
 *
 * @author andhana
 */
class Th_ajar extends CI_Controller{
    
    var $global;
    function __construct()
    {
        parent::__construct();
        $this->load->model('th_ajar_model');
        $this->load->model('guru_model');
        $this->load->model('app_model');
        $this->global['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']        = $this->session->userdata('th_ajar');
        if (!$this->app_model->is_login("")) {redirect('login/loggedout');} 
    }
    function index()
    {
        redirect('th_ajar/daftar');
    }
    function daftar($off=0)
    {	
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->global['kd_sekolah'])->nama_sekolah;
        $data['title']              = ' | Daftar Tahun Ajar';
        $data['thaktif']            = $this->th_ajar_model->get_th_aktif();
        
        $this->load->library('pagination');
        $limit = 20;
        $jmhdata                    = $this->th_ajar_model->get();
        $base_url                   = base_url().'index.php/th_ajar/daftar';
        $total_row                  = $jmhdata->num_rows();
        $per_page                   = $limit;
        $uri_segment                = 3;

        $config                     = $this->app_model->config_pagination($base_url,$total_row,$per_page,$uri_segment);

        $this->pagination->initialize($config);
	
        $data['jmhdata']	        = $jmhdata->num_rows();
        $data['menu']               = $this->app_model->tampil_menu('File');
        $data['data']               = $this->th_ajar_model->get('',$limit,$off);
        $this->load->view('th_ajar/daftar',$data);
    }
    function th_ajar_form($trx)
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->global['kd_sekolah'])->nama_sekolah;
        $data['menu']               = $this->app_model->tampil_menu('File');
        $data['pegawai']            = $this->guru_model->get('','','');
        $data['thaktif']            = $this->th_ajar_model->get_th_aktif();
        if ($trx=="db_add")
        {
            $data['title']          = ' | Input Data Tahun Ajar';
            $this->load->view("th_ajar/th_ajar_form",$data);
        }
        elseif ($trx=="db_edit")
        {   
            $thajar                 = explode('-',$this->uri->segment(4));
            $data['data']           = $this->th_ajar_model->getall($thajar[0].'/'.$thajar[1]);
            //$data['data']           = $this->th_ajar_model->getall($this->uri->segment(4));
            $data['title']          = ' | Edit Data Tahun Ajar';
            $this->load->view("th_ajar/th_ajar_form_edit",$data);
        }
        elseif ($trx=="db_del")
        {
            $thajar                 = explode('-',$this->uri->segment(4));
            $this->th_ajar_exec($trx,$thajar[0].'/'.$thajar[1]);
        }
    }
    function th_ajar_exec($trx,$kd='')
	{
        $data['keterangan']         = $this->input->post('keterangan');
        $data['nip']                = $this->input->post('nip');
        
        if ($trx=="db_add") 
        {	
            $data['th_ajar']        = $this->input->post('th_ajar');
            if($this->th_ajar_model->simpan($data))
            {
                echo '<script type="text/javascript">alert("Berhasil disimpan!");window.location="'.site_url('th_ajar/daftar').'";</script>';
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal simpan!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_edit")
        {	
            if($this->th_ajar_model->update($this->input->post('th_ajar'),$data))
            {
                echo '<script type="text/javascript">alert("Berhasil diupdate!");window.location="'.site_url('th_ajar/daftar').'";</script>';
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal diupdate!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_del")
        {
            if($this->th_ajar_model->hapus($kd))
            {
                echo '<script type="text/javascript">alert("Berhasil dihapus!");window.location="'.site_url('th_ajar/daftar').'";</script>';
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal dihapus!");history.go(-1);</script>';
            }
        }
    }
    function ganti_sesi()
    {
        $th_ajar_baru       = $this->input->post('th_ajar_baru');
        $this->session->set_userdata(array('th_ajar'=>$th_ajar_baru));
        $this->th_ajar_model->set_th_aktif($th_ajar_baru);
        echo '#';
    }
    function ganti_semester()
    {
        $semester_baru       = $this->input->post('semester_baru');
        $this->session->set_userdata(array('kd_semester'=>$semester_baru));
        $this->th_ajar_model->set_smt_aktif($semester_baru);
        echo '#';
    }    
    function ganti_sekolah()
    {
        $sekolah_baru       = $this->input->post('sekolah_baru');
        $this->session->set_userdata(array('kd_sekolah'=>$sekolah_baru));
        $this->th_ajar_model->set_sid_aktif($sekolah_baru);
        echo '#';
    }        
    function ganti_sub()
    {
        $sub_baru       = $this->input->post('sub_baru');
        $this->session->set_userdata(array('sub_pnl'=>$sub_baru));
        $this->th_ajar_model->set_sub_aktif($sub_baru);
        echo '#';
    }    
}

?>