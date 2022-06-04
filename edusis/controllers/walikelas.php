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
class Walikelas extends CI_Controller{
    
    var $global;
    function __construct()
    {
        parent::__construct();
        $this->load->model('jurusan_model');
        $this->load->model('kelas_model');
        $this->load->model('th_ajar_model');
        $this->load->model('guru_model');
        $this->load->model('siswa_model');
        $this->load->model('app_model');
        $this->global['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']            = $this->session->userdata('th_ajar');
        if (!$this->app_model->is_login("")) {redirect('login/loggedout');}
    }
    function index()
    {
        redirect('walikelas/daftar');
    }
    function daftar($off=0)
    {	
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Wali Kelas';
	    $data['menu']               = $this->app_model->tampil_menu('File');
        $data['kd_sekolah']         = $this->global['kd_sekolah'];
        $data['th_ajar']            = $this->global['th_ajar'];
        $data['kelas']              = $this->kelas_model->getwaliall($data);
        $this->load->view('kelas/walidaftar',$data);
    }    
    
    function wali_form($trx)
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Wali Kelas';
        $data['menu']              = $this->app_model->tampil_menu('File');
        $data['jurusan']            = $this->jurusan_model->get();
        
        if ($trx=="db_add")
        {   
            $data['title']          = ' | Input Wali Kelas';
            $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
            $data['th_ajar']        = $this->th_ajar_model->getall('');
            $data['p_th_ajar']      = ($this->input->post('th_ajar')=='') ? $this->session->userdata('th_ajar') : $this->input->post('th_ajar');
            $data['pegawai']        = $this->guru_model->getAll();
            $data['kelas']          = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
            $this->load->view("kelas/form_walikelas",$data);
        }
        elseif ($trx=="db_edit")
        {   
            $data['title']          = ' | Edit Wali Kelas';
            $data['pilih_kelas']    = str_replace('%20',' ',$this->uri->segment(4));
            $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
            $data['th_ajar']        = $this->th_ajar_model->getall('');
            $data['p_th_ajar']      = ($this->input->post('th_ajar')=='') ? $this->session->userdata('th_ajar') : $this->input->post('th_ajar');
            $data['pegawai']        = $this->guru_model->getAll();
            $data['kelas']          = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
            $data['data']           = $this->kelas_model->walikelas($data['pilih_kelas'] ,$data['kd_sekolah'],$data['p_th_ajar']);
            
            $this->load->view("kelas/form_edit_walikelas",$data);
        }
        
        elseif ($trx=="db_del")
        {
            $this->kelas_exec($trx,$this->uri->segment(4));
        }
    }
    function wali_exec($trx)
	{
        if ($trx=="db_wali")
        {
            $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
            $data['th_ajar']        = $this->session->userdata('th_ajar');
            $data['kelas']          = $this->input->post('kelas');
            $data['wali_kelas']            = $this->input->post('nip');
            $sudahada               = $this->kelas_model->walikelas($data['kelas'],$data['kd_sekolah'],$data['th_ajar'])->num_rows();
			//die($this->db->last_query());
            if($sudahada==0)
            {
                if($this->kelas_model->simpanwali($data))
                {
                    redirect('walikelas/daftar');
                }
                else
                {
                    echo '<script type="text/javascript">alert("'."Gagal simpan, Kelas sudah terisi wali murid!".'");history.go(-1);</script>';
                }
            }
            else
            {
                echo '<script type="text/javascript">alert("'."Gagal simpan, Kelas sudah terisi wali murid!".'");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_edit")
        {   
            $data['kd_sekolah']       = $this->global['kd_sekolah'];
            $data['th_ajar']            = $this->global['th_ajar'];
            $data['kelas']              = $this->input->post('kelas');
            $data['wali_kelas']                = $this->input->post('nip');
            
            $sudahada               = $this->kelas_model->walikelas($data['kelas'],$data['kd_sekolah'],$data['th_ajar'])->num_rows();
            if($sudahada==0)
            {
                if($this->kelas_model->simpanwali($data))
                {
                    redirect('walikelas/daftar');
                }
                else
                {
                    echo '<script type="text/javascript">alert("'."Gagal simpan, Kelas sudah terisi wali murid!".'");history.go(-1);</script>';
                }
            }else
            {
                
                if($this->kelas_model->updatewali($this->input->post('kelas'),$data))
                { 
                    redirect('walikelas/daftar');
                }
                else
                {
                    echo '<script type="text/javascript">alert("Gagal update!");history.go(-1);</script>';
                }
            }
        }
        elseif ($trx=="db_del")
        {
            if($this->kelas_model->hapus($this->uri->segment(4)))
            {
                redirect('walikelas/daftar');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal hapus!");history.go(-1);</script>';
            }
        }
    }
}

?>