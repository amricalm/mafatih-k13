<?php
class Ekstrakurikuler extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('ekstrakurikuler_model');
        $this->load->model('app_model');
        $this->global['kd_sekolah']             = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']                = $this->session->userdata('th_ajar');
    }
    function index()
    {
        redirect('ekstrakurikuler/daftar');
    }
    function daftar()
    {
        $data['nama_sekolah']             = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']                    = ' | Daftar ekstrakurikuler';
        $data['menu']                     = $this->app_model->tampil_menu('File');
        $data['ekstrakurikuler']          = $this->ekstrakurikuler_model->get('');
        
        $this->load->view('ekstrakurikuler/daftar',$data);
    }
    function ekstrakurikuler_form($trx)
    {
        $data['nama_sekolah']             = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['menu']                     = $this->app_model->tampil_menu('File');
        if ($trx=="db_add")
        {
            $data['title']                = ' | Input Data ekstrakurikuler';
            $this->load->view("ekstrakurikuler/tambah",$data);
        }
        elseif ($trx=="db_edit")
        {   
            $data['title']                = ' | Edit Data ekstrakurikuler';
            $data['data']                 = $this->ekstrakurikuler_model->get($this->uri->segment(4));
            $this->load->view("ekstrakurikuler/edit_eskul",$data);
        }
        elseif ($trx=="db_del")
        {
            $this->ekstrakurikuler_exec('db_del',$this->uri->segment(4));
        }
    }
    function ekstrakurikuler_exec($trx)
    {
        $data['kd_eskul']               = $this->input->post('kd_eskul');
        $data['nm_eskul']               = $this->input->post('nm_eskul');
        
        if ($trx=="db_add")
        {
            $data['uid']                = $this->session->userdata('user_name');
            $data['tgl_tambah']         = date('Y-m-d h:i:s');
            if($this->ekstrakurikuler_model->simpan($data))
            {
                redirect('ekstrakurikuler/daftar');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal simpan!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_edit")
        {   
            $data['uid_edit']           = $this->session->userdata('user_name');
            $data['tgl_edit']           = date('Y-m-d h:i:s');
            if($this->ekstrakurikuler_model->update($this->input->post('kd_eskul'),$data))
            {
                redirect('ekstrakurikuler/daftar');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal update!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_del")
        {
            if($this->ekstrakurikuler_model->hapus($this->uri->segment(4)))
            {
                redirect('ekstrakurikuler/daftar/');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal hapus!");history.go(-1);</script>';
            }
        }
    }
}